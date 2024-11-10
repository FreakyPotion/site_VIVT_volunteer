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
          color: #dc3545; /* Красный цвет текста */
          font-weight: bold;
          margin-top: 30px; /* Отступ перед кнопкой */
      }

      .sidebar .logout:hover {
          color: #c82333; /* Темнее красный при наведении */
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
      <div class="header">
          <h1>ВИВТ.Волонтер</h1>
      </div>
      <div class="main-content">
          <div class="sidebar">
              <div>Личная информация</div>
              <div>Безопасность</div>
              <div>Мои заявки</div>
              <!-- Добавляем класс "logout" для красного текста -->
              <div class="logout">Выйти из аккаунта</div>
          </div>
          <!-- Блок с аватаром, именем и ролью -->
          <div class="profile-info">
              <div class="profile-top">
                  <div class="profile-photo">
                      <button id="avatarButton" onclick="document.getElementById('avatarInput').click()">Фото</button>
                      <input type="file" id="avatarInput" style="display:none;" accept="image/*" onchange="previewAvatar(event)">
                  </div>
                  <div>
                      <div class="profile-name">Имя Фамилия</div>
                      <div class="profile-role">Роль</div>
                  </div>
              </div>
              <!-- Контент вкладок, теперь ниже блока с аватаром -->
              <div class="content-area">
                  Контент вкладок
              </div>
          </div>
      </div>
      <div class="footer">
          2024 All Rights Reserved
      </div>
  </div>

  <script>
      function previewAvatar(event) {
          const file = event.target.files[0];
          const avatarButton = document.getElementById('avatarButton');
          if (file) {
              const reader = new FileReader();
              reader.onload = function(e) {
                  const photo = document.querySelector('.profile-photo');
                  photo.style.backgroundImage = `url(${e.target.result})`;
                  photo.style.backgroundSize = 'cover';
                  photo.style.backgroundPosition = 'center';
                  avatarButton.style.display = 'none'; // Скрыть кнопку "Фото"
              };
              reader.readAsDataURL(file);
          }
      }
  </script>

@endsection
