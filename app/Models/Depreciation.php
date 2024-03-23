<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'depreciationId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
