<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Passenger
            $table->string('full_name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('document_type');
            $table->string('document_number');

            // Contact
            $table->string('country_code');
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();

            // Flight info
            $table->string('departure');
            $table->string('arrival');
            $table->string('departure_date');
            $table->string('return_date')->nullable();
            $table->string('airline1');
            $table->string('airline2')->nullable();
            $table->string('seat_class1');
            $table->string('seat_class2')->nullable();
            $table->string('time_start1');
            $table->string('time_end1');
            $table->string('time_start2')->nullable();
            $table->string('time_end2')->nullable();
            $table->string('price1');
            $table->string('price2')->nullable();

            // Extras
            $table->string('selected_seat')->nullable();
            $table->string('luggage_label');
            $table->integer('luggage_price')->default(0);
            $table->integer('voucher_discount')->default(0);

            // Price
            $table->integer('total_price');
            $table->integer('final_total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
