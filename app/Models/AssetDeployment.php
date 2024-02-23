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

    public function assetProcurement(){
        return $this->belongsTo(AssetProcurement::class, 'assetProcurementId');
    }

    public function assetModel(){
        return $this->belongsTo(AssetModel::class, 'assetModelId');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }
}
