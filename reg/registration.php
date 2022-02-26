<?php
$username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
$email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
$login = trim(htmlspecialchars($_POST['login'], ENT_QUOTES));
$pass = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES));

require_once '../mysql_connect.php';

$sql = 'SELECT * FROM `users` WHERE `login` = ?';
$query = $pdo->prepare($sql);
$query->execute([$login]);
$user = $query->fetch(PDO::FETCH_OBJ);

$error = '';
if(!empty($user))
    $error .= "пользователь с таким логином уже зарегистрирован <br />";
if(strlen($username) <= 3)
    $error .= "имя короткое <br />";
if(strlen($email) <= 3)
    $error .= 'email короткий <br />';
if(strlen($login) <= 3)
    $error .= 'логин короткий <br />';
if(strlen($pass) <= 3)
    $error .= 'пароль короткий <br />';
if($error != '') {
    http_response_code(400);
    echo $error;
    exit();
}

$hash = "kajshfkasjfhaksjf";
$pass = md5($pass . $hash);

$sql = 'INSERT INTO users(name, email, login, pass) VALUES (?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $pass]);

http_response_code(200);
echo "Успешная регистрация";