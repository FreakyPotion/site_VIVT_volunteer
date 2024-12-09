<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'Пользователи';
    protected $primaryKey = 'User_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Имя', 'Фамилия', 'Отчество', 'E-Mail', 'Телефон', 'Пароль', 'Рейтинг', 'Фото профиля', 'Дата рождения', 'Role_ID', 'City_ID', 'blocked'];

    public function events()
    {
        return $this->hasMany(Event::class, 'Организатор', 'User_ID');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'User_ID', 'User_ID');
    }

    protected $casts = [
        'E-Mail' => 'string',  // Указываем, что поле E-Mail - это строка
    ];
}