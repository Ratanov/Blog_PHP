<?php
$login = trim(htmlspecialchars($_POST['login'], ENT_QUOTES));
$pass = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES));

$error = '';

if(strlen($login) <= 3)
    $error = 'Введите логин';
if(strlen($pass) <= 3)
    $error = 'Введите пароль';

if($error != '') {
    echo $error;
    exit();
}

$hash = "kajshfkasjfhaksjf";
$pass = md5($pass . $hash);

require_once '../mysql_connect.php';

$sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `pass` = :pass';
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'pass' => $pass]);

$user = $query->fetch(PDO::FETCH_OBJ);
if(!isset($user->id))
    echo 'Неправильное имя пользователя или пароль';
else {
    setcookie('login', $login, time() + 3600 * 24 * 30, '/');
    echo "Готово";
}