<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetPurchase extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetPurchaseId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplierId');
    }
}
