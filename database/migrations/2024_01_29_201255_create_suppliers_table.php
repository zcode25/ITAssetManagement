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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->char('supplierId', 8)->primary();
            $table->string('supplierName', 100);
            $table->string('supplierPhone', 15);
            $table->string('supplierEmail', 100);
            $table->string('supplierAddress', 200);
            $table->string('supplierCity', 100);
            $table->string('supplierProvince', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
