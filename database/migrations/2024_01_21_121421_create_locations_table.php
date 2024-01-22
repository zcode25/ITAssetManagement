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
        Schema::create('locations', function (Blueprint $table) {
            $table->char('locationId', 8)->primary();
            $table->char('companyId', 8);
            $table->foreign('companyId')->references('companyId')->on('companies')->onUpdate('cascade')->onDelete('restrict');
            $table->string('locationName', 100);
            $table->string('locationPhone', 15);
            $table->string('locationEmail', 100);
            $table->string('locationAddress', 200);
            $table->string('locationCity', 100);
            $table->string('locationState', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
