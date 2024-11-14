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
  @endsection

  @section('content')

<div class="profile-container-parent">
    <div class="profile-container">
        <div class="main-content">
            <div class="sidebar">
                <div>Личная информация</div>
                <div>Безопасность</div>
                <div>Мои заявки</div>
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
                @foreach($users as $user)
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

                <div class="content-area">
                    Контент вкладок
                </div>
                @endforeach
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
                const formData = new FormData();
                formData.append('avatar', file);

                console.log('Файл отправлен');

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
                    console.log(data);
                    if (data.success) {
                        // Обновляем background-image
                        photoContainer.style.backgroundImage = `url(${data.avatarUrl})`;
                    } else {
                        alert('Размер загружаемого файла не должен превышать 8 мегабайт');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
            }
        }
    </script>

@endsection
