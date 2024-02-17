<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDeployment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetDeploymentId';
    public $incrementing = false;
    protected $keyType = 'string';
}
