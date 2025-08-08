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
        Schema::create('baggage', function (Blueprint $table) {
               $table->id();

                $table->foreignId('passenger_id')->constrained()->onDelete('cascade'); // Quan hệ với passengers
                $table->string('system')->nullable();
                $table->string('airline')->nullable();
                $table->string('value')->nullable();
                $table->string('type')->nullable(); // Ví dụ: cabin, checked
                $table->string('pax_type')->nullable(); // Ví dụ: ADT, CHD, INF
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('currency', 10)->nullable();
                $table->string('leg')->nullable(); // segment hoặc chặng bay
                $table->string('start_point', 10)->nullable(); // Sân bay đi
                $table->string('end_point', 10)->nullable();   // Sân bay đến
                $table->boolean('confirmed')->default(false);
                $table->string('session')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baggage');
    }
};
