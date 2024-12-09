@extends('layout_template')

@section('style')

        .list-view-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto; 
        }

        .list-container {
            display: flex;
            flex-direction: column; 
            background: white;
            border-radius: 15px;
            width: 100%;
            min-height: 83vh;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .list-grid{
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 0px; /* Интервал между элементами */
            padding: 0px 20px 20px 20px;
            flex-grow: 1
        }
        
        .list-subcontainer {
            height: 100%;
        }

        .list-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px;

        }
        .list-headers {
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 0px; /* Интервал между элементами */
        }

        .list-header {
            display: flex;
            justify-content: center;
            background-color: #1C4BAA;
            color: white;
            font-size: 24px;
            width: 100%;
            text-transform: uppercase;
            font-weight: bolder;
        }

        .list-inner {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            width: 100%;
            height: 100%;
            text-transform: uppercase;
            font-weight: bolder;
        }

        /* Увеличиваем размер аватара */
        .avatar {
            width: 70px;
            aspect-ratio: 1;
            border-radius: 50%;
            background-color: #ccc; /* Временно серый фон */
            margin-right: 20px;
            overflow: hidden;
        }

        .avatar img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .app-info {
            flex-grow: 1;
        }

        .app-info h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .app-info .level {
            font-size: 14px;
            color: #555;
        }

        /* Выравнивание кнопок в правую сторону */
        .buttons {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .btn-accept, .btn-reject {
            padding: 8px 15px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-accept {
            background: #1C4BAA
        }

        .btn-reject {
            background: #880E0E
        }

        .btn-accept:hover {
            background: #133477
        }

        .btn-reject:hover {
            background: #700c0c
        }
@endsection


@section('content')

<div class="list-view-container">
    <div class="list-container">
        <div class="button-back-row" style="margin: 20px">
            <a onclick="history.back()" class="button-back-text">
                <div class="button-back-container">
                    <img class="button-back-img" src="/storage/icons/back_icon.png">
                    <span>Назад</span>
                </div>
            </a>
        </div>

        <div class="list-subcontainer">
            @if($statuses->isEmpty())
                <div class="list-inner">Нет ни одной заявки</div>
            @else
                @foreach($statuses as $status)
                    <div class="list-item">
                        <div class="avatar">
                            <img src="{{ $status->Изображение }}">
                        </div>
                        <div class="app-info">
                            <h3>{{$status->Название}}</h3>
                            @if ($status->Status_ID == 1)
                                <div class="level" style="color: #1C4BAA;">На рассмотрении</div>
                            @elseif ($status->Status_ID == 0)
                                <div class="level" style="color: #1CAA23;">Принята</div>
                            @elseif ($status->Status_ID == 2)
                                <div class="level" style="color: #880E0E;">Отклонена</div>
                            @endif
                        </div>
                        <!-- Кнопки "Принять" и "Отклонить" теперь справа -->
                        <div class="buttons">
                            <a class="btn-accept text-decoration-none" href="{{ route('events.details', ['id' => $status->Event_ID]) }}">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

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