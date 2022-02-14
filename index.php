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
            <div class="col-8">Основная часть</div>

            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>
    <?php require 'layouts/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>