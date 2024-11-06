@extends('layout_template')

@section('content')

<div class="grid-container" style="text-align: center;">
    @foreach($events as $event)
        <div class="bordered-box item">
            <img src="{{ $event->Изображение }}" style="width: 500px; height: 500px; object-fit: cover">
        </div>
        <div class="item">
            <span style="font-size: 32px; font-weight: bold;">{{ $event->Название }}</span>

            <!-- Контейнер для выравнивания элементов по краям -->
            <div style="display: flex; justify-content: space-between; font-size: 18px; padding: 5px;">
                <span>Организатор:</span>
                @foreach($users as $user)
                    @if ($user->User_ID == $event->Организатор)
                        <span>{{ $user->Фамилия }} {{ $user->Имя }} {{ $user->Отчество }}</span>
                    @endif
                @endforeach   
            </div> 

            <!-- Выравнивание текста по бокам: слева "Максимум участников", справа количество участников -->
            <div style="display: flex; justify-content: space-between; font-size: 18px; padding: 5px;">
                <span>Максимум участников:</span>
                <span>{{ $event->{'Максимум участников'} }}</span>
            </div> 

            <!-- Выравнивание текста по бокам: слева "Адрес", справа адрес -->
            <div style="display: flex; justify-content: space-between; font-size: 18px; padding: 5px;">
                <span>Адрес:</span>
                <span>{{ $event->Адрес }}</span>
            </div> 

            <div style="font-size: 18px; font-weight: bold; padding: 5px;">
                <span>Описание:</span>
            </div> 
            <!-- Описание события -->
            <div style="font-size: 16px; text-align: justify; border: 2px solid black; border-radius: 15px; padding: 10px;">{{ $event->Описание }}</div>
            <div style="display: flex; justify-content: right; font-size: 18px; padding: 5px; margin-top: 15px;">
                <button class="custom-button" type="submit">Подать заявку</button>
            </div> 
        </div>
    @endforeach
</div>

@endsection