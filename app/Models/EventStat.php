<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStat extends Model
{
    protected $table = 'events_timestamps';
    protected $primaryKey = 'timestamp_id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['event_id', 'time_create'];
}