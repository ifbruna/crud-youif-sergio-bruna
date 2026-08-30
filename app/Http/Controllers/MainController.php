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

    public function newMedia() {
        return view('cadastro-midia');
    }

    public function submitNewMedia(Request $request) {

        $image = $request->file('media_image');
        $imagePath = Storage::disk('public')->putFile('uploaded/images', $image);

        $mediaFile = $request->file('media_file');
        $mediaFilePath = Storage::disk('public')->putFile('uploaded/media', $mediaFile);
        
        $mediaType = $mediaFile->getMimeType();

        if (str_contains($mediaType, "video/")) {
            $mediaType = "video";
        }
        elseif (str_contains($mediaType, "audio/")) {
            $mediaType = "audio";
        }
        else {
            return redirect()->back()->withErrors(["invalidFileType"=>"Tipo de arquivo inválido"]);
        }

        $media = new Media();

        $media->author_id = $request->media_author_id;
        $media->title = $request->media_title;
        $media->description = $request->media_description;
        $media->image = $imagePath;
        $media->file = $mediaFilePath;
        $media->type = $mediaType;

        $media->save();

        return redirect('/');

    }

    public function viewMedia($id) {

        $media = Media::find(Operations::decryptId($id));

        return view('midia-page',["media"=> $media]);
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





