<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusHistory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='booking_order_status_history';
}
