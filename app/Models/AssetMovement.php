<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMovement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetMovementId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }
}
