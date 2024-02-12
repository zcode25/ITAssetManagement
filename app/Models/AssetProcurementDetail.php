<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetProcurementDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetProcurementDetailId';
    public $incrementing = false;
    protected $keyType = 'string';
}
