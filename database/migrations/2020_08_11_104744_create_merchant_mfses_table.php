<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantMFSsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_mfses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->string('merchant_id_full_name');
            $table->integer('wallet_provider_id');
            $table->string('wallet_provider_id_name');
            $table->string('mobile_number');
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
        Schema::dropIfExists('merchant_mfses');
    }
}
