<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'licenseModelId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function manufacture(){
        return $this->belongsTo(Manufacture::class, 'manufactureId');
    }
}
