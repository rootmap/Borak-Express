<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCost extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='shipping_costs';
}
        