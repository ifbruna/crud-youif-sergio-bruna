<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $activities = $this->activitiesByStudents();
        return view('admin-logs', ['activities' => $activities]);
    }

    public function activitiesByStudents() {
        $studentsIds = User::withTrashed()
            ->where('permission', 'user')
            ->select('id');

        return Activity::query()
            ->where('causer_type', (new User())->getMorphClass())
            ->whereIn('causer_id', $studentsIds)
            ->with(['causer', 'subject'])
            ->latest()
            ->paginate(30);
    }

    public function downloadLogs() {
        $activities = $this->activitiesByStudents();
        $pdf = Pdf::loadView("logs-template", ["activities" => $activities])->setPaper("a4", "portrait");

        return $pdf->download("relatorio.pdf");
    }

    public function viewPdf(){
        return Pdf::loadView("logs-template", ["activities" => $this->activitiesByStudents()])->setPaper("a4", "portrait")->stream("relatorio.pdf");
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

    function perfilUsuario() {
        return view("perfil-usuario");
    }

}





