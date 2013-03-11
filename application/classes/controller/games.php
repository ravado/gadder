<?php defined('SYSPATH') or die('No direct script access.');
    /*
    * Контроллер связанный с пользователем в том числе авторизация его
    */
class Controller_Games extends Controller_Base {


    public function action_index() {

    }

    /*Показываем главную страницу сайта*/
    public function action_list(){

        $this->template->title = "Список игр";
        $this->template->current_page = "list";

        $data['sort'] = Arr::get($_GET,'sort');
        if($data['sort'] == 'posted' || $data['sort'] == 'new') {
        } else {
            $data['sort'] = 'new';
        }
        $data['page'] = Arr::get($_GET,'page');
        if(empty($data['page'])) {
            $data['page'] = 1;
        }

        /*Проверяем статус пользователя (Авторизирован или нет)*/
        $auth = Auth::instance();
        if($auth->logged_in()) {
            $data['is_auth'] = true;
            $data['username'] = $auth->get_user()->username;
        } else {
            $data['is_auth'] = false;
            $this->request->redirect('/auth/login');
        }

        $result = Model::factory('Mgames')->getGameList($data['page'],$data['sort']);
        if($result) {
            $data['games'] = $result['games'];
            $data['count'] = $result['count'];
            $data['pages'] = ceil($result['count']/20);
        }

        $this->template->content = View::factory('games/vGameList',$data);
    }

    /*Показываем главную страницу сайта*/
    public function action_addgame(){

        $this->template->title = "Добавление игр";
        $this->template->current_page = "addgame";


        /*Проверяем статус пользователя (Авторизирован или нет)*/
        $auth = Auth::instance();
        if($auth->logged_in()) {
            $data['is_auth'] = true;
            $data['username'] = $auth->get_user()->username;
        } else {
            $data['is_auth'] = false;
            $this->request->redirect('/auth/login');
        }

        $this->template->content = View::factory('games/vAddGame',$data);
    }

    public function action_check(){

        $this->template->title = "Проверка игр";
        $this->template->current_page = "check";


        /*Проверяем статус пользователя (Авторизирован или нет)*/
        $auth = Auth::instance();
        if($auth->logged_in()) {
            $data['is_auth'] = true;
            $data['username'] = $auth->get_user()->username;
        } else {
            $data['is_auth'] = false;
            $this->request->redirect('/auth/login');
        }

        $data['games'] = ORM::factory('ormgame')->where('is_checked','=','0')->limit(20)->find_all();
        $this->template->content = View::factory('games/vCheckGames',$data);
    }
}
?>