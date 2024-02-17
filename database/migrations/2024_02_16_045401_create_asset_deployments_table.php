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
        Schema::create('asset_deployments', function (Blueprint $table) {
            $table->uuid('assetDeploymentId')->primary();
            $table->uuid('assetProcurementId');
            $table->foreign('assetProcurementId')->references('assetProcurementId')->on('asset_procurements')->onUpdate('cascade')->onDelete('restrict');
            $table->char('assetModelId', 8);
            $table->foreign('assetModelId')->references('assetModelId')->on('asset_models')->onUpdate('cascade')->onDelete('restrict');
            $table->char('assetSerialNumber', 50)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_deployments');
    }
};
