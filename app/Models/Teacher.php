<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = ['user_id', 'name', 'email', 'password', 'gender', 'address', 'phone_number', 'date_of_hire', 'subjects', 'birth_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
