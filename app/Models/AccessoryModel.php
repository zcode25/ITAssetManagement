<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'accessoryModelId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function manufacture(){
        return $this->belongsTo(Manufacture::class, 'manufactureId');
    }
}
