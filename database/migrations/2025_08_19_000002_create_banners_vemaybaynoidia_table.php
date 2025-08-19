<?php
// database/migrations/2025_08_19_000002_create_banners_vemaybaynoidia_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('banners_vemaybaynoidia', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->boolean('lazy')->default(true);
            $table->timestamps();
        });

        Schema::create('backgrounds_vemaybaynoidia', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('alt')->nullable();
            $table->boolean('lazy')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('banners_vemaybaynoidia');
        Schema::dropIfExists('backgrounds_vemaybaynoidia');
    }
};
