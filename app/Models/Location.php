<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'locationId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function company(){
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function user(){
        return $this->hasMany(User::class, 'locationId', 'locationId');
    }

    public function assetProcurement(){
        return $this->hasMany(AssetProcurement::class, 'locationId', 'locationId');
    }

    public function assetDeployment(){
        return $this->hasMany(AssetDeployment::class, 'locationId', 'locationId');
    }

    public function assetDeploymentDetail(){
        return $this->hasMany(AssetDeploymentDetail::class, 'locationId', 'locationId');
    }

    public function assetMovement(){
        return $this->hasMany(AssetMovement::class, 'locationId', 'locationId');
    }

    public function assetDisposal(){
        return $this->hasMany(AssetDisposal::class, 'locationId', 'locationId');
    }

}
