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
      Schema::create('description_noidias', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // tiêu đề bài viết/mô tả
            $table->longText('description')->nullable(); // nội dung HTML chi tiết
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_noidias');
    }
};
