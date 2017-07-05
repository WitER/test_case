<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        new Widget();
    }
}

class PanelController extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        $this->load->config('template');

        $this->template->initialize($this->config->config);

        $this->template->title($this->config->item('site_name'));
        $this->template->set_partial('topBar', 'topBar');
        $this->template->set_partial('sideBar', 'sideBar');

    }
}


class Widget
{
    protected static $CI = false;

    public function __construct()
    {
        if (self::$CI == false) {
            self::$CI =& get_instance();
        }
    }

    public static final function run($widget, $params = array())
    {
        if (strpos($widget, '@') === false) {
            $widget .= '@index';
        }

        $widget = explode('@', $widget);
        $class = $widget[0];
        $method = $widget[1];
        $widgetFile = APPPATH .
            'widgets/' .
            (substr($class, 0, strrpos($class, '/') + 1) . ucfirst(substr($class, strrpos($class, '/') + 1))) .
            '.php';
        $class = ucfirst(substr($class, strrpos($class, '/') + 1));

        if (!file_exists($widgetFile)) {
            show_error($widgetFile . ' is not exists');
            return;
        }

        include_once $widgetFile;

        if (
            !class_exists($class)
            || strncmp($method, '_', 1) == 0
            || !in_array(strtolower($method), array_map('strtolower', get_class_methods($class)))
        ) {
            show_error('Requested widget or method is not exists ('.$class.'::'.$method.')');
            return;
        }


        return call_user_func_array(array($class, $method), $params);
    }
}