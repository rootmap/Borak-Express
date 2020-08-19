<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantBankInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_bank_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->string('merchant_id_full_name');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('account_type');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('module_status');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_bank_infos');
    }
}
