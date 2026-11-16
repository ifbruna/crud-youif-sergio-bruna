<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function adminRestore($id)
    {
        User::withTrashed()->findOrFail(Operations::decryptId($id))->restore();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário restaurado.');
    }

    public function adminDelete($id)
    {
        User::findOrFail(Operations::decryptId($id))->delete();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário deletado.');
    }

    public function adminForceDelete($id)
    {
        User::withTrashed()->findOrFail(Operations::decryptId($id))->forceDelete();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário deletado permanentemente.');
    }

    public function adminEditUser($id)
    {
        $user = User::withTrashed()->findOrFail(Operations::decryptId($id));
        $subjects = Subject::all();

        return view('cadastro-usuario', ['editUser' => $user, 'subjects' => $subjects]);
    }

    public function adminEditUserSubmit(Request $request, $id)
    {
        $request->validate([
            'text_email'    => 'required|email|max:200',
            'text_name'     => 'required|min:3|max:50',
            'text_password' => 'nullable|min:6',
            'subject_id'    => ['nullable', Rule::exists('subjects', 'id')->whereNull('deleted_at')],
        ]);

        $user             = User::withTrashed()->findOrFail(Operations::decryptId($id));
        $user->email      = $request->text_email;
        $user->name       = $request->text_name;
        $user->permission = $request->text_permission ?? $user->permission;

        $user->subject_id = ($user->permission === 'admin' && $request->filled('subject_id'))
                                ? $request->subject_id
                                : null;

        dd($user->subject_id);

        if ($request->filled('text_password')) {
            $user->password = bcrypt($request->text_password);
        }

        // $user->save();

        // return redirect()->route('admin_dashboard')->with('success', 'Usuário atualizado.');
    }

    public function updateSession() {
        
    }
}
