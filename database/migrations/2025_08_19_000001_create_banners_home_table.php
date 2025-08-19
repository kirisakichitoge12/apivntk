<?php
// database/migrations/2025_08_19_000001_create_banners_home_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('banners_home', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // đường dẫn ảnh
            $table->string('alt')->nullable(); // alt cho SEO
            $table->string('title')->nullable(); // tiêu đề phụ
            $table->string('link')->nullable(); // nếu banner có link
            $table->boolean('lazy')->default(true); // lazy loading
            $table->timestamps();
        });

        Schema::create('backgrounds_home', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); 
            $table->string('alt')->nullable();
            $table->boolean('lazy')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('banners_home');
        Schema::dropIfExists('backgrounds_home');
    }
};
