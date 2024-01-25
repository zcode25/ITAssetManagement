<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'departementId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function user(){
        return $this->hasMany(User::class, 'locationId', 'locationId');
    }
}
