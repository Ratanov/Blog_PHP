<?php
$username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
$mess = trim(htmlspecialchars($_POST['mess'], ENT_QUOTES));
$article_id = trim(htmlspecialchars($_POST['article_id'], ENT_QUOTES));

$error = '';

if(strlen($username) <= 3)
    $error = 'Введите имя';
if(strlen($mess) <= 15)
    $error = 'Введите сообщение';

if($error != '') {
    echo $error;
    exit();
}

require_once '../mysql_connect.php';

$sql = 'INSERT INTO comments(name, mess, article_id, date) VALUES (?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $mess, $article_id, time()]);

echo "Готово";