<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumableModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'consumableModelId';
    public $incrementing = false;
    protected $keyType = 'string';
}
