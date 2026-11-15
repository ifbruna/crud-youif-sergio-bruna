<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Models\Subject;
use Spatie\Activitylog\Models\Activity;

class MainController extends Controller
{
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

    // Logs das ações realizadas pelos alunos.
    public function activityLogs()
    {
        $studentIds = User::withTrashed()
            ->where('permission', 'user')
            ->select('id');

        $activities = Activity::query()
            ->where('causer_type', (new User())->getMorphClass())
            ->whereIn('causer_id', $studentIds)
            ->with(['causer', 'subject'])
            ->latest()
            ->paginate(30);

        return view('admin-logs', ['activities' => $activities]);
    }

    //admin
    public function adminDashboard()
    {
        $users  = User::withTrashed()->get();
        $medias = Media::withTrashed()->get();
        $subjects = Subject::withTrashed()
            ->with(['users' => fn ($query) => $query->withTrashed()])
            ->get();

        return view('dashboard', [
            'users'    => $users,
            'medias'   => $medias,
            'subjects' => $subjects,
        ]);
    }

}





