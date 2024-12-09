<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestStat extends Model
{
    protected $table = 'requests_timestamps';
    protected $primaryKey = 'timestamp_id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['request_id', 'time_create'];
}