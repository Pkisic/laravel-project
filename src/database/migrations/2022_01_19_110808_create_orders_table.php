<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->comment('unique order indetifier');
            $table->integer('status')->default(1)->comment('1 - in Progress, 2 - Accepted, 3 - Delivering, 4 - Completed , 99 - Rejected');
            $table->integer('payment_method')->default(1)->comment('1 - COD , 2 - Bank Transfer');
            $table->decimal('total',12,2)->comment('order total');
            
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_address_country');
            $table->string('customer_address_city');
            $table->string('customer_address_zip');
            $table->string('customer_address_street');
            $table->string('customer_address_number');
            
            $table->string('shipping_address_country');
            $table->string('shipping_address_city');
            $table->string('shipping_address_zip');
            $table->string('shipping_address_street');
            $table->string('shipping_address_number');
            
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
        Schema::dropIfExists('orders');
    }
}
