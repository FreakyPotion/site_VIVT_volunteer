<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'Отчёты';
    protected $primaryKey = 'Report_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Event_ID', 'Отчёт_Фото', 'text'];
}