<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantBankInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='merchant_bank_infos';
}
        