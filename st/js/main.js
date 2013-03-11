
function isset(variable) {
    return (typeof(variable) !== 'undefined');
}

function labels(label) {

    var clear_label = label.toLowerCase();
    switch (clear_label) {
        case 'экшн': return 'http://www.emulroom.com/category/games/dendy/action/';
        case 'приключение': return 'http://www.emulroom.com/category/games/dendy/adventures/';
        case 'аркада': return 'http://www.emulroom.com/category/games/dendy/arcade/';
        case 'пистолет': return 'http://www.emulroom.com/category/games/dendy/pistol/';
        case 'гонка': return 'http://www.emulroom.com/category/games/dendy/racing/';
        case 'драка': return 'http://www.emulroom.com/category/games/dendy/fighting/';
        case 'квест': return 'http://www.emulroom.com/category/games/dendy/quest/';
        case 'логическая': return 'http://www.emulroom.com/category/games/dendy/logical-dendy/';
        case 'настольная': return 'http://www.emulroom.com/category/games/dendy/board-game/';
        case 'пазл': return 'http://www.emulroom.com/category/games/dendy/puzzle/';
        case 'платформер': return 'http://www.emulroom.com/category/games/dendy/platformer-dendy/';
        case 'ролевая': return 'http://www.emulroom.com/category/games/dendy/role-play-rpg/';
        case 'симулятор': return 'http://www.emulroom.com/category/games/dendy/simulators/';
        case 'стратегия': return 'http://www.emulroom.com/category/games/dendy/strategy-dendy/';
        case 'хоррор': return 'http://www.emulroom.com/category/games/dendy/horror/';
        case 'шутер': return 'http://www.emulroom.com/category/games/dendy/shooters/';
        case '1-2 игрока': return 'http://www.emulroom.com/tag/1-2-players/';
        case '1-4 игрока': return 'http://www.emulroom.com/tag/1-4-players/';
        case 'мультиплеер': return 'http://www.emulroom.com/tag/multiplayer/';
        case 'однопользовательский': return 'http://www.emulroom.com/tag/one-player/';
        case 'на двоих': return 'http://www.emulroom.com/category/games/dendy/two-players/';
        case 'кооператив': return 'http://www.emulroom.com/tag/cooperative/';
        case 'спорт': return 'http://www.emulroom.com/category/games/dendy/sport/';
    }
}

// Подсчет количества символов в переданом елементе jQuery
function countCharacters(object) {
    if ( (object != null) && (object.constructor === jQuery)) {
        return object.text().length;
    } else {
        return false;
    }
}


function getFormatedGame(id_game,callback) {
    var game_data = getGameById(id_game, function(result) {
        if(result) {
            // Считанные данные распределяем в массив построчно
            var
                game = {title:'', title_rus:'', date:'', genre:'', developer:'', mode:'', review:'', images:'', download:''},
                game_additionally, extra_labels = 'метки: ', extra_title = 'заголовок: ', extra_keywords = 'ключевые слова: ',
                game_data = [],
                data_array, img_count, title_clean, img_type, game_info, game_genres = '',
                temp_genres = [], temp_mode = [], game_mode = '';


            img_type = 'png';
            img_count = result.img_count;
            console.log(result.status);
            game.title = result.title;
            game.title_rus = result.title_rus;
            console.log('Название игры: ' + game.title);
            title_clean = game.title.split(' ').join('-').toLowerCase();
            console.log('Название игры для путей: ' + title_clean);
            game.date = result.year;
            game.developer = result.developer;

            // Собираем жанр игры
            game_genres = 'Жанр: ';
            $(result.genre.split(',')).each(function(index, element) {
                if (index == 0) {
                    game_genres += '<a href="' + labels(element) + '">' + element + '</a>';
                    game.genre += element;
                } else {
                    game_genres += ', ' + '<a href="' + labels(element) + '">' + element + '</a>';
                    game.genre += ',' + element;
                }
            });
            console.log('Выбранные жанры игры: ' + game.genre);
            console.log('Сформированая строка жанров игры:  ' + game_genres);

            // Собираем режимы игры
            game_mode = 'Режим игры: ';
            $(result.mode.split(',')).each(function(index, element) {
                if (index == 0) {
                    game_mode += '<a href="' + labels(element) + '">' + element + '</a>';
                    game.mode += element;
                } else {
                    game_mode += ', ' + '<a href="' + labels(element) + '">' + element + '</a>';
                    game.mode += ',' + element;
                }
            });
            console.log('Выбранные режимы игры: ' + game.mode);
            console.log('Сформированая строка режимов игры:  ' + game_mode);

            //Формируем метки
            extra_labels += game.genre + ',' + game.mode;
            console.log(extra_labels);

            //Формируем описание игры
            game.review = result.review;
            console.log('Обзор игры: ' + game.review);

            // Формируем картинки
            for (var x = 0; x < img_count; x++) {
                game.images += '<img title="' + game.title + '" src="http://st.emulroom.com/images/dendy/' + title_clean + '/'
                    + title_clean + '-(' + parseInt(x+1) + ')' +'.' + img_type + '" alt="' + game.title + ', ' + game.title_rus + ' денди игры, nes"  width="1280" height="780" />';
            }
            console.log('Изображения: ' + game.images);

            // Формируем блок с информацией об игре
            game_info = '<div class="gameInfo"> \n' +
                '<p>Дата выхода: ' + game.date + '</p> \n' +
                '<p>Разработчик: ' + game.developer + '</p> \n' +
                '<p>' + game_genres + '</p>\n' +
                '<p>' + game_mode + '</p>\n' +
                '</div>';

            // Ссылка на скачивание
            game.download = '<div class="gameDownload">' +
                '<strong><a class="icon-download" title="Скачать Денди игру ' + game.title + '"' +
                ' href="http://st.emulroom.com/games/dendy/' + title_clean + '.zip">Скачать ' + game.title + '</a></strong>' +
                '</div>';

            var game_all;
            game_all = game.images + game_info + '\n<div class="gameReview"> \n' + game.review + '\n</div>';
            game_all += '\n' + game.download;
            if(game.mode.indexOf('однопользовательский') + 1) {
                extra_labels = extra_labels.split('однопользовательский').join('на одного');
            }
            extra_labels += ', 8-бит, Денди игры, '+ game.developer.toLowerCase() + ', ' + game.date +'\n';
            if(game.title_rus != '') {
                extra_title += 'Денди игры » ' + game.title + ' / ' + game.title_rus + ' Скачать\n';
            } else {
                extra_title += 'Денди игры » ' + game.title + ' Скачать\n';
            }

            extra_keywords += 'денди игры, ' + game.title_rus.toLocaleLowerCase() + ', 8-бит, скачать игры для денди, ' + game.title.toLocaleLowerCase();
            if(game.mode.indexOf('на двоих') + 1) {
                extra_keywords += ', на двоих';
            }

            extra_keywords += '\n';

            // Вывод результатов
            callback (game_all + '\n' +extra_title + extra_labels + extra_keywords);
        } else {
            return false
        }
    });


}

// Получение игры по id
function getGameById(id_game, callback) {
    var val = {id_game:id_game, task:'select'}, result;
    $.ajax({type:"POST", async:true, data: val, url: "/hidden/getgames", dataType:"json",
        success:function(data){
            console.log(data);
            if(data.status == 'ok') {
                console.log('ok');
                result = data.games;
            } else {
                console.log('bad');
                result = false;
            }
            callback(result);
        },
        error:function(){
            console.log('error in ajax query, when add to favorite :(');
            result = false;
            callback(result);
        }
    });
}

// Получение массива игр из бд возврат в коллбэк функцию
function getGames(object,callback) {
    var val = {task:'select',limit:SETTINGS.limit, order_by:SETTINGS.order_by, page:1},
        result = false;

    if(isset(object)) {
        if(isset(object.limit)) {
            val.limit = object.limit;
        }
        if(isset(object.order_by)) {
            val.order_by = object.order_by;
        }
        if(isset(object.page)) {
            val.page = object.page;
        }
        if(isset(object.id_game)) {
            val.id_game = object.id_game;
        }
    }
    $.ajax({type:"POST", async:false, data: val, url: "/db.php", dataType:"json",
        success:function(data){
            if(data.status == 'ok') {
                console.log('ok');
                result = data.games;
            } else {
                console.log('bad');
                result = false;
            }
            callback(result);
        },
        error:function(){
            console.log('error in ajax query, when add to favorite :(');
            result = false;
            callback(result);
        }
    });
    return result;
}

// Формирование хтмл кода для вставки
function outputResults(games) {
    var adding = '', end = '', output_to = SETTINGS.output_block, table = output_to.find('table.game-list'), tbody = table.find('tbody');
    if(table.length && tbody.length) {
        console.log('table is exist');
    } else {
        console.log('table is not exist, will be create a new table');
        adding += '<table class="table game-list"><thead><tr><th class="id-game">id</th><th class="title-game">Заголовок</th><th class="img-count">img</th><th class="get-game-code"></th></tr></thead><tbody>';
        end += '</tbody></table>';
    }
    for(var i = 0; i < games.length; i++) {
        adding += '<tr class="hide">' +
                '<td class="tcentered">' + games[i].id_game + '<input type="hidden" class="hGameId" value="' + games[i].id_game + '"></td>' +
                '<td><span class="engl-title">' + games[i].title + '</span>  <span class="rus-title">' + games[i].title_rus + '</span></td>' +
                '<td class="tcentered">' + games[i].img_count + '</td>' +
                '<td><div class="btn-group"><button class="btn btn-primary btn-mini get-game-code">код</button>' +
            '<button class="btn dropdown-toggle btn-primary btn-mini" data-toggle="dropdown">' +
            '<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" class="show-code">показать</a></li>' +
            '</ul></div></td>' +
            '</tr>';
    }
    if(table.length && tbody.length) {
        tbody.append(adding);
    } else {
        adding += '</tbody></table>';
        output_to.html(adding);
    }
    $(".game-list .hide").each(function(index, element) {
        $(this).delay(100*index).fadeIn(300,function() {
            $(this).removeClass('hide');
        });
    });
    $('body').animate({scrollTop: table.height()}, 1000, function() {
    });
}

function drawGames(games) {
    getGames(games,function(game_result) {
        if(isset(game_result)) {
            outputResults(game_result);
        } else {
        }
    });
}


//
function markGameStatus(parametrs, callback) {

    $.ajax({type:"POST", async:true, data: parametrs, url: "/hidden/setGameStatus", dataType:"json",
        success:function(data) {
            console.log(data);
            if(data.status == 'ok') {
                callback(true);
            } else {
                callback(false);
            }
        },
        error:function(){
            callback(false);
        }
    });
}

$(document).ready(function() {
    SETTINGS = {output_block:$("#game-list"), limit:10, order_by:'title'};


    // Снимаем галочки с чекбоксов принужденно
    $(".game-list .check-as-posted").removeAttr('checked');

    // Нажатие клавиш в поле для воода обзоро игры
    $("#editable-txt-review").keyup(function() {
        var char_count = countCharacters($(this));
        if( char_count != false ) {
            $("#char-count").text(char_count);
        }
    });


    // Отметка игры как уже опубликованой
    $(".check-as-posted").on("change", function() {
        var game_id = $(this).val();
        if($(this).attr('checked')) {
            markGameStatus({game_id:game_id, posted:"yes"}, function(status) {
                if(status == false) {
                    $(this).removeAttr('checked');
                }
            });
        } else {
            markGameStatus({game_id:game_id, posted:"no"}, function(status) {
                if(status == false) {
                    $(this).attr('checked','checked');
                }
            });
        }
    });

    $("#to-redact-review").click(function() {
        if($(this).hasClass('redacting')) {
            $(this).removeClass('redacting');
            $(this).html(' <i class="icon-edit"></i> редактировать </a>');
            $("#editable-txt-review").removeAttr('contenteditable');
        } else {
            $(this).addClass('redacting');
            $(this).html(' <i class="icon-check"></i> блокировать </a>');
            $("#editable-txt-review").attr('contenteditable','true');
        }
    });
    $("#btn-check-text").click(function() {
        var val = {text:'',lang:'ru,en'};
        val.text = $("#editable-txt-review").text();
        $.ajax({type:"POST", async:true, data: val, url: "http://speller.yandex.net/services/spellservice.json/checkText?", dataType:"json",
            success:function(data){
                CHECKED_TEXT = data;
                for(var i in data) {
                    val.text = val.text.split(data[i].word).join('<a class="bad-word">' + data[i].word + '</a>');
                }
                console.log(val.text);
                $("#editable-txt-review").html(val.text);
            },
            error:function(){
                console.log('error in ajax query, when add to favorite :(');
            }
        });
    });

    $(".bad-word").live('click',function() {
        console.log('text to check ' + $(this).text());
        for(var i in CHECKED_TEXT) {
            if(CHECKED_TEXT[i].word == $(this).text()) {
                console.log('variants ' + CHECKED_TEXT[i].s);
                $(".word-variants").text($(this).text());
                var some = '<a class="variant-word">' + CHECKED_TEXT[i].s.join('</a><a class="variant-word">') + '</a>';
                if(CHECKED_TEXT[i].s != '') {
                    $(".variants").html(some);
                } else {
                    $(".variants").html('нет вариантов');
                }

            }
        }
    });

    $(".variant-word").live('click',function() {
        var curr = $("#editable-txt-review").html();
        $("#editable-txt-review").html(curr.split('<a class="bad-word">' + $(".word-variants").text() + '</a>').join($(this).text()));
        $(".word-variants").html('');
        $(".variants").html('');
    });

    $(".show-code, .get-game-code").live('click',function() {
        var id_game, this_btn = $(this);
        id_game = $(this).closest('tr').find('.hGameId').val();
        getFormatedGame(id_game,function(result){
            if(this_btn.hasClass('show-code') || this_btn.hasClass('get-game-code')) {
                $("#generated-code").html(result);
                $("#modal-game-code").modal('show');
            }
            else if(this_btn.hasClass('get-game-code')) {
            }

        });
    });

    $("#copy").click(function() {
        $("#generated-code").focus().select();
    });

    $("#next-page").click(function() {
        if(!$(this).hasClass('disabled')) {
            var val = {curr_page:null, next_page:null, func_result:false}, obj = {curr_page:null};
            obj.curr_page = $("#curr-page");
            val.curr_page = parseInt(obj.curr_page.val());
            if($(this).attr('id') == 'next-page') {
                val.next_page = ++val.curr_page;
            }
            drawGames({page:val.next_page});
            obj.curr_page.val(val.next_page);
        }
    });

    // Перевод фокуса ввода на название игры
    $("#game-text").focus();

    // Очистка формы
    $("#clear-form").click(function() {
        $("#game-text").val('');
        $("#game-text-rus").val('');
        $("#developer").val('');
        $("#editable-txt-review").html('');
        $(".uncheck-all").click();
        $("#game-text").focus();
    });


    // Выбор жанра игры
    $(".game-genre").click(function() {
        if($(this).hasClass('active')) {
            $(this).find('.ch-genre').removeAttr('checked');
            $(this).removeClass('active');
        } else {
            $(this).find('.ch-genre').attr('checked','checked');
            $(this).addClass('active');
        }

    });

    // Выбор режима игры
    $(".game-mode").click(function() {
        if($(this).hasClass('active')) {
            $(this).find('.ch-mode').removeAttr('checked');
            $(this).removeClass('active');
        } else {
            $(this).find('.ch-mode').attr('checked','checked');
            $(this).addClass('active');
        }
    });

    // Снятие всех отметок
    $(".uncheck-all").click(function() {
        $(this).closest('div').find('.active').removeClass('active');
        $(this).closest('div').find($("input[type=checkbox]")).removeAttr('checked');
    });

    // Добавление игры в базу данных
    $("#btn-add-game").click(function() {
        var val = {task:'insert',title:'',title_rus:'',review:'',img_count:0,genre:'',mode:'',developer:'',year:'1980'},
            length = 0,
            obj = {icon_loading:null, icon_status:null};
        obj.icon_loading = $(".add-game .icon-loading");
        obj.icon_status = $(".add-game .status");
        val.title = $("#game-text").val();
        val.title_rus = $("#game-text-rus").val();
        val.developer = $("#developer").val();
        val.img_count = $("#img-count").val();
        val.year = $("#year").val();
        val.review = $("#editable-txt-review").text();
        length = $(".ch-genre[checked=checked]").length;
        $(".ch-genre[checked=checked]").each(function(index, element){
            if((index + 1) < length) {
                val.genre += $(this).val() + ',';
            } else {
                val.genre += $(this).val();
            }
        });

        length = $(".ch-mode[checked=checked]").length;
        $(".ch-mode[checked=checked]").each(function(index, element){
            if((index + 1) < length) {
                val.mode += $(this).val() + ',';
            } else {
                val.mode += $(this).val();
            }
        });

        obj.icon_loading.show();
        obj.icon_status.hide();
        $.ajax({type:"POST", async:true, data: val, url: "/hidden/addgame", dataType:"json",
            success:function(data){
                console.log(data);
                if(data.status == 'ok') {
                    console.log('ok');
                    obj.icon_status.show(100,function() {
                        setTimeout(function() {
                            obj.icon_status.fadeOut(300);
                        }, 3000);
                    });
                } else {
                    console.log('bad');
                }
                obj.icon_loading.hide();
            },
            error:function(){
                console.log('error in ajax query, when add to favorite :(');
                obj.icon_loading.hide();
            }
        });

    });



    // Проверка текста на орфографию
    $(".is-checked").live('click',function() {
        var obj = {loading:null, success:null},
            val = {id:null,review:null};
        obj.loading = $(this).closest('div').find('.icon-loading');
        obj.success = $(this).closest('div').find('.status');
        val.id = $(this).closest('div').find('.text-to-check').attr('data-id');
        val.review = $(this).closest('div').find('.text-to-check').text();
        obj.loading.show();

        $.ajax({type:"POST", async:true, data: val, url: "/hidden/ischecked", dataType:"json",
            success:function(data) {
                console.log(data);
                if(data.status == 'ok') {
                    console.log('ok');
                    obj.success.fadeIn(300);
                } else {
                    console.log('bad');
                }
                obj.loading.hide();
            },
            error:function(){
                console.log('error in ajax query, when update game review :(');
                obj.loading.hide();
            }
        });
    });

});