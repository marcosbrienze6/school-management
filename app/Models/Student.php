<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student';

    protected $fillable = ['user_id', 'name', 'email', 'password', 'gender', 'phone_number', 'address', 'birth_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grades()
    {
        return $this->hasMany(StudentGrade::class);
    }

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class);
    }
}
