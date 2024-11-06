@extends('layout_template')

@section('content')

    <div class="main-container" style="text-align: center;">
        
        @if($events->isEmpty())
            <span style="font-size: 32px; font-weight: bold; ">ПОКА НЕТ НИ ОДНОГО СОБЫТИЯ...</span>
        @else
            <span style="display: inline-block; font-size: 32px; font-weight: bold; margin-bottom: 20px;">АКТИВНЫЕ СОБЫТИЯ</span>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 50px;">
            @foreach($events as $event)
                <div class="bordered-box">
                    <img src="{{ $event->Изображение }}" style="width: 150px; height: 150px; object-fit: cover">
                    <span style="font-size: 16px; font-weight: bold;">{{ $event->Название }}</span>
                    <div class="gradient-text text-container" style="font-size: 12px; text-align: justify;">{{ $event->Описание }}</div>
                    <a href="{{ route('events.details', ['id' => $event->Event_ID]) }}" class="custom-button text-decoration-none">Подробнее</a>
                </div>
            @endforeach
            </div>
        @endif
    </div>

@endsection