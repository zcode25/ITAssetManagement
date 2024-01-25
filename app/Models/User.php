<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'userId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function location(){
        return $this->belongsTo(Location::class, 'locationId');
    }

    public function departement(){
        return $this->belongsTo(Departement::class, 'departementId');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'positionId');
    }

    
}
