<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('international_flights', function (Blueprint $table) {
            $table->id();
            $table->string('from');             // điểm đi
            $table->string('to');               // điểm đến
            $table->string('country');          // quốc gia
            $table->string('date');             // ngày
            $table->decimal('price', 15, 2);    // giá khuyến mãi
            $table->decimal('original_price', 15, 2); // giá gốc
            $table->string('img')->nullable();  // ảnh
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('international_flights');
    }
};
