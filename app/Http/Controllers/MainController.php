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

        public function adminEditUser($id)
    {
        $user = User::withTrashed()->findOrFail(Operations::decryptId($id));
        return view('cadastro-usuario', ['editUser' => $user]);
    }

    public function adminEditUserSubmit(Request $request, $id)
    {
        $request->validate([
            'text_email'    => 'required|email|max:200',
            'text_name'     => 'required|min:3|max:50',
            'text_password' => 'nullable|min:6',
        ]);

        $user             = User::withTrashed()->findOrFail(Operations::decryptId($id));
        $user->email      = $request->text_email;
        $user->name       = $request->text_name;
        $user->permission = $request->text_permission ?? $user->permission;

        if ($request->filled('text_password')) {
            $user->password = bcrypt($request->text_password);
        }

        $user->save();

        return redirect()->route('admin_dashboard')->with('success', 'Usuário atualizado.');
    }

    public function adminDeleteUser($id)
    {
        User::findOrFail(Operations::decryptId($id))->delete();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário deletado.');
    }

    public function adminRestoreUser($id)
    {
        User::withTrashed()->findOrFail(Operations::decryptId($id))->restore();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário restaurado.');
    }

    public function adminForceDeleteUser($id)
    {
        User::withTrashed()->findOrFail(Operations::decryptId($id))->forceDelete();
        return redirect()->route('admin_dashboard')->with('success', 'Usuário deletado permanentemente.');
    }

    public function adminEditMedia($id)
    {
        $media = Media::withTrashed()->findOrFail(Operations::decryptId($id));
        return view('cadastro-midia', ['editMedia' => $media]);
    }

    public function adminEditMediaSubmit(Request $request, $id)
    {
        $request->validate([
            'media_title'       => 'required|max:200',
            'media_description' => 'nullable',
            'media_image'       => 'nullable|image',
            'media_file'        => 'nullable|mimetypes:video/*,audio/*',
        ]);

        $media              = Media::withTrashed()->findOrFail(Operations::decryptId($id));
        $media->title       = $request->media_title;
        $media->description = $request->media_description;

        if ($request->hasFile('media_image')) {
            $media->image = Storage::disk('public')
                                    ->putFile('uploaded/images', $request->file('media_image'));
        }

        if ($request->hasFile('media_file')) {
            $mediaFile = $request->file('media_file');
            $mediaType = $mediaFile->getMimeType();

            if (str_contains($mediaType, 'video/')) {
                $media->type = 'video';
            } elseif (str_contains($mediaType, 'audio/')) {
                $media->type = 'audio';
            } else {
                return redirect()->back()->withErrors(['invalidFileType' => 'Tipo de arquivo inválido']);
            }

            $media->file = Storage::disk('public')
                                ->putFile('uploaded/media', $mediaFile);
        }

        $media->save();

        return redirect()->route('admin_dashboard')->with('success', 'Mídia atualizada.');
    }

    public function adminDeleteMedia($id)
    {
        Media::findOrFail(Operations::decryptId($id))->delete();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia deletada.');
    }

    public function adminRestoreMedia($id)
    {
        Media::withTrashed()->findOrFail(Operations::decryptId($id))->restore();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia restaurada.');
    }

    public function adminForceDeleteMedia($id)
    {
        Media::withTrashed()->findOrFail(Operations::decryptId($id))->forceDelete();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia deletada permanentemente.');
    }

}





