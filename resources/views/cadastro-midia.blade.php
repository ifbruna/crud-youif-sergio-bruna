@extends('layouts.form-layout')

@include('partials.top-bar')

@section('form-content')

    <form action="{{ route('submit_new_media') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="media_author_id" id="media_author_id" value="{{ session()->get('user.id') }}">

        <div class="mb-3">
            <label for="media_title" class="form-label">
            Título
            </label>

            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-id-card"></i>
                </span>

                <input
                    type="text"
                    class="form-control"
                    name="media_title"
                    value="{{ old('media_title') }}"
                >
            </div>

            @error('media_title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="media_description" class="form-label">
            Descrição
            </label>

            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-id-card"></i>
                </span>

                <textarea 
                    name="media_description" 
                    id="media_description" 
                    class="form-control"
                >{{ old('media_description') }}</textarea>
            </div>

            @error('media_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="media_image" class="form-label">
            Imagem
            </label>

            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-key"></i>
                </span>

                <input
                    type="file"
                    class="form-control"
                    name="media_image"
                    accept="image/*"
                    value="{{ old('media_image') }}"
                >
            </div>

            @error('media_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="media_file" class="form-label">
            Arquivo
            </label>

            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-key"></i>
                </span>

                <input
                    type="file"
                    class="form-control"
                    name="media_file"
                    accept="video/*, audio/*"
                    value="{{ old('media_file') }}"
                >
            </div>

            @error('media_file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-secondary w-100">
                <i class="fa-solid fa-user-plus"></i>
                &nbsp;&nbsp;Novo Conteúdo
            </button>
        </div>
    </form>

@endsection