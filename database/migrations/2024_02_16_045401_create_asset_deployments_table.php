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
            $table->char('assetDeploymentNumber', 20)->unique();
            $table->date('assetDeploymentDate');
            $table->uuid('userId')->nullable();
            $table->foreign('userId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('assetId')->nullable();
            $table->foreign('assetId')->references('assetDeploymentId')->on('asset_deployments')->onUpdate('cascade')->onDelete('restrict');
            $table->char('locationId', 8)->nullable();
            $table->foreign('locationId')->references('locationId')->on('locations')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('assetProcurementId');
            $table->foreign('assetProcurementId')->references('assetProcurementId')->on('asset_procurements')->onUpdate('cascade')->onDelete('restrict');
            $table->char('assetModelId', 8);
            $table->foreign('assetModelId')->references('assetModelId')->on('asset_models')->onUpdate('cascade')->onDelete('restrict');
            $table->string('assetDeploymentImage', 100)->nullable();
            $table->char('assetSerialNumber', 50)->nullable();
            $table->char('assetProductKey', 50)->nullable();
            $table->date('assetExpirationDate')->nullable();
            $table->enum('assetDeploymentStatus', ['Pre Deployment', 'Deployment Ready', 'Checkout', 'Archive', 'Repair', 'Broken', 'Asset Movement', 'Asset Disposal']);
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
