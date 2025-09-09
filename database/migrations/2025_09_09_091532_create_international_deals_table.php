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
        Schema::create('international_deals', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('airline_logo')->nullable();
            $table->string('from'); // điểm đi
            $table->string('to');   // điểm đến
            $table->string('date_range');
            $table->decimal('price', 15, 2);
            $table->enum('trip_type', ['mot-chieu', 'khu-hoi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('international_deals');
    }
};
