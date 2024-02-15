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
        Schema::create('asset_procurement_details', function (Blueprint $table) {
            $table->uuid('assetProcurementDetailId')->primary();
            $table->uuid('assetProcurementId');
            $table->foreign('assetProcurementId')->references('assetProcurementId')->on('asset_procurements')->onUpdate('cascade')->onDelete('restrict');
            $table->text('assetProcurementDetailNote')->nullable();
            $table->date('assetProcurementDetailDate');
            $table->enum('assetProcurementDetailStatus', ['Approval Required', 'Approved by Manager', 'Rejected by Manager', 'Approved by IT Manager', 'Rejected by IT Manager', 'Asset Purchase', 'Asset Deployment']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_procurement_details');
    }
};
