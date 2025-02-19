<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function createSubject(SubjectRequest $request)
    {
        $data = $request->validated();
        $subject = Subject::create($data);

        return response()->json([
            'error' => false,
            'message' => 'Disciplina criada com sucesso.',
            'disciplina' => $subject
        ]);
    }

    public function addSubjectToClass(AddSubjectRequest $request)
    {
        $data = $request->validated();
        $class = ClassModel::findOrFail($data['class_id']);
        $student = Student::findOrFail($data['student_id']);

        $existingRecord = ClassSubject::where('class_id', $class->id)
        ->where('student_id', $student->id)
        ->exists(); 

        if ($existingRecord) {
            return response()->json([
            'error' => true,
            'message' => 'Essa disciplina já está registrada nesta turma.'
            ], 400);
        }

        $class = ClassSubject::create($data);
        
        return response()->json([
        'message' => 'Disciplina adicionada à turma com sucesso',
        'class' => $class
        ]);
    }

    public function updateSubject(SubjectRequest $request, $subjectId)
    {
        $subject = Subject::find($subjectId);
        $subject->update($request->validated());

        return response()->json([
            'error' => false,
            'message' => 'Disciplina atualizada com sucesso.',
            'disciplina' => $subject
        ]);
    }

    public function deleteSubject($subjectId)
    {
        $subject = Subject::find($subjectId);
        $subject->delete();

        return response()->json([
            'error' => false,
            'message' => 'Disciplina deletada com sucesso.',
        ]);
    }
}
