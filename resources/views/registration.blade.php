<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
      body {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
          background-color: #f9f9f9;
          font-family: 'Helvetica', sans-serif;
      }

      .container {
          width: 400px;
          background: white;
          padding: 40px;
          border-radius: 10px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          text-align: center;
      }

      h1 {
          font-size: 24px;
          font-weight: 600;
          color: #333;
          margin-bottom: 20px;
      }

      input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="date"] {
          width: 100%;
          padding: 12px;
          border: 1px solid #ddd;
          box-sizing: border-box;
      }

      input[type="text"]:first-child {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }

      input[type="password"]:last-of-type {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
      }

      input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="date"] {
        margin-bottom: 0; /* Убираем отступы между полями */
      }

      .btn-primary {
          width: 100%;
          padding: 12px;
          background: linear-gradient(90deg, #1C4BAA, #4B94E3);
          border: none;
          color: white;
          font-size: 16px;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s;
          margin-top: 20px;
      }

      .btn-primary:hover {
          background: linear-gradient(90deg, #00264d, #4d94ff);
      }

      .dropdown-container {
          position: relative;
          width: 100%;
      }

      .dropdown-select {
          width: 100%;
          padding: 12px;
          background-color: #f0f0f0;
          border: 1px solid #ddd;
          border-radius: 5px;
          text-align: left;
          cursor: pointer;
          margin-bottom: 10px;
      }

      .dropdown-list {
          display: none;
          position: absolute;
          width: 100%;
          max-height: 150px;
          overflow-y: auto;
          border: 1px solid #ddd;
          border-radius: 5px;
          background: white;
          z-index: 1;
          top: 50px;
      }

      .dropdown-list.active {
          display: block;
      }

      .dropdown-list div {
          padding: 10px;
          cursor: pointer;
      }

      .dropdown-list div:hover {
          background-color: #eee;
      }

      .radio-group {
          display: flex;
          justify-content: space-around;
          margin: 15px 0; /* Отступ сверху и снизу */
      }

      .radio-group label {
          margin-right: 10px; /* Отступ между кнопками */
      }
  </style>
</head>
<body>
  <div class="container">
      <h1>Регистрация</h1>
      <form>
          <input type="text" name="firstName" placeholder="Имя" required>
          <input type="text" name="lastName" placeholder="Фамилия" required>
          <input type="text" name="middleName" placeholder="Отчество">
          <input type="date" name="birthDate" required min="2007-01-01" max="2024-01-01" title="Участнику должно быть не менее 16 лет">
          <input type="tel" name="phone" placeholder="Телефон (без 8)" required>
          <input type="email" name="email" placeholder="Почта" required>
          <input type="password" name="password" placeholder="Пароль" required>

          <!-- Выбор роли -->
          <div class="radio-group radio-group label">
              <label><input type="radio" name="role" value="volunteer" required> Я волонтер</label>
              <label><input type="radio" name="role" value="organizer"> Я организатор</label>
          </div>

          <!-- Кнопка выбора города -->
          <div class="dropdown-container">
              <div class="dropdown-select" onclick="toggleDropdown()">Выберите город</div>
              <div class="dropdown-list" id="cityDropdown">
                  <div onclick="selectCity('Москва')">Москва</div>
                  <div onclick="selectCity('Санкт-Петербург')">Санкт-Петербург</div>
                  <div onclick="selectCity('Новосибирск')">Новосибирск</div>
                  <div onclick="selectCity('Екатеринбург')">Екатеринбург</div>
                  <div onclick="selectCity('Казань')">Казань</div>
                  <div onclick="selectCity('Нижний Новгород')">Нижний Новгород</div>
                  <div onclick="selectCity('Челябинск')">Челябинск</div>
                  <div onclick="selectCity('Самара')">Самара</div>
                  <div onclick="selectCity('Омск')">Омск</div>
                  <div onclick="selectCity('Ростов-на-Дону')">Ростов-на-Дону</div>
                  <!-- Добавьте другие города здесь -->
              </div>
          </div>

          <!-- Кнопка "Зарегистрироваться" -->
          <button type="submit" class="btn-primary">Зарегистрироваться</button>
      </form>
  </div>

  <!-- Скрипт для dropdown -->
  <script>
      function toggleDropdown() {
          document.getElementById("cityDropdown").classList.toggle("active");
      }

      function selectCity(city) {
          document.querySelector(".dropdown-select").innerText = city;
          toggleDropdown();
      }

      // Закрытие dropdown при клике вне его
      document.addEventListener("click", function(event) {
          if (!event.target.closest(".dropdown-container")) {
              document.getElementById("cityDropdown").classList.remove("active");
          }
      });
  </script>
</body>
</html>
