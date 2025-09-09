<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
        $table->id();
        $table->string('airline');                      // Hãng bay
        $table->string('airline_logo')->nullable();     // Logo hãng bay (ảnh upload hoặc link)
        $table->string('from');                         // Điểm đi
        $table->string('to');                           // Điểm đến
        $table->string('date_range');                   // VD: 16 - 24 thg 09
        $table->decimal('price', 15, 2);                // Giá
        $table->enum('trip_type', ['mot-chieu', 'khu-hoi']); // Loại vé
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
