<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <style>
         body {
            background-color: #f9f9f9;
            font-family: 'Helvetica', sans-serif;
        }
        .main-container-admin {
            display: flex; /* Включаем flexbox */
            align-items: flex-start; /* Вертикальное выравнивание по центру */
            margin-left: 15px;
            margin-top: 15px;
        }
        .sidenav {
            display: flex; /* Включаем Flexbox */
            flex-direction: column; /* Располагаем элементы в колонку */
            margin-left: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-height: 88vh;
            width: 250px;
        }
        .content {
            margin-left: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
            margin-right: 15px;
            width: 100%;
            flex: 1;
            min-height: 88vh;
        }

        .stats-main-grid-container{ 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(600px, 1fr));
            gap: 10px; /* Интервал между элементами */
        }

        .tables-main-container{
            display: flex;
            flex-direction: column;
            flex: 1;
            background-color: white;
            border-radius: 15px;
            border: 1px solid rgba(28, 75, 170, 0.3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Тень */
        }

        .settings-main-container{
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 10px; /* Интервал между элементами */
        }

        .stats-container {
            box-sizing: border-box;
            background-color: white;
            border-radius: 15px; /* Закругление */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Тень */
            padding: 20px;
        }

        .buttons-block-container {
            display: flex;
        }

        .custom-button-red {
            background-color: white;
            color: #880E0E;
            padding: 8px 12px;
            border: 1px solid #880E0E;
            border-radius: 15px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-button-red:hover {
            background-color: #880E0E;
            color: white;
        }

        .custom-button-default {
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

        .custom-button-default.active {
            background-color: #1C4BAA;
            color: white;
        }

        .custom-button-small {
            background-color: white;
            color: #1C4BAA;
            padding: 8px 12px;
            border: 1px solid #1C4BAA;
            border-radius: 15px;
            font-size: 12px;
            margin: 8px;
            width: 70px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-button-small.active {
            background-color: #1C4BAA;
            color: white;
        }

        .custom-button-table {
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

        .custom-button-table:hover {
            background-color: #1C4BAA;
            color: white;
        }

        .custom-button-table.banned {
            color: #880E0E;
            border: 1px solid #880E0E;
        }

        .custom-button-table.banned:hover {
            background-color: #880E0E;
            color: white;
        }

        .tables-navigate{
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 30px;
            padding-bottom: 30px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #1C4BAA;
            color: white;
        }

        .tables-navigate-inner{
            display: flex;
            gap: 0;
            padding: 8px;
            border-radius: 15px;
            background-color: white;
            color: #1C4BAA;
        }
        
        .navigate:hover{
            font-weight: bold;
            cursor: pointer;
        }

        table, th, td {
            border-width: 0; /* Убираем внешние границы таблицы */
        }
        
        .table{
            justify-content: center;
            align-items: center;
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: linear-gradient(180deg, #1C4BAA,  #133477);
            color: white;
        }

        .table th {
            padding: 10px;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid rgba(28, 75, 170, 0.3); /* Граница между строками */
        }

        td:not(:last-child) {
            border-right: 1px solid rgba(28, 75, 170, 0.3); /* Граница между колонками */
        }


        .long-block {
            word-wrap: break-all;
            overflow-wrap: anywhere;
        }

        .table-header-text {
            font-size: 12px;
            font-weight: bolder;
            text-transform: uppercase;
        }

        .table-inner-text-main {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            padding: 5px;
        }

        .table-inner-text {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            padding: 5px;
        }

        .settings-container{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .settings-change-data {
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: center;
            align-items: center;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            border-radius: 0;
        }

        input[type="text"] {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom: none;
        }

        input[type="password"] {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        input::placeholder {
            color: #aaa;
        }

        .btn-change-data {
            width: 100%;
            padding: 12px;
            background: #1C4BAA;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn-change-data:hover {
            background: #133477;
        }
    </style>
</head>
<body>
    <div class="main-container-admin">
        <aside class="sidenav">
            <div style="text-align: center;">
                <h1>VIVT Volunteer</h1>
            </div>
            <div style="text-align: center;">
                <div class="buttons-block-container-main">
                    <button class="custom-button-default active" data-target="page-stats">Статистика</button>
                    <button class="custom-button-default" data-target="page-tables">Таблицы</button>
                    <button class="custom-button-default" data-target="page-settings">Настройки панели</button>
                </div>
            </div>
            <div style="text-align: center; margin-top: auto;">
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="custom-button-red">Выйти из панели управления</button>
                </form>
            </div>
        </aside>
        <div class="content">
            <div id="page-stats" class="stats-main-grid-container page">
                <div class="stats-container">
                    <div style="display: flex; justify-content: space-between;">
                        <p>Событий создано</p>
                        <div class="buttons-block-container">
                            <button class="custom-button-small active" data-period="day">Сутки</button>
                            <button class="custom-button-small" data-period="week">Неделя</button>
                            <button class="custom-button-small" data-period="month">Месяц</button>
                            <button class="custom-button-small" data-period="year">Год</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="events" data-category="Events">
                    </div>
                </div>
                <div class="stats-container">
                    <div style="display: flex; justify-content: space-between;">
                        <p>Пользователей зарегистрировано</p>
                        <div class="buttons-block-container">
                            <button class="custom-button-small active" data-period="day">Сутки</button>
                            <button class="custom-button-small" data-period="week">Неделя</button>
                            <button class="custom-button-small" data-period="month">Месяц</button>
                            <button class="custom-button-small" data-period="year">Год</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="users" data-category="Users">
                    </div>
                </div>
                <div class="stats-container">
                    <div style="display: flex; justify-content: space-between;">
                        <p>Заявок подано</p>
                        <div class="buttons-block-container">
                            <button class="custom-button-small active" data-period="day">Сутки</button>
                            <button class="custom-button-small" data-period="week">Неделя</button>
                            <button class="custom-button-small" data-period="month">Месяц</button>
                            <button class="custom-button-small" data-period="year">Год</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="requests" data-category="Requests">
                    </div>
                </div>
                <div class="stats-container">
                    <div style="display: flex; justify-content: space-between;">
                        <p>Событий завершено</p>
                        <div class="buttons-block-container">
                            <button class="custom-button-small active" data-period="day">Сутки</button>
                            <button class="custom-button-small" data-period="week">Неделя</button>
                            <button class="custom-button-small" data-period="month">Месяц</button>
                            <button class="custom-button-small" data-period="year">Год</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="reports" data-category="Reports">
                    </div>
                </div>
            </div>

            <div id="page-tables" class="tables-main-container page" style="display: none">
                <div class="tables-navigate"> 
                    <div class="tables-navigate-inner">
                        <a class="navigate" id="navigate" data-target="table-home">/Таблицы</a>
                        <a id="navigated-table"></a>
                    </div>
                </div>
                <div>
                    <div>
                        <table class="table" id="table-home">
                            <thead>
                                <tr>
                                    <th class="table-header-text">Наименование</th>
                                    <th class="table-header-text">Кол-во записей</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tablesInfo as $table)
                                <tr>
                                    <td>
                                        <div class="table-inner-text-main">
                                            <p>{{$table['tableName']}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-inner-text">
                                            <p>{{$table['count']}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-inner-text">
                                            <button class="custom-button-table" id="{{$table['tableName']}}" data-target="table-{{$table['tableName']}}">Подробнее</button>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table" id="table-Города" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="table-header-text">ID</th>
                                    <th class="table-header-text">Наименование</th>
                                    <th><div class="table-inner-text">
                                            <button class="custom-button-table" id="{{$table['tableName']}}" data-target="table-{{$table['tableName']}}">Добавить</button>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$city->City_ID}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$city->Наименование}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table" id="table-Пользователи" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="table-header-text">ID</th>
                                    <th class="table-header-text">Фамилия</th>
                                    <th class="table-header-text">Имя</th>
                                    <th class="table-header-text">Отчество</th>
                                    <th class="table-header-text">Email</th>
                                    <th class="table-header-text">Телефон</th>
                                    <th class="table-header-text">Дата Рождения</th>
                                    <th class="table-header-text">ID Роли</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->User_ID}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->Фамилия}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->Имя}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->Отчество}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{ $user->{'E-Mail'} }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->Телефон}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{ $user->{'Дата рождения'} }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$user->City_ID}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <button class="custom-button-table banned-btn {{ $user->blocked ? 'banned' : '' }}" 
                                                        data-id="{{$user->User_ID}}">
                                                    {{ $user->blocked ? 'Заблокировано' : 'Заблокировать' }} 
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table" id="table-События" style="display: none;">
                            <thead>
                                <tr>
                                    <th class="table-header-text">ID</th>
                                    <th class="table-header-text">Название</th>
                                    <th class="table-header-text">Описание</th>
                                    <th class="table-header-text">Дата</th>
                                    <th class="table-header-text">ID Организатора</th>
                                    <th class="table-header-text">Максимум участников</th>
                                    <th class="table-header-text">Адрес</th>
                                    <th class="table-header-text">Изображение</th>
                                    <th class="table-header-text">Завершено</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$event->Event_ID}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$event->Название}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$event->Описание}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$event->Дата}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{ $event->Организатор }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{ $event->{'Максимум участников'} }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{$event->Адрес}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text long-block">
                                                <p>{{$event->Изображение}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-inner-text">
                                                <p>{{ $event->Завершено }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="page-settings" class="settings-main-container page" style="diplay: none">
                <div class="settings-container">
                    <div class="settings-change-data">
                        <p>Данные для авторизациии</p>
                        <form id="changeDataForm" method="POST" action="{{ route('change.data') }}">
                            @csrf
                            <input type="text" id="login" name="login" placeholder="Введите логин" value="{{ $user->{'E-Mail'} }}" required></input>
                            <input type="password" id="password" name="password" placeholder="Введите новый пароль" required></input>
                            <button class="btn-change-data" type="submit">Изменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const chartData = {!! json_encode($chartData) !!};
    
    // Глобальный объект для хранения графиков
    const charts = {};
    
    function createChart(canvasId, chartData, category, period) {
        const labels = chartData[category][period]['labels'];
        const values = chartData[category][period]['values'];

        const ctx = document.getElementById(canvasId).getContext('2d');

        // Уничтожаем предыдущий график, если он существует
        if (charts[canvasId]) {
                charts[canvasId].destroy();
        }

        // Градиентная заливка
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(19, 52, 119, 0.3)'); // Верхняя часть
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)'); // Нижняя часть

        charts[canvasId] = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Метки
                datasets: [{
                    label: `Кол-во записей`,
                    data: values, // Значения
                    borderColor: 'rgba(19, 52, 119, 1)', // Цвет линии
                    backgroundColor: gradient, // Градиентная заливка
                    borderWidth: 3,
                    fill: true, // Заливка под линией
                    tension: 0.4 // Смягчение линии
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Убрать легенду
                    },
                    tooltip: {
                        enabled: true // Включить всплывающие подсказки
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false // Убрать вертикальные линии сетки
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)' // Цвет горизонтальных линий сетки
                        }
                    }
                },
                ticks: {
                    callback: function(value) { // Оставляем только целые числа
                        return Number.isInteger(value) ? value : null;
                    }
                }
            }
        });
    }

    document.querySelectorAll('.buttons-block-container').forEach(buttonContainer => {
        buttonContainer.addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                const period = e.target.getAttribute('data-period');
                const canvasId = buttonContainer.closest('.stats-container').querySelector('canvas').id;
                const category = buttonContainer.closest('.stats-container').querySelector('canvas').dataset.category;

                // Обновляем график
                updateActiveCharts(canvasId, chartData, category, period);
            }
        });
    });


    // Обновление графиков
    async function updateActiveCharts() {
        const newData = await fetchChartData(); // Запрос данных
        if (newData) {
            // Находим все кнопки с классом 'active' внутри контейнеров кнопок
            document.querySelectorAll('.buttons-block-container .custom-button-small.active').forEach(activeButton => {
                const period = activeButton.getAttribute('data-period'); // Получаем период
                const canvas = activeButton.closest('.stats-container').querySelector('canvas'); // Находим соответствующий canvas
                const canvasId = canvas.id;
                const category = canvas.dataset.category;

                // Обновляем график
                createChart(canvasId, newData, category, period);

            });
        }
    }

    // Функция для запроса данных с сервера
    async function fetchChartData() {
        try {
            const response = await fetch('/panel/updateChart');  // Запрос к маршруту на сервере
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const newData = await response.json();  // Преобразуем ответ в JSON
            return newData;  // Возвращаем данные для использования в updateActiveCharts
        } catch (error) {
            console.error('Ошибка при получении данных: ', error);
            return null;  // В случае ошибки возвращаем null
        }
    }

    // Вызываем функцию каждые 10 секунд
    setInterval(updateActiveCharts, 10000);

    // Создаём графики для разных периодов и категорий
    createChart('events', chartData, 'Events', 'day');
    createChart('users', chartData, 'Users', 'day');
    createChart('requests', chartData, 'Requests', 'day');
    createChart('reports', chartData, 'Reports', 'day');

</script>

<script>
    // Визуализация выбранных кнопок
    function setActiveButton(groupContainer, activeButton) {
        const buttons = groupContainer.querySelectorAll('button'); // Все кнопки в группе
        buttons.forEach(button => button.classList.remove('active')); // Убираем класс active
        activeButton.classList.add('active'); // Добавляем класс active на выбранную кнопку
    }

    // Для графиков
    document.querySelectorAll('.buttons-block-container').forEach(container => {
        container.addEventListener('click', event => {
            const clickedButton = event.target.closest('button'); // Проверяем, был ли клик по кнопке
            if (clickedButton) {
                setActiveButton(container, clickedButton); // Устанавливаем активное состояние
            }
        });
    });

    // Для сайдбара
    document.querySelectorAll('.buttons-block-container-main').forEach(container => {
        container.addEventListener('click', event => {
            const clickedButton = event.target.closest('button'); // Проверяем, был ли клик по кнопке
            if (clickedButton) {
                setActiveButton(container, clickedButton); // Устанавливаем активное состояние
            }
        });
    });
</script>

<script>
    function changeView(clickedButton) {
        // Получаем идентификатор страницы из атрибута кнопки
        const targetPageId = clickedButton.getAttribute('data-target');

        // Скрываем все страницы
        document.querySelectorAll('.page').forEach(page => {
            page.style.display = 'none';
        });

        // Отображаем целевую страницу
        const targetPage = document.getElementById(targetPageId);
        if (targetPage) {
            targetPage.style.removeProperty('display');
        }
    }

    document.querySelectorAll('.buttons-block-container-main button').forEach(button => {
        button.addEventListener('click', event => {
            changeView(event.target);
        });
    });
</script>

<script>
    function browseTable(clickedButton) {
        // Получаем идентификатор страницы из атрибута кнопки
        const targetTableId = clickedButton.getAttribute('data-target');
        const tableName = clickedButton.getAttribute('id');

        // Скрываем все страницы
        document.querySelectorAll('.table').forEach(table => {
            table.style.display = 'none';
        });

        // Отображаем целевую страницу
        const targetTable = document.getElementById(targetTableId);
        if (targetTable) {
            targetTable.style.removeProperty('display');
        }

        const navigatedTable = document.querySelector('#navigated-table');
        if (tableName && tableName != 'navigate') {
            navigatedTable.innerText='/' + tableName;
        } else {
            navigatedTable.innerText='';
        }
    }
    
    document.querySelectorAll('#table-home .custom-button-table').forEach(button => {
        button.addEventListener('click', event => {
            browseTable(event.target);
        });
    });

    const navButton = document.querySelector('#navigate')
    navButton.addEventListener('click', event => {
            browseTable(event.target);
    });
</script>

<script>
    document.getElementById('changeDataForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Предотвращаем стандартное отправление формы
        const formData = new FormData(this);
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                alert('Данные успешно обновлены');
            } else {
                throw new Error('Ошибка при обновлении данных');
            }
        } catch (error) {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при обновлении данных');
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.banned-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const isBlocked = this.classList.contains('banned');

                // Отправка запроса на сервер для переключения состояния
                fetch(`/panel/update-row/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ blocked: !isBlocked }) // меняем состояние на противоположное
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновление интерфейса кнопки
                        if (data.blocked) { // Если сервер вернул, что пользователь заблокирован
                            this.textContent = 'Заблокировано';
                            this.classList.add('banned');
                        } else { // Если сервер вернул, что пользователь разблокирован
                            this.textContent = 'Заблокировать';
                            this.classList.remove('banned');
                        }
                    } else {
                        alert('Ошибка обновления');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Ошибка соединения с сервером');
                });
            });
        });
    });
</script>





</html>