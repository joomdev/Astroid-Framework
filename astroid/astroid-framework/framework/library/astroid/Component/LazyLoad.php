<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Component;

use Astroid\Framework;

defined('_JEXEC') or die;

class LazyLoad
{
    public static function run()
    {
        Framework::getDebugger()->log('Lazy Load');
        $app = \JFactory::getApplication();
        $template = Framework::getTemplate();
        $params = $template->getParams();
        $run = $params->get('lazyload', 0);
        if (!$run) {
            return;
        }

        Framework::getDocument()->addScript('vendor/astroid/js/lazyload.min.js');

        if ($params->get('lazyload_components', '')) {
            $run = self::selectedComponents($params->get('lazyload_components', ''), $params->get('lazyload_components_action', 'include'));
            if (!$run) {
                return;
            }
        }

        if ($params->get('lazyload_urls', '')) {
            $run = self::selectedURLs($params->get('lazyload_urls', ''), $params->get('lazyload_urls_action', 'include'));
            if (!$run) {
                return;
            }
        }

        if ($params->get('lazyload_exclude_views', '')) {
            $run = self::exclidedViews($params->get('lazyload_exclude_views', ''));
            if (!$run) {
                return;
            }
        }

        $blankImage = \JURI::root() . 'media/astroid/assets/images/blank.png';
        $patternImage = "@<img[^>]*src=[\"\']([^\"\']*)[\"\'][^>]*>@";
        $body = $inputString = $app->getBody(false);

        preg_match_all($patternImage, $inputString, $matches);

        if ($params->get('lazyload_imgs', '') && !empty($matches)) {
            self::selectedImages($matches, $params->get('lazyload_imgs', ''), $params->get('lazyload_imgs_action', 'include'));
        }

        if ($params->get('lazyload_classes', '') && !empty($matches)) {
            self::selectedClasses($matches, $params->get('lazyload_classes', ''), $params->get('lazyload_classes_action', 'include'));
        }

        if (!empty($matches[0])) {
            $base = \JUri::base();
            $basePath = \JUri::base(true);

            foreach ($matches[0] as $key => $match) {
                if (strpos($matches[1][$key], 'http://') === false && strpos($matches[1][$key], 'https://') === false) {
                    if (!empty($basePath)) {
                        if (strpos($matches[1][$key], $basePath) === false) {
                            $match = str_replace($matches[1][$key], $basePath . '/' . $matches[1][$key], $match);
                        }
                    } else {
                        if (strpos($matches[1][$key], $base) === false) {
                            $match = str_replace($matches[1][$key], $base . $matches[1][$key], $match);
                        }
                    }
                }
                Framework::getReporter('Lazy Load Images')->add('<a href="' . $matches[1][$key] . '" target="_blank"><code>' . Framework::getDocument()->beutifyURL($matches[1][$key]) . '</code></a>');
                $matchLazy = str_replace('src=', 'src="' . $blankImage . '" data-astroid-lazyload=', $match);

                $body = str_replace($matches[0][$key], $matchLazy, $body);
            }

            $app->setBody($body);
            Framework::getDebugger()->log('Lazy Load');
        }
    }

    public static function selectedImages(&$matches, $images = '', $toggle = '')
    {
        $images = array_map('trim', explode("\n", $images));
        $matchesTemp = array();

        foreach ($images as $image) {
            $count = 0;

            foreach ($matches[1] as $match) {
                if (preg_match('@' . preg_quote($image) . '@', $match)) {
                    if ($toggle == 'exclude') {
                        unset($matches[0][$count]);
                    } else {
                        $matchesTemp[] = $matches[0][$count];
                    }
                }

                $count++;
            }
        }

        if ($toggle == 'include') {
            unset($matches[0]);
            $matches[0] = $matchesTemp;
        }
    }

    public static function selectedComponents($components = '', $toggle = '')
    {
        $option = \JFactory::getApplication()->input->getWord('option');
        $components = array_map('trim', explode("\n", $components));
        $hit = false;
        $return = true;
        foreach ($components as $component) {
            if ($option === $component) {
                $hit = true;
                break;
            }
        }

        if ($toggle == 'include') {
            if ($hit === false) {
                $return = false;
            }
            return $return;
        }

        if ($hit === true) {
            $return = false;
        }

        return $return;
    }

    public static function selectedURLs($surls = '', $toggle = '')
    {
        $url = \JUri::getInstance()->toString();
        $surls = array_map('trim', explode("\n", $surls));
        $hit = false;
        $return = true;

        foreach ($surls as $surl) {
            if ($url === $surl) {
                $hit = true;
                break;
            }
        }

        if ($toggle == 'include') {
            if ($hit === false) {
                $return = false;
            }

            return $return;
        }

        if ($hit === true) {
            $return = false;
        }

        return $return;
    }

    public static function exclidedViews($views = '')
    {
        $view = \JFactory::getApplication()->input->getWord('tmpl', '');
        $views = array_map('trim', explode(",", $views));
        $return = true;

        if (in_array($view, $views)) {
            $return = false;
        }

        return $return;
    }

    public static function selectedClasses(&$matches, $classes = '', $toggle = '')
    {
        $classes = array_map('trim', explode("\n", $classes));

        foreach ($matches[0] as $key => $match) {
            foreach ($classes as $classname) {
                $classExists = preg_match('@class=[\"\'].*' . $classname . '.*[\"\']@Ui', $match);

                if ($toggle == 'include') {
                    if (empty($classExists)) {
                        unset($matches[0][$key]);
                    }

                    continue;
                }

                if (!empty($classExists)) {
                    unset($matches[0][$key]);
                }
            }
        }
    }
}
