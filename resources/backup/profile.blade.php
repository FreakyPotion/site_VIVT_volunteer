@extends('layout_template')

@section('style')

      .profile-container-parent {
          margin: 0;
          display: flex;
          justify-content: center;
          align-items: center;
      }

      .profile-container {
          width: 80%;
          max-width: 1200px;
          background: white;
          border-radius: 10px;
          padding: 30px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .header, .footer {
          text-align: center;
          margin-bottom: 20px;
      }

      .header h1 {
          font-size: 24px;
          font-weight: bold;
          color: #333;
      }

      .footer {
          font-size: 14px;
          color: #777;
          margin-top: 20px;
      }

      .main-content {
          display: flex;
      }

      .sidebar {
          width: 25%;
          border-right: 1px solid #ddd;
          padding: 15px; /* Уменьшили отступы */
      }

      .sidebar div {
          margin-bottom: 10px; /* Уменьшили отступ между кнопками */
          cursor: pointer;
          font-weight: 500;
          color: #333;
          text-align: left;
      }

      .sidebar div:hover {
          color: #007bff;
      }

      /* Текст красным для кнопки "Выйти из аккаунта" */
      .sidebar .logout {
          color: #c82333; /* Красный цвет текста */
          font-weight: bold;
          margin-top: 30px; /* Отступ перед кнопкой */
      }

      .sidebar .logout:hover {
          color: #880E0E; /* Темнее красный при наведении */
      }

      .profile-info {
          width: 75%;
          padding: 20px;
          display: flex;
          flex-direction: column; /* Структура вертикальная */
      }

      .profile-top {
          display: flex;
          align-items: center;
      }

      .profile-photo {
          width: 100px;
          height: 100px;
          border-radius: 50%;
          background-color: #ddd;
          background-size: cover; 
          background-position: center;
          display: inline-block;
          margin-right: 20px;
          position: relative;
          overflow: hidden;
      }

      .profile-photo button {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background: transparent;
          border: none;
          color: #333;
          font-size: 16px;
          font-weight: bold;
          cursor: pointer;
          text-align: center;
      }

      .profile-name {
          font-size: 20px;
          font-weight: 600;
          color: #333;
      }

      .profile-role {
          font-size: 16px;
          color: #777;
      }

      .content-area {
          padding: 20px;
          border: 1px solid #ddd;
          border-radius: 5px;
          background-color: #f8f9fa;
          min-height: 200px;
          margin-top: 20px; /* Отступ сверху */
      }

      .progress-container {
            width: 100%; /* Ширина на весь контейнер */
            background-color: #f3f3f3; /* Светлый фон */
            border-radius: 25px; /* Закругленные углы */
            overflow: hidden; /* Обрезаем содержимое, если оно выходит за пределы */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Легкая тень для эффекта */
            margin: 20px 0; /* Отступ сверху и снизу */
            height: 30px; /* Высота контейнера прогресс-бара */
            position: relative; /* Это нужно для позиционирования текста внутри контейнера */
        }

        .progress-bar {
            height: 100%; /* Высота прогресс-бара */
            width: 0%; /* Начальная ширина */
            background: linear-gradient(to right, #1C4BAA, #4B94E3); /* Градиент */
            border-radius: 25px; /* Закругленные углы */
            position: absolute; /* Абсолютное позиционирование прогресс-бара */
            top: 0;
            left: 0;
            transition: width 0.5s ease-in-out; /* Плавное изменение ширины */
        }

        .progress-text {
            position: absolute; /* Абсолютное позиционирование текста */
            top: 50%; /* Центрирование по вертикали */
            left: 50%; /* Центрирование по горизонтали */
            transform: translate(-50%, -50%); /* Центрирование по обоим осям */
            font-weight: bold;
            font-size: 14px;
            white-space: nowrap; /* Запрещает перенос текста */
        }
@endsection

@section('content')


<div class="profile-container-parent">
    <div class="profile-container">
        <div class="main-content"> 
            <div class="sidebar">
                <div>Личная информация</div>
                <div>Безопасность</div>
                <div>Мои события</div>
                @if($user->Role_ID == 1)
                    <div>Мои заявки</div>
                @endif

                <!-- Добавляем класс "logout" для красного текста -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <!-- Кнопка "Выйти" -->
                        <button class="logout" style="border: none; padding: 0; background: none;" type="submit">Выйти из аккаунта</button>
                    </form>
                </div>
            </div>
            <!-- Блок с аватаром, именем и ролью -->
            <div class="profile-info">
                <div class="profile-top">
                    <div class="profile-photo" id="photoContainer" onclick="document.getElementById('avatarInput').click()" style="background-image: url({{$user->{'Фото профиля'} }});">
                        <input type="file" id="avatarInput" style="display:none;" accept="image/*" onchange="uploadAvatar(event)">
                    </div>
                    <div>
                        <div class="profile-name">{{$user-> Фамилия}} {{$user-> Имя}}</div>
                            @if($user->Role_ID == 1)
                                <div class="profile-role">Волонтёр</div>
                            @elseif($user->Role_ID == 0)
                                <div class="profile-role">Организатор</div>
                            @endif
                        </div>
                    </div>
                @if($user->Role_ID == 1)
                <div>
                    <div class="progress-container"  data-level="{{ $level }}" data-curprogress="{{ $curProgress }}">
                        <div class="progress-bar" id="level"></div>
                        <div class="progress-text" id="progress-text-black" style="color: black; z-index: 1; display: flex; justify-content: center; width: 100%"></div>
                        <div class="progress-text" id="progress-text-white" style="color: white; z-index: 2; display: flex; justify-content: center; width: 100%"></div>
                    </div>
                </div>
                @endif
                <div class="content-area">
                    Контент вкладок
                </div>
            </div>
        </div>
        <div class="footer">
            2024 All Rights Reserved
        </div>
    </div>
</div>


    <script>
        function uploadAvatar(event) {
            console.log('Файл выбран');
            const file = event.target.files[0];
            const photoContainer = document.getElementById('photoContainer');

            if (file) {
                
                // Проверка типа файла
                if (!file.type.startsWith('image/')) {
                    alert('Пожалуйста, выберите файл изображения!');
                    return;
                }

                // Проверка размера файла (до 8 МБ)
                const maxSize = 8 * 1024 * 1024; // 8MB
                if (file.size > maxSize) {
                    alert('Размер файла не должен превышать 8 МБ!');
                    return;
                }

                const formData = new FormData();
                formData.append('avatar', file);

                // Отправляем файл на сервер
                fetch('/lk/upload-avatar', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF токен
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновляем background-image
                        photoContainer.style.backgroundImage = `url(${data.avatarUrl})`;
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
            }
        }
    </script>
    <script>
        // Получаем элемент с классом progress-container
        const progressContainer = document.querySelector('.progress-container');

        // Извлекаем данные из data-* атрибутов
        const level = progressContainer.getAttribute('data-level');  // Получаем уровень
        const curProgress = progressContainer.getAttribute('data-curprogress');  // Получаем текущий прогресс
        const progressTextBlack = document.getElementById('progress-text-black');
        const progressTextWhite = document.getElementById('progress-text-white');


        // Пример: обновляем прогресс-бар
        const progressBar = document.getElementById('level');
        const progressValue = curProgress/10;
        progressBar.style.width = progressValue + '%';  // Устанавливаем ширину прогресс-бара
        progressTextBlack.textContent = `Уровень: ${level} | ${curProgress}/1000`;  // Показываем текст внутри прогресс-бара
        progressTextWhite.textContent = `Уровень: ${level} | ${curProgress}/1000`;  // Показываем текст внутри прогресс-бара

        //Маски
        const maskValueWhite = `linear-gradient(to right, black 0%, black ${progressValue}%, transparent ${progressValue}%, transparent 100%)`;
        const maskValueBlack = `linear-gradient(to right, black ${progressValue}%, black 100%, transparent 0%, transparent ${progressValue}%)`;
        progressTextWhite.style.maskImage = maskValueWhite;
        progressTextWhite.webkitMaskImage = maskValueWhite;
        progressTextBlack.style.maskImage = maskValueBlack;
        progressTextBlack.webkitMaskImage = maskValueBlack;
    </script>

@endsection
