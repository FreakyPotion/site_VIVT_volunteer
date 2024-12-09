<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Casts\DateOnlyCast;

class Event extends Model
{
    protected $table = 'События';
    protected $primaryKey = 'Event_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Название', 'Описание', 'Дата', 'Организатор', 'Максимум участников', 'Адрес', 'Изображение', 'Завершено'];

    // Добавляем каст для 'Дата'
    /*protected $casts = [
        'Дата' => DateOnlyCast::class, // Преобразование в формат dd.mm.yyyy
    ];*/

    public function organizer()
    {
        return $this->belongsTo(User::class, 'Организатор', 'User_ID');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'Event_ID', 'Event_ID');
    }
}