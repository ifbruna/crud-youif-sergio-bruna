@use(App\Services\Operations)

@extends('layouts.form-layout')

@section('form-content')

    <form action="{{ isset($editSubject) ? route('admin_edit_subject_submit', Operations::encryptId($editSubject->id)) : route('submit_new_subject') }}"
          method="POST" novalidate autocomplete="off">
        @csrf

        <h5 class="mb-4 text-center">
            {{ isset($editSubject) ? 'Editar Matéria' : 'Cadastro de Matéria' }}
        </h5>

        <div class="mb-3">
            <label for="subject_name" class="form-label">Nome</label>
            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-book"></i>
                </span>
                <input type="text" class="form-control" name="subject_name"
                       value="{{ old('subject_name', $editSubject->name ?? '') }}">
            </div>
            @error('subject_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subject_description" class="form-label">Descrição</label>
            <div class="input-group">
                <span class="input-group-text text-danger">
                    <i class="fa-solid fa-align-left"></i>
                </span>
                <textarea name="subject_description" class="form-control">{{ old('subject_description', $editSubject->description ?? '') }}</textarea>
            </div>
            @error('subject_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-secondary w-100">
                <i class="fa-solid fa-{{ isset($editSubject) ? 'floppy-disk' : 'circle-plus' }}"></i>
                &nbsp;&nbsp;{{ isset($editSubject) ? 'Salvar Alterações' : 'Cadastrar Matéria' }}
            </button>

            <a href="{{ route('admin_dashboard') }}" class="btn btn-outline-secondary w-100 mt-2">
                Cancelar
            </a>
        </div>
    </form>

@endsection
