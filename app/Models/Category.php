<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'categoryId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function assetModel(){
        return $this->hasMany(assetModel::class, 'categoryId', 'categoryId');
    }

    public function depreciation(){
        return $this->hasMany(depreciation::class, 'categoryId', 'categoryId');
    }
}
