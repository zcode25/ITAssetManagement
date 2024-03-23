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
        Schema::create('depreciations', function (Blueprint $table) {
            $table->char('depreciationId', 8)->primary();
            $table->string('depreciationName', 100);
            $table->char('categoryId', 8);
            $table->foreign('categoryId')->references('categoryId')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('depreciationUseful');
            $table->integer('depreciationResidual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depreciations');
    }
};
