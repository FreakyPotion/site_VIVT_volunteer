@extends('layout_template')

@section('content')

    
    <div class="main-container" style="text-align: center;">
        
        @if($events->isEmpty())
            <span style="font-size: 32px; font-weight: bold; ">ПОКА НЕТ НИ ОДНОГО СОБЫТИЯ...</span>
        @else
            <span style="display: inline-block; font-size: 32px; font-weight: bold; margin-bottom: 20px;">АКТИВНЫЕ СОБЫТИЯ</span>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 30px;">
            @foreach($events as $event)
                <div>
                    <span style="font-size: 24px; font-weight: bold; padding: 10px;">{{ $event->Название }}</span>
                    <a href="{{ route('events.details', ['id' => $event->Event_ID]) }}">
                        <div class="image-container">
                            <img src="{{ $event->Изображение }}" style="width: 500px; height: 300px; object-fit: contain;  border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="overlay">
                                <div class="text text-container">{{ $event->Описание }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        @endif
    </div>

@endsection