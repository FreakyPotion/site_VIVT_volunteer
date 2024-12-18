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
        border-radius: 15px;
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

    /* Стили для активной вкладки */
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .input-field {
        margin-bottom: 15px;
    }

    .input-field label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .input-field input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 15px;
        font-size: 14px;
    }

    .btn-save {
        width: 25%;
        background: #1C4BAA;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 15px;
        cursor: pointer;
        margin-left: 300px;
    }

    .btn-password{
        width: 50%;
        background: #1C4BAA;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 15px;
        cursor: pointer;
        margin-left: 0px;
    }

    .btn-save:hover, .btn-password:hover {
        background: #133477;
    }

    .dropdown-container {
        position: relative;
        width: 100%;
    }

    .dropdown-select {
        width: 100%;
        padding: 9px;
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
        border-radius: 15px;
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

    input[type="date"], input[type="email"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        border-radius: 15px;
        margin-bottom: 10px;
    }

    .column {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Две колонки одинаковой ширины */
        gap: 20px; /* Промежуток между колонками */
        padding: 20px;
    }

    .poltos {
        width: 50%;
    }

    <!-- события -->
    .events-container {
        width: 100%;
        max-width: 800px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .tabs {
        display: flex;
        justify-content: space-around;
        background-color: #f1f1f1;
        padding: 10px 0;
        border-radius: 10px 10px 0 0;
        cursor: pointer;
    }

    .tabs div {
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        flex-grow: 1;
    }

    .tabs .active {
        background: #1C4BAA;
        color: white;
        font-weight: bold;
        border-radius: 15px;    
    }

    .events-list {
        padding: 20px;
    }

    .event-item {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .event-avatar {
        position: relative;
        overflow: hidden;
        width: 60px;
        height: 40px;
        max-width: 60px;
        max-height: 40px;
        background-color: #ccc;
        border-radius: 10px;
        margin-right: 20px;
    }

    .event-info {
        flex-grow: 1;
    }

    .event-info h3 {
        font-size: 18px;
        color: #333;
    }

    .event-info p {
        font-size: 14px;
        color: #777;
    }

    .event-annotation{
        text-transform: uppercase; 
        display: flex; 
        justify-content: center;
        font-weight: bolder;
    }

    .custom-button-small {
        background-color: white;
        color: #1C4BAA;
        padding: 8px 12px;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 12px;
        margin: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-button-small:hover {
        background-color: #1C4BAA;
        color: white;
    }

    .custom-button-red-profile {
        background-color: white;
        color: #880E0E;
        padding: 8px 12px;
        border: 1px solid #880E0E;
        border-radius: 15px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        margin-top: 30px;
        transition: background-color 0.3s ease;
    }

    .custom-button-red-profile:hover {
        background-color: #880E0E;
        color: white;
    }

    .custom-button-default-profile {
        background-color: white;
        color: #1C4BAA;
        padding: 8px 12px;
        border: 1px solid #1C4BAA;
        border-radius: 15px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        margin-top: 5px;
        margin-bottom:5px;
        transition: background-color 0.3s ease;
    }

    .custom-button-default-profile:hover {
        background-color: #1C4BAA;
        color: white;
    }
@endsection

@section('content')
<div class="profile-container-parent">
    <div class="profile-container">
        <div class="main-content">
            
            <div class="sidebar">
                <button class="custom-button-default-profile" onclick="showTab('info')">Личная информация</button>
                <button class="custom-button-default-profile" onclick="showTab('security')">Безопасность</button>
                <button class="custom-button-default-profile" onclick="showTab('events')">Мои события</button>

                <!-- Добавляем класс "logout" для красного текста -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <!-- Кнопка "Выйти" -->
                        <button class="custom-button-red-profile" type="submit">Выйти из аккаунта</button>
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
                        <div class="profile-name" id="profileName">{{$user-> Фамилия}} {{$user-> Имя}}</div>
                            @if($user->Role_ID == 1)
                                <div class="profile-role" id="profileRole">Волонтёр</div>
                            @elseif($user->Role_ID == 0)
                                <div class="profile-role" id="profileRole">Организатор</div>
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
                
                <div id="info" class="tab-content active">
                <!-- Поля для ввода -->
                    <form id="changeDataForm" method="POST" action>
                        <div class="column">
                            <!-- Первая колонка -->
                            <div>
                                <div class="input-field">
                                    <label for="firstName">Имя</label>
                                    <input type="text" id="firstName" value="{{$user->Имя}}">
                                </div>
                                
                                <div class="input-field">
                                    <label for="lastName">Фамилия</label>
                                    <input type="text" id="lastName" value="{{$user->Фамилия}}">
                                </div>
                                
                                <div class="input-field">
                                    <label for="thirdName">Отчество</label>
                                    <input type="text" id="thirdName" value="{{$user->Отчество}}">
                                </div>

                                <div class="input-field">
                                    <label for="birthDate">Дата рождения</label>
                                    <input type="date" id="birthDate" name="birthDate" title="Участнику должно быть не менее 16 лет" value="{{ $user->{'Дата рождения'} }}" required>
                                </div>
                            </div>

                            <!-- Вторая колонка -->
                            <div>
                                <div class="input-field">
                                    <label for="phone">Телефон</label>
                                    <input type="text" maxlength="10" pattern="\d+" name="phone" placeholder="без 8" value="{{ $user->Телефон }}" required>
                                </div>
                                
                                <!-- города-->
                                <div class="input-field">
                                    <label for="cityDropdown">Город</label>    
                                    <div class="dropdown-container">
                                        <div class="dropdown-select" onclick="toggleDropdown()">{{ $curCity }}</div>
                                        <div class="dropdown-list" id="cityDropdown">
                                            @foreach($cities as $city)
                                            <div onclick="selectCity('{{ $city->Наименование }}')">
                                                {{ $city->Наименование }}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" id="selectedCity" name="city" required>
                                </div>
                                
                                <div class="input-field">
                                    <label for="email">Почта</label>
                                    <input type="text" id="email" value="{{ $user->{'E-Mail'} }}">
                                </div>
                            </div>
                        </div>
                        <button class="btn-save" onclick="saveProfile()">Сохранить</button>
                    </form>
                </div>

                <!-- Безопасность --> 
                <div id="security" class="tab-content">
                    <form id="changePass" method="POST" action>
                        <div class="poltos">
                            <div class="input-field">
                                <label for="oldPassword">Старый пароль</label>
                                <input type="password" id="oldPassword">
                            </div>
                            <div class="input-field">
                                <label for="newPassword">Новый пароль</label>
                                <input type="password" id="newPassword">
                            </div>
                            <div class="input-field">
                                <label for="confirmPassword">Подтвердите пароль</label>
                                <input type="password" id="confirmPassword">
                            </div>
                            <button class="btn-password">Изменить пароль</button>
                        </div>
                    </form>
                </div>

                <!-- Мои события -->
                <div id="events" class="tab-content">
                    <div>
                        <div class="events-container">
                            <!-- Вкладки -->
                            <div class="tabs">
                                <div id="current-tab" class="active" onclick="toggleTab('current')">Текущие события</div>
                                <div id="past-tab" onclick="toggleTab('past')">Прошедшие события</div>
                            </div>

                            <!-- Список событий -->
                            <div id="events-list" class="events-list">
                                <!-- Текущие события -->
                                <div id="current-events" class="events-list-content">
                                    @if($activeEvents->isEmpty())
                                        <span class="event-info event-annotation">Нет активных событий</span>
                                    @else
                                        @foreach($activeEvents as $event)
                                            <div class="event-item">
                                                <div class="event-avatar">
                                                    <img src="{{ $event->Изображение }}" style="width: 100%; object-fit: fill;">
                                                </div>
                                                <div class="event-info">
                                                    <h3>{{ $event->Название }}</h3>
                                                </div>
                                                <a class="custom-button-small text-decoration-none" href="{{ route('events.details', ['id' => $event->Event_ID]) }}">Подробнее</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Прошедшие события -->
                                <div id="past-events" class="events-list-content" style="display:none;">
                                    @if($previousEvents->isEmpty())
                                        <span class="event-info event-annotation">Нет завершённых событий</span>
                                    @else
                                        @foreach($previousEvents as $event)
                                            <div class="event-item">
                                                <div class="event-avatar">
                                                    <img src="{{ $event->Изображение }}" style="width: 100%; object-fit: fill;">
                                                </div>
                                                <div class="event-info">
                                                    <h3>{{ $event->Название }}</h3>
                                                </div>
                                                <a class="custom-button-small text-decoration-none" href="{{ route('events.details', ['id' => $event->Event_ID]) }}">Подробнее</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    if (progressContainer)
    {// Извлекаем данные из data-* атрибутов
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
    progressTextBlack.webkitMaskImage = maskValueBlack;}
</script>
<!-- Основа -->
<script>
    // Переключение вкладок
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        document.getElementById(tabId).classList.add('active');
    }

    // Сохранение профиля
    function saveProfile() {
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        

        // Обновляем отображение
        document.getElementById('profileName').textContent = `${lastName} ${firstName}`;
        

        // Отправка данных на сервер
        // Здесь код для сохранения через fetch
    }
</script>

<!-- города -->
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
    document.getElementById('changeDataForm').addEventListener('submit', function (e) {
        const city = document.getElementById('selectedCity').value;

        if (!city) {
            e.preventDefault(); // Отменить отправку формы
            alert('Пожалуйста, выберите город.');
        }
    });
</script>

<!-- события -->
<script>
    function toggleTab(tab) {
        // Скрываем все события
        document.getElementById('current-events').style.display = 'none';
        document.getElementById('past-events').style.display = 'none';

        // Убираем активный класс с вкладок
        document.getElementById('current-tab').classList.remove('active');
        document.getElementById('past-tab').classList.remove('active');

        // Отображаем соответствующие события и добавляем активный класс на вкладку
        if (tab === 'current') {
            document.getElementById('current-events').style.display = 'block';
            document.getElementById('current-tab').classList.add('active');
        } else {
            document.getElementById('past-events').style.display = 'block';
            document.getElementById('past-tab').classList.add('active');
        }
    }
</script>

<?php if ($user != null): ?>
    <script>
        if (<?php echo $user->Role_ID; ?> === 0) {
            var role = document.getElementById('volunteer_nav');
            if (role) {
                role.remove();
            }
        } else if (<?php echo $user->Role_ID; ?> === 1) {
            var role = document.getElementById('organizer_nav');
            if (role) {
                role.remove();
            }
        }
    </script>
<?php endif; ?>


@endsection
