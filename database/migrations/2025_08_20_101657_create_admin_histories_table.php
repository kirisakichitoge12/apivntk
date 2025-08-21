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
        Schema::create('admin_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('admin_id');
        $table->string('action'); // add, edit, delete
        $table->string('table_name');
        $table->text('details')->nullable(); // chi tiết (record nào)
        $table->timestamp('acted_at')->useCurrent();

        $table->foreign('admin_id')->references('id')->on('admins_custom')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_histories');
    }
};
