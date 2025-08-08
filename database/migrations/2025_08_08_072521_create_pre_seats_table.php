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
        Schema::create('pre_seats', function (Blueprint $table) {
            $table->id();

        $table->foreignId('passenger_id')->constrained()->onDelete('cascade');

        $table->string('airline')->nullable();
        $table->string('code')->nullable();
        $table->boolean('confirmed')->default(false);
        $table->string('currency', 10)->nullable();
        $table->string('start_point', 10)->nullable();
        $table->string('end_point', 10)->nullable();
        $table->string('leg')->nullable();
        $table->string('name')->nullable();
        $table->decimal('price', 10, 2)->nullable();
        $table->string('session')->nullable();
        $table->string('value')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_seats');
    }
};
