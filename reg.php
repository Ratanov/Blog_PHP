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
                <h4>Форма регистрация</h4>
                <form action="" method="post">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="username" id="username" class="form-control">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">

                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" class="form-control">

                    <label for="pass">Пароль</label>
                    <input type="password" name="pass" id="pass" class="form-control">

                    <div class="alert alert-danger mt-3" id="errorBlock"></div>

                    <button type="button" class="btn btn-success mt-3" id="reg_user">Зарегистрироваться</button>
                </form>
            </div>
            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>
    <?php require 'layouts/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#reg_user').click(function () {
            // alert('1');
            const name = $('#username').val();
            const email = $('#email').val();
            const login = $('#login').val();
            const pass = $('#pass').val();

            $.ajax({
                url: 'reg/registration.php',
                type: 'POST',
                cache: false,
                data: {'username': name, 'email': email, 'login': login, 'pass': pass},
                dataType: 'html',
                // beforeSend: function () {
                //
                // }
                success: function (data) {
                    if(data == "Готово") {
                        $('#reg_user').text('Все готово').attr('disabled','disabled');
                        $('#errorBlock').hide();
                    }
                    else {
                        $('#errorBlock').text(data).show();
                    }
                }
            });
        })
    </script>
</body>
</html>