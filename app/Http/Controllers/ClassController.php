<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;


class ClassController extends Controller
{
    public function addStudent(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|exists:student,id'
        ]);
        
        $user = Auth::user();
        $data['student_id'] = $user->id;
        
        $student = ClassModel::firstOrCreate($data['student_id']);
        dd($student);
    }
}
