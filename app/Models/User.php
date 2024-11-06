<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'Пользователи';
    protected $primaryKey = 'User_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Имя', 'Фамилия', 'Отчество', 'E-Mail', 'Телефон', 'Пароль', 'Рейтинг', 'Фото профиля', 'Дата рождения', 'Role_ID', 'City_ID'];
}