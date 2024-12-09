<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVT.Волонтёр</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        background-color: #f9f9f9;
        font-family: 'Helvetica', sans-serif;
      }
      .bordered-box {
        display: flex;
        flex-direction: column; /* Элементы будут выстраиваться вертикально */
        align-items: center; /* Центрируем элементы по горизонтали */
        justify-content: center; /* Центрируем элементы по вертикали */ 
        padding: 10px;
        box-sizing: border-box;
      }

      .border-top-thick {
        border-top: 1px solid #1C4BAA;
      }

      .border-bottom-thick {
        border-bottom: 1px solid black;
      }

      .border-bottom-thick-header {
        border-bottom: 5px solid black;
      }
      
      .main-container {
        width: 100%;
        max-width: 1600px;  /* Максимальная ширина на больших экранах */
        margin-left: auto;  /* Автоматический отступ слева */
        margin-right: auto; /* Автоматический отступ справа */
        border-radius: 10px;
        padding: 30px;
      }

      .grid-container {
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 10px;
        width: 100%;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .item {
        padding: 10px;
      }

      .text-container {
          width: 100%;       /* Ограничение по ширине */
          height: 100px;  /* Ограничение по высоте */
          overflow: hidden;   /* Обрезка текста, если он выходит за пределы */
          display: flex;      /* Flexbox для выравнивания */
          align-items: flex-start; /* Прижимает текст к низу */
          justify-content: left; /* Центрирование текста горизонтально */
          text-align: left; /* Растягивает текст по ширине */
          font-size: 16px;
          padding: 10px 10px;
          overflow-wrap: break-word;
          white-space: normal;
      }

      .gradient-text {
        mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 0) 100%);
        -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 0) 100%);
      }

      .buttons-row-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
      }

      .custom-button-default {
        background-color: #1C4BAA;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      .custom-button-default:hover {
        background-color: #133477;
      }

      .custom-button-green {
        background-color: #1CAA23;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .custom-button-green:hover {
        background-color: #15801a;
      }

      .custom-button-red {
        background-color: #880E0E;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        transition: background-color 0.3s ease;
      }


      .custom-button-default-status {
        background-color: none;
        color: #1C4BAA;
        padding: 10px 20px;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 16px;
      }

      .custom-button-green-status {
        background-color: none;
        color: #1CAA23;
        padding: 10px 20px;
        border: 1px solid #1CAA23;
        border-radius: 15px;
        font-size: 16px;
        transition: background-color 0.3s ease;
      }


      .custom-button-red-status {
        background-color: none;
        color: #880E0E;
        padding: 10px 20px;
        border: 1px solid #880E0E;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .custom-button-red-status:hover {
        background-color: #880E0E;
        color: white;
      }

      .image-container {
        position: relative;
        overflow: hidden;
        background: white;
        border-radius: 30px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .image-container img {
        width: 500px; 
        height: 300px; 
        object-fit: contain;  
        border-radius: 30px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .create-container img {
        position: relative;
        overflow: hidden;
        background: white;
        border-radius: 30px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: filter 0.3s ease;
      }

      .create-container:hover img {
        content: url("/storage/icons/add_event_icon_borderless_hover.png");
      }

      .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 1), transparent);
        color: white;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        overflow: hidden;
        transition: height 0.5s ease;
      }

      .image-container:hover .overlay {
        height: 100%;
      }

      .image-container:hover .text {
        opacity: 1;
      }

      .create-btn-container {
          width: 100%;
          text-align: right;
      }
      .create-btn {
            display: inline-block;
            padding: 10px;
            font-size: 16px;
            color: white;
            background: linear-gradient(90deg, #1C4BAA, #4B94E3); /* Градиент для кнопки */
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
      }

      .create-btn:hover {
            background: linear-gradient(90deg, #153d7b, #3a74b1); /* Темный градиент при наведении */
      }
      
      .event_details_headers {
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
      }

      .event_details_text {
        display: flex; 
        justify-content: space-between; 
        font-size: 18px; 
        padding: 5px;
      }

      .event_details_desc {
        display: flex;      /* Flexbox для выравнивания */
        text-align: justify; /* Растягивает текст по ширине */
        color: white;
        font-size: 16px;
        text-align: justify;
        background: #1C4BAA;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        opacity: 0;
        transition: opacity 0.8s ease;
      }

      .event_details_desc.loaded {
        opacity: 1;
      }

      .events-text-container {
        padding: 20px;
        text-align: left;
      }

      .events-text-annotation {
        display: inline-block;
        font-size: 32px; 
        font-weight: bold; 
        text-transform: uppercase;
        margin-bottom: 20px;
      }

      .events-text-date {
        font-size: 16px; 
        font-weight: bold;
        color: gray;
        padding: 10px; 
        text-transform: uppercase;
        margin-bottom: unset;
      }

      .events-text-name {
        font-size: 20px; 
        font-weight: bold;
        text-decoration: none;
        color: black;
        padding: 10px; 
        text-transform: uppercase;
      }
      .events-grid {
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
        gap: 20px;
      }
      .events-img-create {
          width: 500px; 
          height: 300px; 
          object-fit: fill;  
          border-radius: 30px; 
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .event-container{
          background: white;
          border-radius: 30px; 
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          transition: transform 0.3s ease;
      }

      .event-container:hover{
        transform: scale(1.05);
      }

      .event-image {
        position: relative;
        width: 100%;
        height: 208px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }

      .event-image img{
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }

      
      .button-back-row {
        display: flex;
        align-items: flex-start;
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 20px;
      }

      .button-back-container {
        display: flex;
        align-items: center;
        text-align: center;
      }

      .button-back-container img {
        height: 13px;
        padding-right: 5px;
      }

      .button-back-img {
        width: 15px;
      }

      .button-back-text {
        color: #1C4BAA;
        text-decoration: none;
        cursor: pointer;
      }
  
      .nav-link {
        transition: transform 0.3s ease, font-weight 0.3s ease;
        will-change: transform;
        position: relative; /* Для позиционирования псевдоэлемента */
        display: inline-flex;
        
      }

      .nav-link::after {
        content: ''; /* Псевдоэлемент не имеет текста */
        position: absolute;
        bottom: 0; /* Размещаем полосу снизу */
        left: 0;
        width: 0; /* Полоса скрыта по умолчанию */
        height: 1px; /* Высота полосы */
        background-color: white; /* Цвет полосы */
        transition: width 0.3s ease; /* Плавное расширение полосы */
      }

      .nav-link:hover {
        transform: scale(1.2);
        font-weight: bold;
      }

      .nav-link:hover::after {
        width: 100%; /* Полоса растягивается на всю ширину элемента */
      }

      .nav-background {
        background-color: #1C4BAA;
      }

      .pagination {
          display: flex;
          margin-top: 20px;
          justify-content: center;
          gap: 10px;
          list-style-type: none;
      }

      .pagination .page-link {
          padding: 8px 16px;
          background-color: #1C4BAA;
          color: white;
          border-radius: 10px;
          text-decoration: none;
          font-weight: bold;
      }

      .pagination .page-link:hover {
          background-color: #4B94E3;
      }

      .pagination .page-item.disabled .page-link {
          background-color: #1C4BAA;
          color: #888;
      }

      .pagination .page-item.active .page-link {
          background-color: #4B94E3;
          color: white;
      }

      .button-org-section {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
      }

      .button-org-section img {
        width: 30px;
        height: 30px;
      }

      .button-org-create {
        background-color: none;
        color: #1C4BAA;
        padding: 10px 20px;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
      }

      .button-org-create:hover {
        background-color: #1C4BAA;
        color: white;
      }

      .button-org-create:hover img {
        content: url(/storage/icons/add_icon_white.png);
      }

      .button-vol-requests {
        background-color: none;
        color: #1C4BAA;
        padding: 10px 20px;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
      }

      .button-vol-requests:hover {
        background-color: #1C4BAA;
        color: white;
      }

      .button-vol-requests:hover img {
        content: url(/storage/icons/myrequests_icon_white.png);
      }

      .tabs-org {
        display: flex;
        background-color: none;
        color: #1C4BAA;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
      }

      .active-button-tabs-curr {
        padding: 10px 20px;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
      }

      .active-button-tabs-prev { 
        padding: 10px 20px;
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
      }

      .active-button-tabs-curr.active, .active-button-tabs-prev.active  {
        background-color: #1C4BAA;
        color: white;
      }

      .active-button-tabs-curr.active img {
        content: url(/storage/icons/active_ev_icon_white.png);
      }

      .active-button-tabs-prev.active img {
        content: url(/storage/icons/previous_ev_icon_white.png);
      }

      @yield('style')

    </style>
</head>
<body>
    <div class="nav-background d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom-thick-header"  style="padding: 20px;">
      <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none" style="margin-right: 20px">
        <img src="/storage/icons/logo.png" width="300">
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto align-items-center" style="gap: 80px;">
        <a class="nav-link link-body-emphasis text-decoration-none" style="display: flex; align-items: center; text-align: center;" href="/">
            <span style="color: white;">События</span>
        </a>
        <a class="nav-link link-body-emphasis text-decoration-none" style="display: flex; align-items: center; text-align: center;" href="/archive">
            <span style="color: white;">Архив событий</span>
        </a>
        <a class="nav-link link-body-emphasis text-decoration-none" style="display: flex; align-items: center; text-align: center;" id="organizer_nav" href="/organizer/events">
            <span style="color: white;">Организаторам</span>
        </a>
        <a class="nav-link link-body-emphasis text-decoration-none" style="display: flex; align-items: center; text-align: center;" id="volunteer_nav" href="/volunteer/events">
            <span style="color: white;">Волонтёрам</span>
        </a>
        <a class="nav-link me-3 py-2 link-body-emphasis text-decoration-none" style="display: flex; align-items: center; text-align: center;" href="/lk">
            <img src="/storage/icons/profile_icon_white.png" width="25" height="25" style="margin-right: 5px;" alt="Личный кабинет">
            <span style="color: white;">Личный кабинет</span>
        </a>
      </nav>
    </div>

@yield('content')

</body>
</html>