@extends('layout_template')

@section('content')

    
    <div class="main-container" style="text-align: center;">
        
        @if($events->isEmpty())
            <span class="events-text-annotation">Пока нет ни одного события</span>
        @else
            <span class="events-text-annotation border-bottom-thick">Прошедшие события</span>
            <div class="events-grid">
                @foreach($events as $index => $event)
                    <div class="event-container">
                        <div class="event-image">
                            <a href="{{ route('events.details', ['id' => $event->Event_ID]) }}">
                                <img src="{{ $event->Изображение }}">
                            </a>
                        </div>
                        <div class="events-text-container">
                            <p class="events-text-date">{{ $dates[$index] }}</p>
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