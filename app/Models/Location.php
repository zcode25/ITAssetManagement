<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'locationId';
    public $incrementing = false;
    protected $keyType = 'string';
}
