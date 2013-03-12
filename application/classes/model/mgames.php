<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mgames extends Model_Database {
    public function getGameList($page, $sort) {
        $offset = ($page-1)*20;
        if($sort == 'new') {
            $games['count'] = ORM::factory('ormgame')->where('is_posted','=','0')->count_all();
            $games['games'] = ORM::factory('ormgame')->where('is_posted','=','0')->limit(20)->offset($offset)->find_all();
        } elseif ($sort == 'posted') {
            $games['count'] = ORM::factory('ormgame')->where('is_posted','=','1')->count_all();
            $games['games'] = ORM::factory('ormgame')->where('is_posted','=','1')->limit(20)->offset($offset)->find_all();
        } else {
            $games = false;
        }

        return $games;
    }

    public function markChecked($id_game, $review) {
        $id_game = (int)$id_game;
        $review = strip_tags($review);
        $game = ORM::factory('ormgame',$id_game);
        if($game->loaded()) {

            $game->is_checked = 1;
            $game->review = $review;
            $game->save();
            if($game->saved()) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }


    public function addGame($data) {
        $game = ORM::factory('ormgame');
        $game->title = $data['title'];
        $game->title_rus = $data['title_rus'];
        $game->review = $data['review'];
        $game->img_count = $data['img_count'];
        $game->genre = $data['genre'];
        $game->mode = $data['mode'];
        $game->developer = $data['developer'];
        $game->year = $data['year'];
        $game->save();
        if($game->saved()) {
            return true;
        } else {
            return false;
        }
    }

    public function getGame($id) {
        $game = ORM::factory('ormgame',$id);
        if($game->loaded()) {
            $result['id_game'] = $game->id_game;
            $result['title'] = $game->title;
            $result['title_rus'] = $game->title_rus;
            $result['review'] = $game->review;
            $result['img_count'] = $game->img_count;
            $result['genre'] = $game->genre;
            $result['mode'] = $game->mode;
            $result['developer'] = $game->developer;
            $result['year'] = $game->year;
            return $result;
        } else {
            return false;
        }
    }

    public function setGameStatus($games_id, $posted) {
        try {
            $games_id = (array)$games_id;

            if($posted == "yes") { $status = '1';}
            elseif( $posted == "no") { $status = '0';}

            foreach ($games_id as $val) {
                $game = ORM::factory('ormgame', (int)$val);
                if ($game->loaded()) {
                    $game->is_posted = $status;
                    $game->save();
                }
            }
        } catch(Exception $ex) {
            return false;
        }
        return true;
    }

    // Удаление игр из базы данных
    public function deleteGames($games_id) {
        try {
            $games_id = (array)$games_id;

            foreach ($games_id as $val) {
                $game = ORM::factory('ormgame', (int)$val);
                if ($game->loaded()) {
                    $game->delete();
                }
            }
        } catch(Exception $ex) {
            return false;
        }
        return true;
    }

}