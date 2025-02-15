<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Grades;



class ClassController extends Controller
{
    public function createClass(Request $request)
    {
        
    }

    public function addStudent(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|exists:student,id',
        'quantity' => 'required|integer|min:1',
        ]);
        
        $$user = Auth::user();
        $grade = Grades::firstOrCreate(['user_id' => $user->id]);
        dd($user);
        
        $student = Student::findOrFail($data['student_id']);
        $existingClass = ClassModel::where('cart_id', $cart->id)
            ->where('student_id', $student->id)
            ->first();

            if ($existingClass) {
                $existingClass->quantity += $validated['quantity'];
                $existingClass->save();
            } else {
                ClassModel::create([
                    'grade_id' => $grade->id,
                    'student_id' => $student->id,
                    'quantity' => $data['quantity'],
                ]);
            }    

        return response()->json([
        'message' => 'Aluno adicionado à turma com sucesso',
        'student' => $student    
        ]);
    }
}
