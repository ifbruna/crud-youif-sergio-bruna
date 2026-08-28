@extends('layouts.form-layout')

@include('partials.top-bar')

@section('form-content')

    <form action="#" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="media_type" class="form-label">
                Tipo do Conteúdo
            </label>

            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-user"></i>
                </span>

                <select name="media_type" id="media_type" class="form-select">
                    <option selected hidden>Selecione um tipo</option>
                    <option value="video">Vídeo</option>
                    <option value="audio">Audio</option>
                </select>
            </div>

            @error('media_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>

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
            <button type="submit" class="btn btn-secondary w-100">
                <i class="fa-solid fa-user-plus"></i>
                &nbsp;&nbsp;Novo Conteúdo
            </button>
        </div>
    </form>

@endsection