<?php
// database/migrations/2025_09_09_000002_create_faqs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('faq_categories')->onDelete('cascade');
            $table->text('question');
            $table->longText('answer');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('faqs');
    }
};
