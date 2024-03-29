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

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function assetDeployment(){
        return $this->belongsTo(AssetDeployment::class, 'assetDeploymentId');
    }
}
