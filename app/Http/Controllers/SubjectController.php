<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Services\Operations;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function newSubject()
    {
        return view('cadastro-materia');
    }

    public function submitNewSubject(Request $request)
    {
        $request->validate(
            [
                'subject_name'        => 'required|min:3|max:100',
                'subject_description' => 'nullable',
            ],
            [
                'subject_name.required' => 'O nome da matéria é obrigatório.',
                'subject_name.min'      => 'O nome da matéria deve conter no mínimo :min caracteres.',
                'subject_name.max'      => 'O nome da matéria deve conter no máximo :max caracteres.',
            ]
        );

        $subject = new Subject();
        $subject->name        = $request->subject_name;
        $subject->description = $request->subject_description;
        $subject->save();

        return redirect()->route('admin_dashboard')->with('success', 'Matéria cadastrada.');
    }

    public function adminDelete($id)
    {
        Subject::findOrFail(Operations::decryptId($id))->delete();
        return redirect()->route('admin_dashboard')->with('success', 'Matéria deletada.');
    }

    public function adminRestore($id)
    {
        Subject::withTrashed()->findOrFail(Operations::decryptId($id))->restore();
        return redirect()->route('admin_dashboard')->with('success', 'Matéria restaurada.');
    }

    public function adminForceDelete($id)
    {
        Subject::withTrashed()->findOrFail(Operations::decryptId($id))->forceDelete();
        return redirect()->route('admin_dashboard')->with('success', 'Matéria deletada permanentemente.');
    }

    public function adminEdit($id)
    {
        $subject = Subject::withTrashed()->findOrFail(Operations::decryptId($id));
        return view('cadastro-materia', ['editSubject' => $subject]);
    }

    public function adminEditSubmit(Request $request, $id)
    {
        $request->validate(
            [
                'subject_name'        => 'required|min:3|max:100',
                'subject_description' => 'nullable',
            ],
            [
                'subject_name.required' => 'O nome da matéria é obrigatório.',
                'subject_name.min'      => 'O nome da matéria deve conter no mínimo :min caracteres.',
                'subject_name.max'      => 'O nome da matéria deve conter no máximo :max caracteres.',
            ]
        );

        $subject              = Subject::withTrashed()->findOrFail(Operations::decryptId($id));
        $subject->name        = $request->subject_name;
        $subject->description = $request->subject_description;
        $subject->save();

        return redirect()->route('admin_dashboard')->with('success', 'Matéria atualizada.');
    }
}
