<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'Запросы';
    protected $primaryKey = 'Request_ID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['Event_ID', 'User_ID', 'Status_ID'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'Event_ID', 'Event_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID', 'User_ID');
    }
}