<!doctype html>
<html lang="en">
<head>
    <?php
    $website_title = 'Авторизация';
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

                    <div class="alert alert-danger mt-3" id="error-block"></div>

                    <button type="button" class="btn btn-success mt-3" id="auth_user">Войти</button>
                </form>
                <?php endif; ?>
            </div>

            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>
    <?php require 'layouts/footer.php'; ?>


    <script> // ToDo: remake with fetch
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
                        document.location.replace('/');
                    }
                    else {
                        $('#error-block').show().text(data);
                    }
                }
            });
        })
    </script>
</body>
</html>