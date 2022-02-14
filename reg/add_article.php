<?php
$title = trim(htmlspecialchars($_POST['title'], ENT_QUOTES));
$intro = trim(htmlspecialchars($_POST['intro'], ENT_QUOTES));
$text = trim(htmlspecialchars($_POST['text'], ENT_QUOTES));

$error = '';

if(strlen($title) <= 3)
    $error = 'Введите название статьи';
if(strlen($intro) <= 15)
    $error = 'Введите интро для статьи';
if(strlen($text) <= 20)
    $error = 'Введите текст статьи';

if($error != '') {
    echo $error;
    exit();
}

require_once '../mysql_connect.php';

$sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES (?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $intro, $text, time(), $_COOKIE['login']]);

echo "Готово";