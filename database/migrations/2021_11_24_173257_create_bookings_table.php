<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('bid')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('people_num');
            $table->longText('message')->nullable()->default('I will like to make a resaervation');
            $table->integer('status');
            $table->integer('satisfied');
            $table->string('booking_token');
            $table->date('booking_date');
            $table->time('booking_time', $precision = 0);
            // $table->time('sunrise')->nullable()->default(new DateTime());
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
        Schema::dropIfExists('bookings');
    }
}