<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('banners_khuyenmai', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->boolean('lazy')->default(true);
            $table->timestamps();
        });

        Schema::create('backgrounds_khuyenmai', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('alt')->nullable();
            $table->boolean('lazy')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('banners_khuyenmai');
        Schema::dropIfExists('backgrounds_khuyenmai');
    }
};
