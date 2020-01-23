<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Helper;

use Astroid\Helper;

defined('_JEXEC') or die;

class Template
{
    public static function getAstroidTemplates()
    {
        $db = \JFactory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('s.id, s.template')
            ->from('#__template_styles as s')
            ->where('s.client_id = 0')
            ->where('e.enabled = 1')
            ->leftJoin('#__extensions as e ON e.element=s.template AND e.type=' . $db->quote('template') . ' AND e.client_id=s.client_id');

        $db->setQuery($query);
        $templates = $db->loadObjectList();
        $return = [];
        foreach ($templates as $template) {
            $astroidTemplate = self::isAstroidTemplate($template->template);
            if ($astroidTemplate !== false) {
                self::setTemplateDefaults($template->template, $template->id);
                $return[] = $template->id;
            }
        }
        return $return;
    }

    public static function isAstroidTemplate($template)
    {
        $xml = Helper::getXML(JPATH_SITE . "/templates/{$template}/templateDetails.xml");
        $version = (string) $xml->version;
        $form = new \JForm('template');
        $form->loadFile(JPATH_SITE . "/templates/{$template}/templateDetails.xml", false, '//config');
        $fields = $form->getFieldset('basic');
        $return = false;
        foreach ($fields as $field) {
            if (strtolower($field->type) === 'astroidmanagerlink') {
                $item['version'] = $version;
                $return = $item;
                break;
            }
        }
        return $return;
    }

    public static function setTemplateDefaults($template, $id, $parent_id = 0)
    {
        $params_path = JPATH_SITE . "/templates/{$template}/params/{$id}.json";
        if (!file_exists($params_path)) {
            if (!empty($parent_id) && file_exists(JPATH_SITE . "/templates/{$template}/params/" . $parent_id . '.json')) {
                $params = file_get_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $parent_id . '.json');
                file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', $params);
            } else if (file_exists(JPATH_SITE . '/templates/' . $template . '/astroid/default.json')) {
                $params = file_get_contents(JPATH_SITE . '/templates/' . $template . '/astroid/default.json');
                if (!file_exists(JPATH_SITE . "/templates/{$template}/params")) {
                    mkdir(JPATH_SITE . "/templates/{$template}/params");
                }
                $params = str_replace('TEMPLATE_NAME', $template, $params);
                file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', $params);
            } else {
                if (!file_exists(JPATH_SITE . "/templates/{$template}/params")) {
                    mkdir(JPATH_SITE . "/templates/{$template}/params");
                }
                file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', '');
            }
            $db = \JFactory::getDbo();
            $object = new \stdClass();
            $object->id = $id;
            $object->params = \json_encode(["astroid" => $id]);
            $db->updateObject('#__template_styles', $object, 'id');
            self::uploadTemplateDefaults($template, $id);
        }
    }

    public static function uploadTemplateDefaults($template, $id)
    {
        $source = JPATH_SITE . '/templates/' . $template . '/images/default';
        $destination = JPATH_SITE . '/images/' . $template;
        $files = \JFolder::files($source);
        \JFolder::copy($source, $destination, '', true);
    }
}
