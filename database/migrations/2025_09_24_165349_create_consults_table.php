<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Họ và tên
            $table->string('phone')->nullable(); // Số điện thoại
            $table->text('message')->nullable(); // Nội dung thắc mắc
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consults');
    }
};
