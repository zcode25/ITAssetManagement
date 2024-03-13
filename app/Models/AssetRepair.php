<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRepair extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetRepairId';
    public $incrementing = false;
    protected $keyType = 'string';
}
