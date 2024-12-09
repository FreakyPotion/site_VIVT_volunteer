@extends('layout_template')

@section('content')

<div class="button-org-section" style="text-align: center;">
        <div class="button-org-create" onclick="location.href='{{ route('create.event') }}'">
            <img src="/storage/icons/add_icon.png">
            <span>Создать новое событие</span>
        </div>
        <div class="tabs-org">
            <div id="current-tab" class="active active-button-tabs-curr" onclick="toggleTab('current')">
                <img src="/storage/icons/active_ev_icon.png" class="events-img-create">
                <span>Мои текущие события</span>
            </div>
            <div id="past-tab" class="active-button-tabs-prev" onclick="toggleTab('past')">
                <img src="/storage/icons/previous_ev_icon.png" class="events-img-create">
                <span>Мои прошедшие события</span>
            </div>
        </div>
</div>
<div class="main-container" style="text-align: center;">
    
    <div id="current-events">
        @if($activeEvents->isEmpty())
            <span class="events-text-annotation">Нет активных событий</span>
        @else
            <div class="events-grid">
                @foreach($activeEvents as $index => $event)
                
                        <div class="event-container">
                            <div class="event-image">
                                <a href="{{ route('events.details', ['id' => $event->Event_ID]) }}">
                                    <img src="{{ $event->Изображение }}">
                                </a>
                            </div>
                            <div class="events-text-container">
                                <p class="events-text-date">{{ $activeDates[$index] }}</p>
                                <a class="events-text-name" href="{{ route('events.details', ['id' => $event->Event_ID]) }}">{{ $event->Название }}</a>
                                <div class="text-container gradient-text">
                                    <p>{{ $event->Описание }}</p>
                                </div>
                            </div>
                        </div>
                    
                @endforeach
            </div>
        @endif
    </div>
    
    <div id="past-events" style="display:none;">
        @if($previousEvents->isEmpty())
            <span class="events-text-annotation">Нет завершённых событий</span>
        @else
            <div class="events-grid">
                @foreach($previousEvents as $index => $event)
                    
                        <div class="event-container">
                            <div class="event-image">
                                <a href="{{ route('events.details', ['id' => $event->Event_ID]) }}">
                                    <img src="{{ $event->Изображение }}">
                                </a>
                            </div>
                            <div class="events-text-container">
                                <p class="events-text-date">{{ $previousDates[$index] }}</p>
                                <a class="events-text-name" href="{{ route('events.details', ['id' => $event->Event_ID]) }}">{{ $event->Название }}</a>
                                <div class="text-container gradient-text">
                                    <p>{{ $event->Описание }}</p>
                                </div>
                            </div>
                        </div>
                    
                @endforeach
            </div>
        @endif
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
            document.getElementById('current-events').style.removeProperty('display');
            document.getElementById('current-tab').classList.add('active');
        } else {
            document.getElementById('past-events').style.removeProperty('display');
            document.getElementById('past-tab').classList.add('active');
        }
    }
</script>
@endsection