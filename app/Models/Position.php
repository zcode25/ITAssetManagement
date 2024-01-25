<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'positionId';
    public $incrementing = false;
    protected $keyType = 'string';
}