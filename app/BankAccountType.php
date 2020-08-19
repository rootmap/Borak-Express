<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccountType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='bank_account_types';
}
        