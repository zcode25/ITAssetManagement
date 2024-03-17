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
        Schema::create('asset_disposal_devices', function (Blueprint $table) {
            $table->uuid('assetDisposalDeviceId')->primary();
            $table->uuid('assetDisposalId');
            $table->foreign('assetDisposalId')->references('assetDisposalId')->on('asset_disposals')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('asset_disposal_devices');
    }
};
