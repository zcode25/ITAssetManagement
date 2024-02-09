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
        Schema::create('asset_procurements', function (Blueprint $table) {
            $table->uuid('assetProcurementId')->primary();
            $table->char('assetProcurementNumber', 20)->unique();
            $table->date('assetProcurementDate');
            $table->uuid('userId');
            $table->foreign('userId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->text('assetProcurementNote');
            $table->text('assetProcurementStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_procurements');
    }
};
