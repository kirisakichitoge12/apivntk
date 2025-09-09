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
        Schema::create('ve_noi_dia_card', function (Blueprint $table) {
        $table->id();
        $table->string('from');
        $table->string('to');
        $table->string('date');
        $table->decimal('price', 12, 0);
        $table->string('img')->nullable(); // lưu đường dẫn ảnh
        $table->integer('original_price')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ve_noi_dia_card');
    }
};
