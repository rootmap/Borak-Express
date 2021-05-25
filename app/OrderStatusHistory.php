<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatusHistory extends Model
{
    use SoftDeletes;
    protected $datas = ['order_id','parcel_status','remarks','created_by'];
    protected $table='booking_order_status_history';

}
