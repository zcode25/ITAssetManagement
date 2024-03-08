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

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function manager(){
        return $this->belongsTo(User::class, 'managerId', 'userId');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function assetDeployment(){
        return $this->hasMany(AssetDeployment::class, 'assetProcurementId', 'assetProcurementId');
    }
    
}
