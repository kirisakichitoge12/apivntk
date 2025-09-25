<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flight_noidia', function (Blueprint $table) {
            $table->id();
            $table->string('from', 10);         // mã sân bay đi (SGN, HAN, DAD…)
            $table->string('to', 10);           // mã sân bay đến
            $table->date('departure_date')->nullable(); // ngày đi (có thể null)
            $table->date('return_date')->nullable();    // ngày về (có thể null)
            $table->decimal('price', 10, 2)->nullable(); // giá vé (dtcp)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_noidia');
    }
};
