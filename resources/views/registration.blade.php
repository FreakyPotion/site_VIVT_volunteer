<!DOCTYPE html>
<html lang="ru">
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

      .firstField {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }

      .lastField {
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
          border-radius: 15px;
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
          border-radius: 15px;
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
      <form id="registrationForm" method="POST" action="{{ route('registration') }}">
          @csrf
          <input class="firstField" type="text" name="firstName" placeholder="Имя" required>
          <input type="text" name="lastName" placeholder="Фамилия" required>
          <input type="text" name="patronymic" placeholder="Отчество">
          <input type="date" id="birthDate" name="birthDate" title="Участнику должно быть не менее 16 лет" required>
          <input type="text" maxlength="10" pattern="\d+" name="phone" placeholder="Телефон (без 8)" required>
          <input type="email" name="email" placeholder="Почта" required>
          <input class="lastField" type="password" name="password" placeholder="Пароль" required>

          <!-- Выбор роли -->
          <div class="radio-group radio-group label">
              <label><input type="radio" name="role" value="1" required> Я волонтер</label>
              <label><input type="radio" name="role" value="0"> Я организатор</label>
          </div>

          <!-- Кнопка выбора города -->
          <div class="dropdown-container">
              <div class="dropdown-select" onclick="toggleDropdown()">Выберите город</div>
              <div class="dropdown-list" id="cityDropdown">
                    @foreach($cities as $city)
                    <div onclick="selectCity('{{ $city->Наименование }}')">
                        {{ $city->Наименование }}
                    </div>
                    @endforeach
              </div>
          </div>
          <input type="hidden" id="selectedCity" name="city" required>

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

                // Сохранить выбранный город в скрытом поле
                document.getElementById('selectedCity').value = city;

                toggleDropdown();
            }

            // Закрытие dropdown при клике вне его
            document.addEventListener("click", function(event) {
                if (!event.target.closest(".dropdown-container")) {
                    document.getElementById("cityDropdown").classList.remove("active");
                }
            });


            // Валидация формы
            document.getElementById('registrationForm').addEventListener('submit', function (e) {
                const city = document.getElementById('selectedCity').value;

                if (!city) {
                    e.preventDefault(); // Отменить отправку формы
                    alert('Пожалуйста, выберите город.');
                }
            });

    </script>
    <script>
        // Функция для установки max даты
        const today = '{{ $currentDate }}';
        const birthDateElement = document.getElementById('birthDate');
        const dateMin = new Date('1900-01-01');
        const dateMax = new Date(today);
        dateMax.setFullYear(dateMax.getFullYear() - 16);
        // Преобразуем в строку формата YYYY-MM-DD
        const maxDateString = dateMax.toISOString().split('T')[0];
        const minDateString = dateMin.toISOString().split('T')[0];
        
        function setMaxDate() {
            // Устанавливаем атрибут max
            birthDateElement.setAttribute('max', maxDateString);
            birthDateElement.setAttribute('min', minDateString);
        }

        // Устанавливаем max дату при загрузке страницы
        window.onload = setMaxDate;

        const observer = new MutationObserver(function(mutationsList) {
            for (const mutation of mutationsList) {
                if (mutation.type === 'attributes' && (mutation.attributeName === 'min' || mutation.attributeName === 'max')) {
                    // Проверяем текущие значения атрибутов min и max
                if (birthDateElement.getAttribute('min') !== minDateString || birthDateElement.getAttribute('max') !== maxDateString) {
                    // Если значения не соответствуют, вызываем функцию setMaxDate()
                    setMaxDate();
                    }
                }
            }
        });

        // Начинаем отслеживание изменений атрибутов min и max
        observer.observe(birthDateElement, { attributes: true });
    </script>
</body>
</html>
