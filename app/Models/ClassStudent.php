<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $table = 'class_student';

    protected $fillable = ['class_id', 'student_id'];
}
