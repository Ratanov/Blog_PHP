<!doctype html>
<html lang="en">
<head>
    <?php
    $website_title = 'Блог';
    require 'layouts/head.php';
    ?>
</head>
<body>
    <?php require 'layouts/header.php'; ?>

    <main class="container mt-5">
        <div class="row">
            <div class="col-8">
                <!--Основная часть-->
                <?php
                require_once 'mysql_connect.php';

                $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
                $query = $pdo->query($sql);
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    echo "<h2>$row->title</h2>
                                  <p>$row->intro</p>
                                  <p><b>Автор статьи: </b> <mark>$row->author</mark></p>
                                  <a href='/news.php?id=$row->id' title='$row->title'>
                                  <button class='btn btn-info mb-5'>Подробнее</button>
                                  </a>";
                }
                ?>
            </div>
            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>

    <?php require 'layouts/footer.php'; ?>
</body>
</html>