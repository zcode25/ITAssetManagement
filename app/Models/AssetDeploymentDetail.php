<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDeploymentDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetDeploymentDetailId';
    public $incrementing = false;
    protected $keyType = 'string';
}