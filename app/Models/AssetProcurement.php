<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetProcurement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetProcurementId';
    public $incrementing = false;
    protected $keyType = 'string';
    
}
