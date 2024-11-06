<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'События';
    protected $primaryKey = 'Event_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Название', 'Описание', 'Дата', 'Организатор', 'Максимум участников', 'Адрес', 'Изображение', 'Завершено'];
}