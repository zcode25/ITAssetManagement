<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDisposalDevice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetDisposalDeviceId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function assetDeployment(){
        return $this->belongsTo(AssetDeployment::class, 'assetDeploymentId');
    }
}
