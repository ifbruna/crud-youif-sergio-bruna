@use(App\Services\Operations)
@extends('layouts.main-layout')

@use('Illuminate\Support\Carbon')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">
        <i class="fa-solid fa-shield-halved me-2"></i>Painel Admin
    </h2>
    
    <hr>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h4 class="mt-4 mb-3">
        <i class="fa-solid fa-users me-2"></i>Usuários
    </h4>

    <div class="table-responsive">
    
        <table class="table table-hover table-striped table-secondary align-middle">
            <thead>
                <tr class="table-dark">
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($users as $user)
                <tr class="{{ $user->deleted_at ? 'table-danger' : '' }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->permission }}</td>
                    <td>
                        @if($user->deleted_at)
                            <span class="badge bg-danger">Deletado</span>
                        @else
                            <span class="badge bg-success">Ativo</span>
                        @endif
                    </td>
                    <td class="justify-content-center">
                        @if($user->deleted_at)
                            <a href="{{ route('admin_restore_user', Operations::encryptId($user->id)) }}" class="btn btn-sm btn-success">
                                <i class="fa-solid fa-rotate-left me-1"></i>Restaurar
                            </a>
                            <a href="{{ route('admin_force_delete_user', Operations::encryptId($user->id)) }}" class="btn btn-sm btn-danger bg-dark">
                                <i class="fa-solid fa-trash me-1"></i>Deletar Permanentemente
                            </a>
                        @else
                            <a href="{{ route('admin_delete_user', Operations::encryptId($user->id)) }}" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash me-1"></i>Deletar
                            </a>
                        @endif
                        <a href="{{ route('admin_edit_user', Operations::encryptId($user->id)) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-pen"></i> Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="mt-5 mb-3">
        <i class="fa-solid fa-film me-2"></i>Mídias
    </h4>

    <table class="table table-hover table-striped table-secondary align-middle">
        <thead>
            <tr class="table-dark">
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Postado em</th>
                <th>Status</th>
                <th>Ação</th>
        </thead>
        <tbody class="table-group-divider">
            @foreach($medias as $media)
                <tr class="{{ $media->deleted_at ? 'table-danger' : '' }}">
                    <td>{{ $media->id }}</td>
                    <td>{{ $media->title }}</td>
                    <td>{{ $media->type }}</td>
                    <td>{{ Carbon::parse($media->posted_at)->format('d/m/Y - H:i') }}</td>
                    <td>
                        @if($media->deleted_at)
                            <span class="badge bg-danger">Deletada</span>
                        @else
                            <span class="badge bg-success">Ativa</span>
                        @endif
                    </td>
                    <td>
                        @if($media->deleted_at)
                            <a href="{{ route('admin_restore_media', Operations::encryptId($media->id)) }}" class="btn btn-sm btn-success">
                                <i class="fa-solid fa-rotate-left me-1"></i>Restaurar
                            </a>
                            <a href="{{ route('admin_force_delete_media', Operations::encryptId($media->id)) }}" class="btn btn-sm btn-danger bg-dark">
                                <i class="fa-solid fa-trash me-1"></i>Deletar Permanentemente
                            </a>
                        @else
                            <a href="{{ route('admin_delete_media', Operations::encryptId($media->id)) }}" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash me-1"></i>Deletar
                            </a>
                        @endif
                        <a href="{{ route('admin_edit_media', Operations::encryptId($media->id)) }}" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-pen"></i> Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection