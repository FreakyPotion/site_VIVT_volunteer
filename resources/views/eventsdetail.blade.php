@extends('layout_template')

@section('content')


<div class="grid-container" style="text-align: center;">
    <div class="bordered-box item">
        <img src="{{ $event->Изображение }}" style="width: 500px; height: 500px; object-fit: cover">
    </div>
    <div class="item">

        <div class="button-back-row">
            <a onclick="history.back()" class="button-back-text">
                <div class="button-back-container">
                    <img class="button-back-img" src="/storage/icons/back_icon.png">
                    <span>Назад</span>
                </div>
            </a>
        </div>

        <span class="event_details_headers">{{ $event->Название }}</span>

        <!-- Контейнер для выравнивания элементов по краям -->
        <div class="event_details_text border-top-thick" style="margin-top: 10px">
            <span>Организатор:</span>
            @foreach($users as $user)
                @if ($user->User_ID == $event->Организатор)
                    <span>{{ $user->Фамилия }} {{ $user->Имя }} {{ $user->Отчество }}</span>
                @endif
            @endforeach
        </div>
        
        <!-- Выравнивание текста по бокам: слева "Дата", справа дата -->
        <div class="event_details_text">
            <span>Дата:</span>
            <span>{{ $date }}</span>
        </div> 

        <!-- Выравнивание текста по бокам: слева "Максимум участников", справа количество участников -->
        <div class="event_details_text">
            <span>Максимум участников:</span>
            <span>{{ $event->{'Максимум участников'} }}</span>
        </div> 

        <!-- Выравнивание текста по бокам: слева "Адрес", справа адрес -->
        <div class="event_details_text border-bottom-thick" style="margin-bottom: 20px">
            <span>Адрес:</span>
            <span>{{ $event->Адрес }}</span>
        </div> 

        <!-- Описание события -->
        <div class="event_details_desc">{{ $event->Описание }}</div>
        @if ($currentUser != null)
            @if ($currentUser->Role_ID == 1 && $event->Завершено == 0)
                @if ($requestStatus == null)
                    <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                        <form method="POST" action="{{ route('request', ['id' => $event->Event_ID]) }}">
                            @csrf
                            <button id="buttonPullRequest" class="custom-button-default" type="submit">Подать заявку</button>
                        </form>
                    </div>
                @else
                    @if ($requestStatus->Status_ID == 1)
                        <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                            <p class="custom-button-default-status">Заявка на рассмотрении</button>
                        </div>
                    @elseif ($requestStatus->Status_ID == 0)
                        <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                            <p class="custom-button-green-status">Вы - участник</p>
                        </div>
                    @elseif ($requestStatus->Status_ID == 2)
                        <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                            <p class="custom-button-red-status">Заявка отклонена</p>
                        </div>
                    @endif
                @endif
            @elseif ($currentUser->User_ID == $event->Организатор && $event->Завершено == 0)
                <div class="buttons-row-container">
                    @if ($currentDate >= $event->Дата)
                        <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                            <a href="{{ route('events.finish', ['id' => $event->Event_ID]) }}" class="custom-button-green text-decoration-none">Завершить событие</a>
                        </div>
                    @endif
                    <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                        <a href="{{ route('events.details.list', ['id' => $event->Event_ID]) }}" id="buttonGetRequests" class="custom-button-default text-decoration-none">Заявки и список участинков</a>
                    </div>
                </div>
            @endif
            @if ($event->Завершено == 1)
                <div style="display: flex; justify-content: center; font-size: 18px; padding: 5px; margin-top: 15px;">
                    <a href="{{ route('events.report', ['id' => $event->Event_ID]) }}" class="custom-button-default text-decoration-none">Отчёт</a>
                </div>
            @endif
        @endif
    </div>
</div>

<script>
  // После загрузки страницы добавляем класс "start-animation", чтобы запустить анимацию
  window.onload = function() {
    const text = document.querySelector('.event_details_desc');
    text.classList.add('loaded');
  };
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