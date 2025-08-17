<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
   {
        Schema::table('passengers', function (Blueprint $table) {
            $table->string('passport_document_code')->nullable();
            $table->date('passport_document_expiry')->nullable();
        });
   }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('passengers', function (Blueprint $table) {
            //
        });
    }
};
