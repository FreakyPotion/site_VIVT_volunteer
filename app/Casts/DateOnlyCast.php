<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Carbon\Carbon;

class DateOnlyCast implements CastsAttributes
{
     // Преобразование при получении значения из БД
     public function get($model, string $key, $value, array $attributes)
     {
         return $value ? Carbon::parse($value)->format('d.m.Y') : null;
     }
 
     // Преобразование перед сохранением в БД
     public function set($model, string $key, $value, array $attributes)
     {
         // Преобразуем дату в формат, который можно сохранить в базе
         return $value ? Carbon::createFromFormat('d.m.Y', $value)->toDateString() : null;
     }
}
