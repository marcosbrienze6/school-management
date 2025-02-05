<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'user_id', 'registration_number'];

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
