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
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dev_id');
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->string('image', 50)->nullable();
            $table->string('genre', 50)->nullable();
            $table->timestamps();
        
            $table->foreign('dev_id')->references('id')->on('developers');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
