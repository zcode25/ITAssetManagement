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
        Schema::create('asset_disposals', function (Blueprint $table) {
            $table->uuid('assetDisposalId')->primary();
            $table->char('assetDisposalNumber', 20)->unique();
            $table->date('assetDisposalDate');
            $table->date('assetDisposalDisposedDate')->nullable();
            $table->uuid('userId');
            $table->foreign('userId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('managerId')->nullable();
            $table->foreign('managerId')->references('userId')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->char('locationId', 8)->nullable();
            $table->foreign('locationId')->references('locationId')->on('locations')->onUpdate('cascade')->onDelete('restrict');
            $table->char('supplierId', 8)->nullable();
            $table->foreign('supplierId')->references('supplierId')->on('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('assetDisposalType', ['Asset Discard', 'Asset Auction'])->nullable();
            $table->enum('assetDisposalStatus', ['Pre Disposal', 'Asset for Disposal','Asset Disposed']);
            $table->string('assetDisposalNote');
            $table->integer('assetDisposalAmount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_disposals');
    }
};
