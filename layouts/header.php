<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a href="/" class="navbar-brand">Блог</a>
        <div class="d-flex ml-auto">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#globalNavbar" aria-controls="globalNavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
        <div class="collapse navbar-collapse justify-content-between" id="globalNavbar">
            <ul class="navbar-nav mr-auto order-1">
                <li class="nav-item"><a class="nav-link" href="/">Ссылка 1</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Ссылка 2</a></li>
                <?php
                    if(isset($_COOKIE['login']))
                        echo '<li class="nav-item"><a class="nav-link" href="/article.php">Добавить статью</a></li>';
                ?>
            </ul>

            <?php if(!isset($_COOKIE['login'])): ?>
            <ul class="navbar-nav d-none d-lg-flex ml-2 order-3">
                <li class="nav-item"><a class="nav-link" href="/auth.php">Войти</a></li>
                <li class="nav-item"><a class="nav-link" href="/reg.php">Регистрация</a></li>
            </ul>
            <ul class="navbar-nav d-lg-none">
                <li class="nav-item-divider"></li>
                <li class="nav-item"><a class="nav-link" href="/auth.php">Войти</a></li>
                <li class="nav-item"><a class="nav-link" href="/reg.php">Регистрация</a></li>
            </ul>

            <!-- вывод в шапку приветствия и кнопки выхода для пользователя с помощью подключения шаблонов .tpl -->
            <?php else:
                $username = $_COOKIE['login'];
                $user_panel = file_get_contents("layouts/user_panel.tpl");
                $user_panel = str_replace("{username}", $username, $user_panel);
                echo $user_panel;
             endif; ?>
        </div>
    </div>

    <!-- Кнопка для открытия модального окна -->
    <button data-modal class="btn btn-contact">Связаться с нами</button>
</nav>