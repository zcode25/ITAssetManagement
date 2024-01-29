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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('userId')->primary();
            $table->char('employeeNumber', 10)->unique();
            $table->string('employeeName', 100);
            $table->string('password');
            $table->char('locationId', 8);
            $table->foreign('locationId')->references('locationId')->on('locations')->onUpdate('cascade')->onDelete('restrict');
            $table->char('departementId', 8);
            $table->foreign('departementId')->references('departementId')->on('departements')->onUpdate('cascade')->onDelete('restrict');
            $table->char('positionId', 8);
            $table->foreign('positionId')->references('positionId')->on('positions')->onUpdate('cascade')->onDelete('restrict');
            $table->string('employeePhone', 15);
            $table->string('employeeEmail', 100);
            $table->string('employeeAddress', 200);
            $table->string('employeeCity', 100);
            $table->string('employeeProvince', 100);
            $table->json('permission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
