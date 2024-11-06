<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVT.Волонтёр</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .bordered-box {
        display: flex;
        flex-direction: column; /* Элементы будут выстраиваться вертикально */
        align-items: center; /* Центрируем элементы по горизонтали */
        justify-content: center; /* Центрируем элементы по вертикали */ 
        border: 5px solid #1C4BAA;
        border-radius: 15px;
        padding: 10px;
        box-sizing: border-box;
      }
      .border-bottom-thick {
        border-bottom: 2px solid #1C4BAA; /* Толщина 5px, сплошная линия, черный цвет */
      }
      .main-container {
        width: 100%;
        max-width: 1600px;  /* Максимальная ширина на больших экранах */
        margin-left: auto;  /* Автоматический отступ слева */
        margin-right: auto; /* Автоматический отступ справа */
        padding-left: 15px; /* Отступы внутри контейнера */
        padding-right: 15px;
      }
      .text-container {
        width: 180px;  /* Ограничение по ширине */
        height: 80px; /* Ограничение по высоте */
        overflow: hidden; /* Обрезка текста, если он выходит за пределы */
      }
      .gradient-text {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)); /* Черно-прозрачный градиент */
        -webkit-background-clip: text; /* Обеспечивает применение градиента только к тексту */
        color: transparent; /* Делает сам текст прозрачным, чтобы градиент был виден */
      }
      .custom-button {
        background-color: #1C4BAA;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      .custom-button:hover {
        background-color: #193897;
      }
    </style>
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom-thick"  style="padding: 20px; margin: 10px;">
      <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
        <img src="http://vivt-volunteer.online.swtest.ru/icons/main_icon.png" width="300">
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto align-items-center">
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">
            <img src="http://vivt-volunteer.online.swtest.ru/icons/profile_icon.png" width="25" alt="Личный кабинет">
            <span>Личный кабинет</span>
        </a>
      </nav>
    </div>

@yield('content')

</body>
</html>