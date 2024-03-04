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
        Schema::create('asset_movement_devices', function (Blueprint $table) {
            $table->uuid('assetMovementDeviceId')->primary();
            $table->uuid('assetMovementId');
            $table->foreign('assetMovementId')->references('assetMovementId')->on('asset_movements')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('assetDeploymentId');
            $table->foreign('assetDeploymentId')->references('assetDeploymentId')->on('asset_deployments')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_movement_devices');
    }
};
