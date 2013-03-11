<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title><?=$title;?></title>
    <link rel="shortcut icon" href="/st/img/favicon.ico" type="image/x-icon" />
    <?php foreach($styles as $file => $type){echo HTML::style($file, array('media' => $type)), "\n";} ?>
    <?php foreach($scripts as $file){echo HTML::script($file, NULL, TRUE),"\n";} ?>
</head>
<body>
    <nav id="main-menu">
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand">Gadder</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <? $auth = Auth::instance(); if($auth->logged_in(array('login', 'admin'))): ?>
                            <li class="<?if($current_page == 'list') echo 'active'; ?>">
                                <a href="/games/list">Список игр</a>
                            </li>
                            <li class="<?if($current_page == 'addgame') echo 'active'; ?>">
                                <a href="/games/addgame">Добавить игру</a>
                            </li>
                            <? endif; ?>
                            <li class="<?if($current_page == 'check') echo 'active'; ?>">
                                <a href="/games/check">Проверка игр</a>
                            </li>
                            <? if($auth->logged_in()): ?>
                                <li>
                                    <a href="/auth/logout">Выход</a>
                                </li>
                            <?else:?>
                                <li class="<?if($current_page == 'auth') echo 'active'; ?>">
                                    <a href="/auth/login">Авторизация</a>
                                </li>
                            <?endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section id="content">
        <?=$content;?>
    </section>
    <footer></footer>
</body>
</html>