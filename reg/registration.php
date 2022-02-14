<?php
$username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
$email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
$login = trim(htmlspecialchars($_POST['login'], ENT_QUOTES));
$pass = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES));

$error = '';

if(strlen($username) <= 3)
    $error = 'Введите имя';
if(strlen($email) <= 3)
    $error = 'Введите email';
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

$sql = 'INSERT INTO users(name, email, login, pass) VALUES (?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $pass]);

echo "Готово";