<?
$ext_orderby = '';
?>
<nav>
    <ul class="game-menu">
        <li><a href="?&sort=new" class="<? if($sort == 'new') echo 'active'; ?> "><i class="icon-inbox"></i> новые</a></li>
        <li><a href="?&sort=posted" class="<? if($sort == 'posted') echo 'active'; ?>"><i class="icon-flag"></i> опубликованые</a></li>
    </ul>
</nav>
<table class="table game-list">
    <thead>
        <tr>
            <th class="id-game">id</th>
            <th class="posted">*</th>
            <th class="title-game">Заголовок</th>
            <th class="img-count">img</th>
            <th class="get-game-code"></th>
        </tr>
    </thead>
    <tbody>
        <? foreach($games as $game): ?>
        <tr>
            <td class="tcentered id-games"><?=$game->id_game;?><input type="hidden" class="hGameId" value="<?=$game->id_game;?>"></td>
            <td class="tcentered is-posted"><input type="checkbox" value="<?=$game->id_game;?>" class="game-action"></td>
            <td>
                <span class="engl-title"> <? if(!$game->is_checked) echo '<i class="icon-refresh"></i>  '; ?><?=$game->title;?></span>
                <span class="rus-title"><?=$game->title_rus;?></span>
            </td>
            <td class="tcentered img-count"><?=$game->img_count;?></td>
            <td>
                <button class="btn btn-primary btn-mini get-game-code">код</button>
            </td>
        </tr>
        <? endforeach;?>
    </tbody>
</table>
<nav>
    <ul class="game-menu">
        <li><a class="remove-games"><i class="icon-trash"></i> удалить</a></li>
        <li><a class="mark-as-published"><i class="icon-trash"></i> опубликована</a></li>
    </ul>
</nav>


<!--  pagination  -->
<? if($pages > 1) :?>
<div class="pagination pagination-centered">
    <ul>
        <? $extra_tags = '?' .$ext_orderby; ?>

        <? if($page > 1) echo '<li><a href="'.$extra_tags .'&page=' .($page - 1) .'">«</a></li>';
    else echo ''?>
        <?
        $start = 0;
        $end = $pages;
        if(($page - 10) > 1) {
            echo '<li class="active"><a>...</a></li>';
            $start = ($page - 11);
        }
        if(($page + 10) < $pages) {
            $end = ($page + 10);
        }
        ?>
        <? for($i = $start; $i < $end; $i++): ?>
        <? if($page == ($i+1)) {
            echo '<li class="active"><a>'.$page .'</a></li>';
        } else if($i >= 0 && $i < $pages) echo '<li><a href="'.$extra_tags .'&page=' .($i+1) .'">' .($i+1) .'</a></li>'; ?>
        <? endfor; ?>
        <? if($page + 10 < ($pages)) echo '<li class="active"><a>...</a></li>'; ?>
        <? if($page < $pages) echo '<li><a href="'.$extra_tags .'&page=' .($page + 1) .'">»</a></li>'; else echo ''?>

    </ul>
</div>
<? endif; ?>

<!-- Modal -->
<div class="modal hide span9"  tabindex="-1" id="modal-game-code" data-show="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 id="myModalLabel">Сгенерированая верстка</h3>
    </div>
    <div class="modal-body" >
        <textarea style="width: 510px; height: 350px;" id="generated-code"></textarea>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal">Закрыть</button>
        <button class="btn btn-primary" id="copy">Выделить все</button>
    </div>
</div>