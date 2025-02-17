<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grades;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
        'grade_year' => 'required|string|max:255'
        ]);

        $grade = Grades::create($data);

        return response()->json([
        'error' => false,
        'grade' => $grade
        ]);
    }

    public function update(UpdateGradeRequest $request, $gradeId)
    {
        $grade = Grades::find($gradeId);
        $grade->update($request->validated());

        return response()->json([
        'error' => false,
        'grade' => $grade,
        'message' => 'Ano atualizado com sucesso.'
        ]);
    }
}
