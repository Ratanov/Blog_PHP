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
                    <p><b>Автор статьи: </b> <mark><?=$article->author?></mark></p>
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
                <!-- Показываем форму для отправки комментариев только для авторизованных пользователей-->
                <?php if(isset($_COOKIE['login'])): ?>
                <form action="" method="post">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="article_id" id="article_id" class="form-control d-none" value="<?=$_GET['id']?>">
                    <input type="text" name="username" id="username" class="form-control" value="<?=$article->author?>" readonly="readonly">
                    <label for="mess">Сообщение</label>
                    <textarea name="mess" id="mess" class="form-control" placeholder="длина сообщения не менее 16 символов"></textarea>
                    <div class="alert alert-danger mt-3" id="error-block"></div>
                    <button type="button" class="btn btn-success mt-3" id="mess_send">Добавить</button>
                </form>
                <?php endif; ?>

                <!-- Получение и вывод с помощью цикла всех комментариев для одной уникальной записи по убыванию (от последней к первой) -->
                <div id="comments" class="mt-5">
                    <?php
                    $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
                    $query = $pdo->prepare($sql);
                    $query->execute(['id' => $_GET['id']]);
                    $comments = $query->fetchAll(PDO::FETCH_OBJ);

                    foreach ($comments as $comment) {
                        $date = date('d.N.Y H:i', $comment->date);
                        echo "<div class='alert alert-info mb-2'>
                                <h4>$comment->name</h4>
                                <p>$date</p>   
                                <p>$comment->mess</p>     
                              </div>";
                    }
                    ?>
                </div>
            </div>
            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>

    <?php require 'layouts/footer.php'; ?>


    <script> // ToDo: remake with fetch
        $('#mess_send').click(function () {
            const username = $('#username').val();
            const mess = $('#mess').val();
            const article_id = $('#article_id').val();

            $.ajax({
                url: 'reg/add_comment.php',
                type: 'POST',
                cache: false,
                data: {'username': username, 'mess': mess, 'article_id': article_id},
                dataType: 'html',
                success: function (data) {
                    if(data == "Готово") {
                        $('#mess_send').text('Добавлен. Ещё?');
                        $('#error-block').hide();
                        $('#mess').val('');
                        $("#comments").load(location.href + " #comments");
                    }
                    else {
                        $('#error-block').text(data).show();
                    }
                }
            });
        })
    </script>
</body>
</html>