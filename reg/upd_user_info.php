<?php
$username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
$email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
$login = trim(htmlspecialchars($_POST['login'], ENT_QUOTES));
$old_pass = trim(htmlspecialchars($_POST['old_pass'], ENT_QUOTES));
$new_pass = trim(htmlspecialchars($_POST['new_pass'], ENT_QUOTES));

$error = '';

if(strlen($username) <= 3)
    $error = 'Введите имя';
if(strlen($email) <= 3)
    $error = 'Введите email';
if(strlen($login) <= 3)
    $error = 'Введите логин';
if(strlen($old_pass) <= 3)
    $error = 'Введите старый пароль';
if(strlen($new_pass) <= 3)
    $error = 'Введите новый пароль';

if($error != '') {
    echo $error; // ToDo: show error msg in form
    header('Location: /user_info.php'); // ToDo: remake with fetch
    exit();
}

$hash = "kajshfkasjfhaksjf";
$old_pass_hash = md5($old_pass . $hash);
$new_pass_hash = md5($new_pass . $hash);

require_once '../mysql_connect.php';

$sql = 'SELECT id FROM `users` WHERE `login` = :login && `pass` = :pass';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'pass' => $old_pass_hash]);
$user = $query->fetch(PDO::FETCH_OBJ); // попытка найти пользователя с вве

if(!empty($user)) {
    $sql = 'UPDATE `users` SET `name` = ?, `email` = ?, `login` = ?, `pass` = ? WHERE `id` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$username, $email, $login, $new_pass, $user->id]);
    echo "Готово";
} else {
    echo 'Не удалось обновить данные пользователя'; // ToDo: show error msg in form
}

header('Location: /user_info.php'); // ToDo: remake with fetch