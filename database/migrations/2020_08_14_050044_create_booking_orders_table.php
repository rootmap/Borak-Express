<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sending_type');
            $table->string('sending_type_name');
            $table->string('recipient_number');
            $table->string('recipient_name');
            $table->string('address');
            $table->integer('recipient_city');
            $table->string('recipient_city_name');
            $table->integer('recipient_area');
            $table->string('recipient_area_area_name');
            $table->string('landmarks');
            $table->string('product_id');
            $table->integer('parcel_type');
            $table->string('parcel_type_name');
            $table->integer('delivery_type');
            $table->string('delivery_type_name');
            $table->integer('package_id');
            $table->string('package_id_name');
            $table->string('product_price');
            $table->string('deliver_date');
            $table->string('no_of_items');
            $table->string('parcel_status');
            $table->string('payment_status');
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
        Schema::dropIfExists('booking_orders');
    }
}
