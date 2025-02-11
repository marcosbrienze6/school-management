<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = ['user_id', 'name', 'password', 'gender', 'phone_number', 'address', 'role', 'birth_date'];

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
