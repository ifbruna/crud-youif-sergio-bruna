<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function viewMedia($id) {

        $media = Media::find(Operations::decryptId($id));
        $user = User::find(session()->get('user.id'));

        if (!$media->users()->where('user_id', $user->id)->exists()) {
            $media->users()->attach($user->id, ['last_time_played'=>Carbon::now()]);
        }
        else {
            $media->users()->updateExistingPivot($user->id, ['last_time_played'=>Carbon::now()]);
        };

        return view('midia-page',["media"=> $media]);
    }

    public function newMedia() {
        return view('cadastro-midia');
    }

    public function likeMedia($id) {

        $media = Media::find(Operations::decryptId($id));
        $user = User::find(session()->get('user.id'));

        $pivot = $media->users()->where('user_id', $user->id)->first();

        $media->users()->updateExistingPivot($user->id, ['is_liked'=> !$pivot->pivot->is_liked]);
        return redirect()->back();
    }

    public function submitNewMedia(Request $request) {

        $request->validate(
            [
                'media_title' => 'required|min:3',
                'media_description' => 'nullable',
                'media_image' => 'required',
                'media_file' => 'required',
            ],
            [
                'media_title.required' => "O título é obrigatório.",
                'media_title.min' => "O título deve conter no mínimo :min caractéres.",
                
                'media_image.required' => "O envio de uma imagem é obrigatório.",

                'media_file.required' => "O envio de um arquivo é obrigatório.."
            ]
        );

        $media = new Media();

        if ($request->hasFile('media_image')) {
            $image = $request->file('media_image');
            $imagePath = Storage::disk('public')->putFile('uploaded/images', $image);

            $media->image = $imagePath;
        }
        else {
            return redirect()->back()->withErrors(["notFoundMediaImage"=>"Imagem não enviada"]);
        }

        if ($request->hasFile('media_file')) {

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

            $media->file = $mediaFilePath;
            $media->type = $mediaType;

        }
        else {
            return redirect()->back()->withErrors(["notFoundMediaFile"=>"Arquivo não enviado"]);
        }


        $media->author_id = $request->media_author_id;
        $media->title = $request->media_title;
        $media->description = $request->media_description ?? "\"...\"";

        $media->save();

        return redirect('/');

    }
    public function adminDelete($id)
    {
        Media::findOrFail(Operations::decryptId($id))->delete();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia deletada.');
    }

    public function adminRestore($id)
    {
        Media::withTrashed()->findOrFail(Operations::decryptId($id))->restore();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia restaurada.');
    }

    public function adminForceDelete($id)
    {
        Media::withTrashed()->findOrFail(Operations::decryptId($id))->forceDelete();
        return redirect()->route('admin_dashboard')->with('success', 'Mídia deletada permanentemente.');
    }

    public function adminEdit($id)
    {
        $media = Media::withTrashed()->findOrFail(Operations::decryptId($id));
        return view('cadastro-midia', ['editMedia' => $media]);
    }

    public function adminEditSubmit(Request $request, $id)
    {
        $request->validate([
            'media_title'       => 'required|max:200',
            'media_description' => 'nullable',
            'media_image'       => 'required|image',
            'media_file'        => 'requred|mimetypes:video/*,audio/*',
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
            } 
            elseif (str_contains($mediaType, 'audio/')) {
                $media->type = 'audio';
            } 
            else {
                return redirect()->back()->withErrors(['invalidFileType' => 'Tipo de arquivo inválido']);
            }

            $media->file = Storage::disk('public')
                                ->putFile('uploaded/media', $mediaFile);
        }

        $media->save();

        return redirect()->route('admin_dashboard')->with('success', 'Mídia atualizada.');
    }
}
