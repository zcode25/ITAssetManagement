<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMovementDevice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetMovementDevice';
    public $incrementing = false;
    protected $keyType = 'string';

    public function assetDeployment(){
        return $this->belongsTo(AssetDeployment::class, 'assetDeploymentId');
    }
}
