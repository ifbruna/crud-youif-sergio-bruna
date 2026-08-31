@use(App\Services\Operations)
@extends('layouts.form-layout')

@section('form-content')

    <form action="{{ isset($editMedia) ? route('admin_edit_media_submit', Operations::encryptId($editMedia->id)) : route('submit_new_media') }}" 
          method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
        @csrf

        <h5 class="mb-4 text-center">
            {{ isset($editMedia) ? 'Editar Mídia' : 'Novo Conteúdo' }}
        </h5>
        
        <input type="hidden" name="media_author_id" value="{{ session()->get('user.id') }}">

        <div class="mb-3">
            <label for="media_title" class="form-label">Título</label>
            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-id-card"></i>
                </span>
                <input type="text" class="form-control" name="media_title"
                       value="{{ old('media_title', $editMedia->title ?? '') }}">
            </div>
            @error('media_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="media_description" class="form-label">Descrição</label>
            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-id-card"></i>
                </span>
                <textarea name="media_description" class="form-control">{{ old('media_description', $editMedia->description ?? '') }}</textarea>
            </div>
            @error('media_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="media_image" class="form-label">
                Imagem
                @isset($editMedia)
                    <small class="text-secondary">(deixe em branco para manter a atual)</small>
                @endisset
            </label>


            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="file" class="form-control" name="media_image" accept="image/*">
            </div>
            @error('media_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="media_file" class="form-label">
                Arquivo
                @isset($editMedia)
                    <small class="text-secondary">(deixe em branco para manter o atual)</small>
                @endisset
            </label>
            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-key"></i>
                </span>
                <input type="file" class="form-control" name="media_file" accept="video/*, audio/*">
            </div>
            @error('media_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-secondary w-100">
                <i class="fa-solid fa-{{ isset($editMedia) ? 'floppy-disk' : 'user-plus' }}"></i>
                &nbsp;&nbsp;{{ isset($editMedia) ? 'Salvar Alterações' : 'Novo Conteúdo' }}
            </button>

            @isset($editMedia)
                <a href="{{ route('admin_dashboard') }}" class="btn btn-outline-secondary w-100 mt-2">
                    Cancelar
                </a>
            @endisset
        </div>
    </form>

@endsection