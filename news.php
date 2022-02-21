<!doctype html>
<html lang="en">
<head>
    <?php
        require_once 'mysql_connect.php';

        $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
        $id = $_GET['id'];

        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);

        $article = $query->fetch(PDO::FETCH_OBJ);

        $website_title = $article->title;
        require 'layouts/head.php';
    ?>
</head>
<body>
<?php require 'layouts/header.php'; ?>

<main class="container mt-5">
    <div class="row">
        <div class="col-8">
            <div class="jumbotron">
                <h1><?=$article->title?></h1>
                <p><b>Автор статьи: </b> <mark><?=$article->author?></mark> </p>

                <?php
                    $date = date('d ', $article->date);

                    $array = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
                    $date .= $array[date('n', $article->date) - 1];
                    $date .= date(' H:i', $article->date);
                ?>

                <p><b>Дата: </b> <u><?=$date?></u> </p>
                <p><?=$article->intro?></p>
                <p><?=$article->text?></p>
            </div>

            <h3 class="mt-5">Комментарии</h3>
            <form action="/news.php?id=<?=$_GET['id']?>" method="post">
                <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" class="form-control">

                <label for="mess">Сообщение</label>
                <textarea name="mess" id="mess" class="form-control"></textarea>

                <button type="submit" class="btn btn-success mt-3" id="mess_send">Добавить комментарий</button>
            </form>

            <?php
                if(isset($_POST['username']) && isset($_POST['mess'])) {
                    $username = trim(htmlspecialchars($_POST['username'], ENT_QUOTES));
                    $mess = trim(htmlspecialchars($_POST['mess'], ENT_QUOTES));

                    $sql = 'INSERT INTO comments(name, mess, article_id) VALUES (?, ?, ?)';
                    $query = $pdo->prepare($sql);
                    $query->execute([$username, $mess, $_GET['id']]);
                }

                $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
                $query = $pdo->prepare($sql);
                $query->execute(['id' => $_GET['id']]);
                $comments = $query->fetchAll(PDO::FETCH_OBJ);

                foreach ($comments as $comment) {
                    echo "<div class='alert alert-info mb-2'>
                            <h4>$comment->name</h4>
                            <p>$comment->mess</p>     
                          </div>";
                }

            ?>

        </div>
        <?php require 'layouts/aside.php'; ?>
    </div>
</main>
<?php require 'layouts/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>