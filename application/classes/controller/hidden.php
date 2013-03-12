<?php defined('SYSPATH') or die('No direct script access.');
    /*
    * Контроллер отвечает за невидимые операции
    */
class Controller_Hidden extends Controller{

    public function action_index(){

    }

    public function action_IsChecked() {
        $id = Arr::get($_POST,'id');
        $review = strip_tags(Arr::get($_POST,'review'));
        if(!empty($id) && !empty($review)) {
            $returned = Model::factory('Mgames')->markChecked($id, $review);
            if($returned) {
                $result['status'] = 'ok';
            } else {
                $result['status'] = 'bad';
            }
        } else {
            $result['status'] = 'bad';
        }
        echo json_encode($result);
    }

    public function action_addgame() {
        $data['title'] = $_POST['title'];
        $data['title_rus'] = $_POST['title_rus'];
        $data['review'] = $_POST['review'];
        $data['img_count'] = $_POST['img_count'];
        $data['genre'] = $_POST['genre'];
        $data['mode'] = $_POST['mode'];
        $data['developer'] = $_POST['developer'];
        $data['year'] = $_POST['year'];
        $returned = Model::factory('Mgames')->addGame($data);
        if($returned) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'bad';
        }
        echo json_encode($result);
    }

    public function action_getgames() {
        $id = $_POST['id_game'];
        $returned = Model::factory('Mgames')->getGame($id);
        if($returned) {
            $result['status'] = 'ok';
            $result['games'] = $returned;
        } else {
            $result['status'] = 'bad';
        }
        echo json_encode($result);
    }

    public function action_setGameStatus() {
        $games_id = (array)$_POST['games_id'];
        $posted = $_POST['posted'];
        $returned = Model::factory('Mgames')->setGameStatus($games_id, $posted);
        if($returned) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'bad';
        }
        echo json_encode($result);
    }

    public function action_delGames() {
        $games_id = (array)$_POST['games_id'];
        $returned = Model::factory('Mgames')->deleteGames($games_id);
        if($returned) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'bad';
        }
        echo json_encode($result);
    }

}