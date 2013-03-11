<div class="dv-block add-game">
    <header>
        <h3>Добавление новой игры в каталог</h3>
    </header>
    <div class="content">
        <div>
            <div class="inline">
                <h5>Оригинальное название</h5>
                <input type="text" name="text" id="game-text" class="span6" placeholder="Название игры на английском языке">
            </div>
            <div class="inline">
                <h5>Перевод</h5>
                <input type="text" name="text" id="game-text-rus" class="span6" placeholder="Русскоязычное название. Может оставаться пустым">
            </div>
        </div>
        <div>
            <div class="inline margin-right-10">
                <h5>Разработчик</h5>
                <input type="text" id="developer" class="span4" placeholder="Если их несколько разделять запятой">
            </div>

            <div class="inline margin-right-10">
                <h5>Картинок</h5>
                <select id="img-count" class="span1">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="inline margin-right-10">
                <h5>Год выпуска</h5>
                <select id="year" class="span2">
                    <? for($i = 1980; $i < 1995; $i++): ?>
                        <option value="<?=$i?>"><?=$i?></option>
                    <? endfor; ?>
                </select>
            </div>
        </div>
        <div class="dv-genre">
            <h5>Жанр: <a class="uncheck-all"> <i class="icon-check"></i> снять все </a></h5>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="аркада">Аркада</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="гонка">Гонка</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="драка">Драка</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="квест">Квест</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="логическая">Логическая</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="платформер">Платформер</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="приключение">Приключение</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="ролевая">Ролевая</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="симулятор">Симулятор</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="спорт">Спорт</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="стратегия">Стратегия</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="шутер">Шутер</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="экшн">Экшн</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="пистолет">Для пистолета</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="хоррор">Хоррор</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="квест">Квест</span>
            <span class="game-genre"><input type="checkbox" class="ch-genre" name="genre" value="пазл">Пазл</span>
        </div>
        <div class="dv-mode">
            <h5>Режим игры: <a class="uncheck-all"> <i class="icon-check"></i> снять все </a></h5>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="однопользовательский">Однопользовательский</span>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="мультиплеер">Мультиплеер</span>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="кооператив">Кооператив</span>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="1-2 игрока">1-2 игрока</span>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="1-4 игрока">1-4 игрока</span>
            <span class="game-mode"><input type="checkbox" class="ch-mode" name="mode" value="на двоих">На двоих</span>
        </div>
        <div class="dv-review">

            <!--<textarea id="txt-review"></textarea>-->
            <div id="game-review">
                <h5>Обзор игры: <a href="#"  id="to-redact-review"> <i class="icon-check"></i> блокировать </a></h5>
                <div id="editable-txt-review" contenteditable="true"></div>
            </div>
            <div id="speller">
                <h5>Спеллер:</h5>
                <div id="words-variants">
                    <div class="word-variants"></div>
                    <div class="variants"></div>
                </div>
            </div>
            <div id="char-info">Количество символов: <span id="char-count">0</span></div>
            <div style="clear: both;"></div>

        </div>
        <button class="btn btn-large btn-primary" id="btn-add-game">Добавить игру</button>
        <button class="btn btn-large  " id="btn-check-text">Проверить орфографию</button>
        <button class="btn btn-large  " id="clear-form">Очистить форму</button>
        <span class="icon-loading"><img src="/st/img/loading.gif" /></span>
        <span class="status">Игра успешно добавлена в базу</span>
    </div>
    <footer></footer>
</div>