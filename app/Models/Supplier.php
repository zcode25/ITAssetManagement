<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'supplierId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function assetProcurementDevice(){
        return $this->hasMany(AssetProcurementDevice::class, 'supplierId', 'supplierId');
    }

    public function assetDisposal(){
        return $this->hasMany(AssetDisposal::class, 'supplierId', 'supplierId');
    }
}
