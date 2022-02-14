<!doctype html>
<html lang="en">
<head>
    <?php
    $website_title = 'Регистрация';
    require 'layouts/head.php';
    ?>
</head>
<body>
    <?php require 'layouts/header.php'; ?>
    <main class="container mt-5">
        <div class="row">
            <div class="col-8">
                <?php if(!isset($_COOKIE['login'])): ?>
                <h4>Форма авторизации</h4>
                <form action="" method="post">
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" class="form-control">

                    <label for="pass">Пароль</label>
                    <input type="password" name="pass" id="pass" class="form-control">

                    <div class="alert alert-danger mt-3" id="errorBlock"></div>

                    <button type="button" class="btn btn-success mt-3" id="auth_user">Войти</button>
                </form>
                <?php else: ?>
                <h2><?=$_COOKIE['login']?></h2>
                    <button class="btn btn-danger" id="exit_btn">Выйти</button>
                <?php endif; ?>
            </div>

            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>
    <?php require 'layouts/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#auth_user').click(function () {
            const login = $('#login').val();
            const pass = $('#pass').val();

            $.ajax({
                url: 'reg/authorization.php',
                type: 'POST',
                cache: false,
                data: {'login': login, 'pass': pass},
                dataType: 'html',
                success: function (data) {
                    if(data === "Готово") {
                        document.location.reload(true);
                    }
                    else {
                        $('#errorBlock').show().text(data);
                    }
                }
            });
        })

        $('#exit_btn').click(function () {
            const login = $('#login').val();
            const pass = $('#pass').val();

            $.ajax({
                url: 'reg/exit.php',
                type: 'POST',
                cache: false,
                data: {'login': login, 'pass': pass},
                dataType: 'html',
                success: function (data) {
                    document.location.reload(true);
                }
            });
        })
    </script>
</body>
</html>