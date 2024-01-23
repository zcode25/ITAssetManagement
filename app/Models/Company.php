<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'companyId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function location(){
        return $this->hasMany(Location::class, 'companyId', 'companyId');
    }
}
