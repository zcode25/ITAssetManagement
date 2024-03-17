<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDisposal extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'assetDisposalId';
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

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplierId');
    }
}
