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
        <div class="list-headers">
            <div class="list-header" style="border-top-left-radius: 15px;">Заявки</div>
            <div class="list-header" style="border-top-right-radius: 15px">Участники</div>
        </div>
        <div class="list-grid">
            <div class="list-subcontainer" style="border-right: 1px solid #ddd;">
                @if($requesters->isEmpty())
                    <div class="list-inner">Список пуст</div>
                @else
                    @foreach($requesters as $user)
                        <div class="list-item">
                            <div class="avatar">
                                <a href="{{ route('other.profile', ['id' => $user->User_ID]) }}">
                                    <img src="{{ $user->{'Фото профиля'} }}">
                                </a>
                            </div>
                            <div class="app-info">
                                <h3>{{$user->Фамилия}} {{$user->Имя}}</h3>
                                <div class="level" data-level="{{$user->Рейтинг}}"></div>
                            </div>
                            <!-- Кнопки "Принять" и "Отклонить" теперь справа -->
                            <div class="buttons">
                                <form method="POST" action="{{ route('request.accept', ['event' => $eventid, 'user' => $user->User_ID]) }}">
                                    @csrf
                                    <button class="btn-accept">Принять</button>
                                </form>
                                <form method="POST" action="{{ route('request.reject',  ['event' => $eventid, 'user' => $user->User_ID]) }}">
                                    @csrf
                                    <button class="btn-reject">Отклонить</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="list-subcontainer" style="border-left: 1px solid #ddd;">
                @if($participants->isEmpty())
                    <div class="list-inner">Список пуст</div>
                @else
                    @foreach($participants as $user)
                        <div class="list-item">
                            <div class="avatar">
                                <img src="{{ $user->{'Фото профиля'} }}">
                            </div>
                            <div class="app-info">
                                <h3>{{$user->Фамилия}} {{$user->Имя}}</h3>
                                <div class="level" data-level="{{$user->Рейтинг}}"></div>
                            </div>
                            <!-- Кнопки "Принять" и "Отклонить" теперь справа -->
                            <div class="buttons">
                                <button class="btn-accept">Профиль</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.level').forEach(levelField => {
        const levelData = parseInt(levelField.getAttribute('data-level'));
        let level =  Math.floor(levelData / 1000) + 1;
        levelField.innerText = 'Уровень: ' + level;
    });
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