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
            $table->id();
            $table->foreignId('User_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('PhoneNumber', 15);
            $table->mediumText('Address');
            $table->string('City', 40);
            $table->string('State', 40);
            $table->integer('Zip');
            $table->integer('Total');
            $table->boolean('PayStatus')->default(0);
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
