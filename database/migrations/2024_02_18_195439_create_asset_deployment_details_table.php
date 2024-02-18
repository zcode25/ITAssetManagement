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
        Schema::create('asset_deployment_details', function (Blueprint $table) {
            $table->uuid('assetDeploymentDetailId')->primary();
            $table->uuid('assetDeploymentId');
            $table->foreign('assetDeploymentId')->references('assetDeploymentId')->on('asset_deployments')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('userId')->nullable();
            $table->foreign('userId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->date('assetDeploymentDetailDate');
            $table->enum('assetDeploymentDetailStatus', ['Pre Deployment', 'Ready Deployment']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_deployment_details');
    }
};
