<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');

            // Các cột JSON chứa dữ liệu detailData
            $table->json('list_fare')->nullable();
            $table->json('list_baggage')->nullable();
            $table->json('list_service')->nullable();
            $table->json('list_pre_seat')->nullable();
            $table->json('baggage_price')->nullable();
            $table->json('service_price')->nullable();
            $table->json('seat_price')->nullable();
            $table->json('total_fare')->nullable();

            $table->timestamps();

            // Liên kết khóa ngoại
            $table->foreign('booking_id')
                  ->references('id')->on('bookings')
                  ->onDelete('cascade'); // xóa booking thì xóa detail
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
