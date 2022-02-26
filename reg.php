<!doctype html>
<html lang="en">
<head>
    <?php
    $website_title = 'Регистрация';
    require 'layouts/head.php';
    ?>
</head>
<body>
    <?php require 'layouts/header.php'; ?>

    <main class="container mt-5">
        <div class="row">
            <div class="col-8">
                <div class="alert alert-success mb-3" id="success-block"></div>
                <h4>Форма регистрация</h4>
                <form action="" method="post" id="form-reg">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="username" id="username" class="form-control">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control mb-3">

                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" class="form-control">

                    <label for="pass">Пароль</label>
                    <input type="password" name="pass" id="pass" class="form-control">

                    <div class="alert alert-danger mt-3" id="error-block"></div>
                    <button class="btn btn-success mt-3" id="reg-btn">Зарегистрироваться</button>
                </form>
            </div>
            <?php require 'layouts/aside.php'; ?>
        </div>
    </main>

    <?php require 'layouts/footer.php'; ?>


    <script>
        const form = document.querySelector('#form-reg'),
              regBtn = document.querySelector('#reg-btn'),
              errorBlock = document.querySelector('#error-block'),
              successBlock = document.querySelector('#success-block');

        form.onsubmit = async (e) => {
            e.preventDefault();

            let response = await fetch('reg/registration.php', {
                method: 'POST',
                body: new FormData(form)
            })
            let result = await response.text();
            if (response.status === 200) {
                regBtn.textContent = 'Готово';
                errorBlock.classList.remove('d-block');
                successBlock.classList.add('d-block');
                successBlock.innerHTML = result;
                form.reset();
            } else {
                successBlock.classList.remove('d-block');
                errorBlock.classList.add('d-block');
                errorBlock.innerHTML = result;
            }
        };
    </script>
</body>
</html>