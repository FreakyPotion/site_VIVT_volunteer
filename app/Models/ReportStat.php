<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStat extends Model
{
    protected $table = 'reports_timestamps';
    protected $primaryKey = 'timestamp_id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['report_id', 'time_create'];
}