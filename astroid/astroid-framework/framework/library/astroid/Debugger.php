<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

class Debugger
{
    protected $markers = [];
    protected $reports = [];
    protected $debug = 0;
    protected $_last = null;

    public function __construct()
    {
        $params = Helper::getPluginParams();
        $this->debug = $params->get('astroid_debug', 0);
        if ($this->debug) {
            Framework::getDocument()->addStyleDeclaration('#astroid-debug{position: fixed;z-index: 999999;width: 100%;bottom: 0;background: #000;color: #fff;left: 0;padding: 10px;}#astroid-debug > div{ max-height: 200px; overflow-y: auto}');
        }
    }

    public function log($name)
    {
        if (!isset($this->markers[$name])) {
            $this->start($name);
        } else {
            $this->stop($name);
        }
    }

    public function start($name)
    {
        if (!$this->debug) return;
        $this->markers[$name] = getrusage();
        $this->reports[$name] = null;
    }

    public function stop($name)
    {
        if (!$this->debug) return;
        if (!isset($this->markers[$name])) {
            return;
        }
        $stop = getrusage();
        $utime = $this->getRunTime($stop, $this->markers[$name], "utime");
        $stime = $this->getRunTime($stop, $this->markers[$name], "stime");

        $report = new DebugReport($name);
        $report->save($utime, $stime, memory_get_usage(), memory_get_peak_usage());
        $this->reports[$name] = $report;
    }

    protected function getRunTime($ru, $rus, $index)
    {
        return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
    }

    public function getReports()
    {
        $html = '';
        if (!empty($this->reports)) {
            $html .= '<div id="astroid-debug">';
            $html .= '<p>Astroid Debug</p>';
            $html .= '<div>';
            foreach ($this->reports as $report) {
                if ($report === null) {
                    continue;
                }
                $html .= $report->render();
            }
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
}

class DebugReport
{
    public $id = '', $title = '', $utime = 0, $stime = 0, $memory = 0, $memorypeak = 0, $processed = false;
    public function __construct($id)
    {
        $this->id = $id;
        $this->title = str_replace(['-', '_'], ' ', Helper::title($id));
    }

    public function save($utime, $stime, $memory, $memorypeak)
    {
        $this->utime = $utime;
        $this->stime = $stime;
        $this->memory = $memory;
        $this->memorypeak = $memorypeak;
        $this->processed = true;
    }

    public function render()
    {
        return '<p class="m-0"><strong><em>' . $this->title . '</em></strong> <span class="badge badge-light">Time: ' . $this->utime . ' ms</span> <span class="badge badge-light">Memory: ' . round(($this->memorypeak - $this->memory) / 1048576, 3) . ' MB / ' . round(($this->memorypeak / 1048576), 3) . ' MB</span></p>';
    }
}
