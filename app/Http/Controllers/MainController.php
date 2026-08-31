<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function __construct(protected Operations $operations) {}

    public function index()
    {
        $medias = Media::all();
        return view('home-page', ['medias'=> $medias ]);
    }

    public function history() {

        $userId = session('user.id');
        $user = User::findOrFail($userId);
        $medias = $user->playedMedia()->get();

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

}





