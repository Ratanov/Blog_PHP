<?php
if(!isset($_COOKIE['login'])){
    header('Location: /');
    exit();
}

require_once 'mysql_connect.php';

$sql = 'SELECT * FROM `users` WHERE `login` = :login';
$query = $pdo->prepare($sql);
$query->execute(['login' => $_COOKIE['login']]);

$user = $query->fetch(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        $website_title = 'Кабинет пользователя';
        require 'layouts/head.php';
    ?>
</head>
<body>
    <?php require 'layouts/header.php'; ?>

    <main class="container mt-5">
        <div class="row">
            <div class="col-8">
                <h4>Персональные данные</h4>
                <form action="reg/upd_user_info.php" method="post">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?=$user->name?>">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?=$user->email?>">

                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" class="form-control" value="<?=$user->login?>" readonly="readonly">

                    <label for="pass">Старый пароль</label>
                    <input type="password" name="old_pass" id="old_pass" class="form-control">

                    <label for="pass">Новый пароль</label>
                    <input type="password" name="new_pass" id="new_pass" class="form-control">

                    <div class="alert alert-danger mt-3" id="error-block"></div>

                    <button class="btn btn-success mt-3" id="upd_user">Обновить данные</button>
                </form>
            </div>
            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>

    <?php require 'layouts/footer.php'; ?>
</body>
</html>