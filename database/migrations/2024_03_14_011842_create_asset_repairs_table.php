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
        Schema::create('asset_repairs', function (Blueprint $table) {
            $table->uuid('assetRepairId')->primary();
            $table->char('assetRepairNumber', 20)->unique();
            $table->uuid('assetDeploymentId');
            $table->foreign('assetDeploymentId')->references('assetDeploymentId')->on('asset_deployments')->onUpdate('cascade')->onDelete('restrict');
            $table->date('assetRepairDate');
            $table->date('assetRepairCompletionDate')->nullable();
            $table->char('supplierId', 8)->nullable();
            $table->foreign('supplierId')->references('supplierId')->on('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('assetRepairCost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_repairs');
    }
};
