<div class="check-info">
    Проверно игр: <span><?=$checked_count?></span>
    Осталось: <span><?=$remain_to_check;?></span>
</div>

<?foreach($games as $game):?>
    <div class="content" style="margin: 0 auto 30px auto;">
        <div>
            <h5 style="color: #555;"><?=$game->title;?></h5>
            <div class="text-to-check" data-id="<?=$game->id_game;?>" contenteditable="true" style="padding: 10px;border: 1px solid #ccc; border-radius: 3px; min-height: 100px; margin-bottom: 10px;background-color: #ffffff; "><?=$game->review;?></div>
            <button class="is-checked btn btn-success">Проверено</button>
            <span class="icon-loading hide"><img src="/st/img/loading.gif" /></span>
            <span class="status" style="padding:0 0 0 20px;margin-left: 5px;color: green;background: url('/st/img/ok.png') no-repeat left top; display: none; vertical-align: middle;">Игра успешно добавлена в базу</span>
        </div>
    </div>
<?endforeach;?>
<a class="btn btn-large btn-primary" href="/games/check">Следующие</a>