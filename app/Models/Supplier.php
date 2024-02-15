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

    public function assetPurchase(){
        return $this->hasMany(AssetPurchase::class, 'supplierId', 'supplierId');
    }
}
