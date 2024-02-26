<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetProcurementDevice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetProcurementDeviceId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function assetModel(){
        return $this->belongsTo(AssetModel::class, 'assetModelId');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplierId');
    }
}
