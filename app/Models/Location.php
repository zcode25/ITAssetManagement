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

    public function departement(){
        return $this->hasMany(Departement::class, 'locationId', 'locationId');
    }

}
