<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grades;
use App\Models\Student;


class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grades::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student');
    }
  
}
