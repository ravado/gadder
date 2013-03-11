<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер связанный с пользователем в том числе авторизация его
 */
class Controller_Auth extends Controller_Base {

    public $template = "vBase";
    public $data = array();

    public function action_index(){

    }

    /* Авторизация пользователя */
    public function action_login(){
        $this->template->title = "Авторизация";
        $this->template->current_page = "auth";

        $post = Validation::factory($_POST)
            ->rule('username','not_empty')
            ->rule('username','alpha')
            ->rule('password','not_empty');
        if($post->check()) {
            if(Auth::instance()->login($post['username'], $post['password'], FALSE)) {
                if(Auth::instance()->logged_in(array('admin'))) {
                    $this->request->redirect('/games/list');
                } else {
                    $this->request->redirect('/games/check');
                }

            }
        }

        $auth = Auth::instance();
        if($auth->logged_in()) {
            $data['is_auth'] = true;
            $data['username'] = $auth->get_user()->username;
            if($auth->logged_in(array('admin'))) {
                $this->request->redirect('/');
            } else {
                $this->request->redirect('/games/check');
            }

        } else {
            $data['is_auth'] = false;
        }
        $this->template->content = View::factory('vAuth',$data);
    }

    public function action_logout(){
        $this->template->title = "Выход";
        $this->template->current_page = "logout";
        Auth::instance()->logout();
        $this->request->redirect('/auth/login');
    }

}
