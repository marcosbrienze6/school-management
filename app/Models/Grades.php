<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = ['grade_year'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
