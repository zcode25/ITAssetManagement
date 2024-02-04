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
        Schema::create('accessory_models', function (Blueprint $table) {
            $table->char('accessoryModelId', 8)->primary();
            $table->string('accessoryModelName', 100);
            $table->char('categoryId', 8);
            $table->foreign('categoryId')->references('categoryId')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->char('manufactureId', 8);
            $table->foreign('manufactureId')->references('manufactureId')->on('manufactures')->onUpdate('cascade')->onDelete('restrict');
            $table->string('accessoryModelNumber', 100);
            $table->string('accessoryModelImage', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessory_models');
    }
};
