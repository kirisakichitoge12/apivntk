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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->integer('index')->nullable();
            $table->string('type')->nullable();
            $table->string('gender')->nullable();

            $table->string('document_type')->nullable();
            $table->string('nationality')->nullable();
            $table->string('issue_country')->nullable();

            $table->string('seat_class')->nullable();
            $table->string('title')->nullable();

            $table->string('full_name')->nullable();
            $table->string('given_name')->nullable();
            $table->string('surname')->nullable();
            $table->date('date_of_birth')->nullable();

            $table->string('passport_documentType')->nullable();
            $table->string('passport_nationality')->nullable();
            $table->string('passport_issue_country')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
