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
        Schema::create('work_histories', function (Blueprint $table) {
            $table->id('work_history_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('company_id');
            $table->string('position');
            $table->date('start');
            $table->date('end')->nullable(); // Permitiendo que el final sea nulo en caso de que aún esté trabajando allí
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('author_id')->references('author_id')->on('authors')->onDelete('cascade');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_histories');
    }
};
