<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Главный класс-контроллер. От него наследуются все визуальные контроллеры
 */
class Controller_Base extends Controller_Template {

    public $template = 'vBase';

    public function before(){
        parent::before();
        if ($this->auto_render){
            $this->template->title = "";
            $this->template->meta_keywords = "";
            $this->template->meta_description = "";
            $this->template->header = "";
            $this->template->content = "";
            $this->template->current_page = "";
            $this->template->footer = "";

            $this->template->styles = array();
            $this->template->scripts = array();
        }
    }

    public function after(){

        if ($this->auto_render){
            $styles = array(
                "st/css/reset.css" => "screen",
                "st/plugins/bootstrap/css/bootstrap.min.css" => "screen",
                "st/css/main.css" => "screen"

            );

            $scripts = array(
                "st/js/jquery.js",
                "st/plugins/bootstrap/js/bootstrap.min.js",
                "st/js/main.js"
            );

            $this->template->styles = array_merge($this->template->styles, $styles);
            $this->template->scripts = array_merge($this->template->scripts, $scripts);
        }

        parent::after();
    }
}
