<?php // запрет просмотра страницы (редирект на страницу reg.php), если пользователь не авторизован
    if(!isset($_COOKIE['login'])){
        header('Location: /reg.php'); //
        exit();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <?php
    $website_title = 'Добавление статьи';
    require 'layouts/head.php';
    ?>
</head>
<body>
    <?php require 'layouts/header.php'; ?>

    <main class="container mt-5">
        <div class="row">
            <div class="col-8">
                <h4>Добавление статьи</h4>
                <form action="" method="post">
                    <label for="title">Заголовок статьи</label>
                    <input type="text" name="title" id="title" class="form-control">

                    <label for="intro">Интро статьи</label>
                    <textarea name="intro" id="intro" class="form-control"></textarea>

                    <label for="text">Текст статьи</label>
                    <textarea name="text" id="text" class="form-control"></textarea>

                    <div class="alert alert-danger mt-3" id="error-block"></div>

                    <button type="button" class="btn btn-success mt-3" id="article_btn">Добавить</button>
                </form>
            </div>

            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>
    <?php require 'layouts/footer.php'; ?>


    <script> // ToDo: remake with fetch
        $('#article_btn').click(function () {
            const title = $('#title').val();
            const intro = $('#intro').val();
            const text = $('#text').val();

            $.ajax({
                url: 'reg/add_article.php',
                type: 'POST',
                cache: false,
                data: {'title': title, 'intro': intro, 'text': text},
                dataType: 'html',
                success: function (data) {
                    if(data == "Готово") {
                        $('#article_btn').text('Все готово').attr('disabled','disabled');
                        $('#error-block').hide();
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