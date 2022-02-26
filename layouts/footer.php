<footer>
    <div class="container">
        <span class="text-muted">2022 Все права защищены</span>
    </div>
</footer>

<!-- Модальное окно -->
<div class="modal">
    <div class="modal__dialog">
        <div class="modal__content">
            <form action="#">
                <div data-close class="modal__close">&times;</div>
                <div class="modal__title">Мы свяжемся с вами как можно быстрее!</div>
                <input required placeholder="Ваше имя" name="name" type="text" class="modal__input">
                <input required placeholder="Ваш номер телефона" name="phone" type="phone" class="modal__input">
                <button class="modal__btn">Перезвонить мне</button>
            </form>
        </div>
    </div>
</div>

<!-- Практическое задание на 26.02.2022 -->
<!-- 1) Реализуйте отображение модального окна при нажатии на кнопку "Связаться с нами" (header.php:39). По умолчанию оно скрыто (.modal {display: none})  -->
<!-- 2) Реализуйте закрытие модального окна (если оно открыто) при нажатии на "крестик" -->
<!-- 3) Сделайте так, чтобы модальное окно открывалось спустя 6 секунд после загрузки страницы -->
<!-- 4) Если в течении 6 секунд после открытия страницы пользователь сам открыл модальное окно, то отменить выполнение п.3 -->
<!-- 5) (Дополнительно) Реализуйте закрытие модального окна при клике вне обласи модального окна -->
<!-- 6) (Дополнительно) Реализуйте открытие модального окна 1 раз при прокрутке страницу до самого низа -->
<!-- Решения задач написаны ниже в этом же файле -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    'use strict';
    // Logout
    $('.btn-exit').click(function () {
        $.ajax({
            url: 'reg/exit.php',
            type: 'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function () {
                document.location.reload(true);
            }
        });
    })


    // Modal
    const modalTrigger = document.querySelectorAll('[data-modal]'),
          modal = document.querySelector('.modal'),
          modalCloseBtn = document.querySelector('[data-close]');

    modalTrigger.forEach(elem => {
        elem.addEventListener('click', () => openModal())
    });

    modalCloseBtn.addEventListener('click', closeModal);

    // закрываем модальное окно при клике вне области модального окна
    modal.addEventListener('click', (e) => {
        if (e.target === modal)
            closeModal();
    });

    // закрываем модальное окно при нажатии на Esc
    document.addEventListener('keydown', (e) => {
        if (e.code === "Escape")
            closeModal();
    });

    //const modalTimerId = setTimeout(openModal, 6000); // открытие модального окна спустя 6 секунды после загрузки страницы

    // слушатель события для window при скролле, чтобы вызвать ф-ю showModalByScroll() и открыть модальное окно, если пользователь прокрутил страницу до самого низа
    window.addEventListener('scroll', showModalByScroll);

    function openModal() {
        modal.classList.add('d-block');
        document.body.style.overflow = 'hidden';
        //clearInterval(modalTimerId); // убираем интервал для открытия модального окна спустя 6 секунд, если пользователь уже открыл модальное окно
    }

    function closeModal() {
        modal.classList.remove('d-block');
        document.body.style.overflow = '';
    }

    // определяем, прокрутил ли пользователь страницу до самого низа. Если да, то показываем модальное окно 1 раз
    function showModalByScroll() {
        if (window.pageYOffset + document.documentElement.clientHeight >= document.documentElement.scrollHeight) {
            openModal();
            window.removeEventListener('scroll', showModalByScroll); // убираем слушатель события scroll, чтобы модальное окно не появлялось каждый раз при прокутки до самого низа
        }
    }
</script>