<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingArea extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='booking_areas';
}
        