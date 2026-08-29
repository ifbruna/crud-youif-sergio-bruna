<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        return view('home-page');
    }

    public function newMedia() {
        return view('cadastro-midia');
    }

    public function viewMedia($id) {
        $media = Media::findOrFail($id);
        $userId = session('user.id');

        $media->users()->syncWithoutDetaching([
            $userId => [
                'last_time_played' => now(),
                'last_timestamp'   => 0,
                'is_liked'         => false,
            ]
        ]);

        return view('midia-page', ['media' => $media]);
    }

    public function history() {
    $userId = session('user.id');
    $user = User::findOrFail($userId);
    $medias = $user->medias()->get();

    return view('history', ['medias' => $medias]);
    }

    //admin
    public function adminDashboard()
    {
        $users  = User::withTrashed()->get();
        $medias = Media::withTrashed()->get();

        return view('dashboard', [
            'users'  => $users,
            'medias' => $medias,
        ]);
    }

    public function adminDeleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin_dashboard')
                         ->with('success', 'Usuário deletado.');
    }

    public function adminRestoreUser($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin_dashboard')
                         ->with('success', 'Usuário restaurado.');
    }

    public function adminDeleteMedia($id)
    {
        Media::findOrFail($id)->delete();
        return redirect()->route('admin_dashboard')
                         ->with('success', 'Mídia deletada.');
    }

    public function adminRestoreMedia($id)
    {
        Media::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin_dashboard')
                         ->with('success', 'Mídia restaurada.');
    }

}





