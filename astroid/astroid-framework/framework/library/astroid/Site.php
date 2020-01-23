<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

class Site extends Helper\Client
{
    protected function rate()
    {
        $this->checkAuth();

        $app = \JFactory::getApplication();
        $id = $app->input->post->get('id', 0, 'INT');
        $vote = $app->input->post->get('vote', 0, 'INT');

        if (empty($id)) {
            throw new \Exception(\JText::_('ASTROID_ARTICLE_NOT_FOUND'), 404);
        }
        if ($vote < 0 || $vote > 5) {
            throw new \Exception(\JText::_('ASTROID_INVALID_RATING'), 0);
        }

        $article = new Component\Article($id);
        $this->response($article->vote($vote));
    }

    public function beforeRender()
    {
        Helper\Head::meta(); // site meta
        Helper\Head::scripts(); // site scripts
        Helper\Head::favicon(); // site favicon
    }

    public function afterRender()
    {
        Helper::triggerEvent('onBeforeAstroidRender'); // at last process all astroid:include
        Component\Utility::meta(); // site meta
        Component\Utility::typography(); // site typography
        Component\Utility::background(); // site background
        Component\Utility::colors(); // site colors
        Component\Utility::smoothScroll(); // smooth scroll utility
        Component\Utility::custom(); // site custom codes
        Component\LazyLoad::run(); // to execute lazy load
        Component\Includer::run(); // at last process all astroid:include
        Helper::triggerEvent('onAfterAstroidRender'); // at last process all astroid:include
    }
}
