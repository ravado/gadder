<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер главной страницы сайта
 * Также имеет экшены для показа второстепенных страниц: Контакты, О Сайте, Поддержка
 */
class Controller_Home extends Controller_Base {

    public $template = "vBase";
    public $data = array();

    /*Показываем главную страницу сайта*/
    public function action_index(){

        $this->template->title = "Список игр";
        $this->template->current_page = "main";

        /*Проверяем статус пользователя (Авторизирован или нет)*/
        $auth = Auth::instance();
        if($auth->logged_in()) {
            $data['is_auth'] = true;
            $data['username'] = $auth->get_user()->username;
        } else {
            $data['is_auth'] = false;
            $this->request->redirect('/auth/login');
        }

        $this->template->content = View::factory('home/vHome',$data);
    }



}
