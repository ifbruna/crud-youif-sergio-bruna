@extends('layouts.main-layout')

@use('Illuminate\Support\Carbon')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fa-solid fa-clipboard-list me-2"></i>Logs dos alunos
            </h2>
            <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>Voltar ao Admin
            </a>
        </div>

        <hr>

        <p class="text-secondary">
            Registro das ações realizadas pelos alunos na plataforma.
        </p>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-secondary align-middle">
                <thead>
                    <tr class="table-dark">
                        <th>Data e hora</th>
                        <th>Aluno</th>
                        <th>Ação</th>
                        <th>Mídia</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse($activities as $activity)
                        @php
                            $event = $activity->event;
                            $badgeClass = match ($event) {
                                'login', 'registered' => 'bg-success',
                                'logout' => 'bg-secondary',
                                'viewed' => 'bg-info text-dark',
                                'liked' => 'bg-danger',
                                'unliked' => 'bg-warning text-dark',
                                default => 'bg-primary',
                            };

                            $mediaTitle = $activity->subject?->title
                                ?? $activity->getProperty('media_title', '—');
                        @endphp
                        <tr>
                            <td class="text-nowrap">
                                {{ Carbon::parse($activity->created_at)->format('d/m/Y - H:i:s') }}
                            </td>
                            <td>
                                {{ $activity->causer?->name ?? 'Aluno não disponível' }}
                            </td>
                            <td>
                                <span class="badge {{ $badgeClass }}">
                                    {{ $activity->description }}
                                </span>
                            </td>
                            <td>{{ $mediaTitle }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">
                                <i class="fa-solid fa-clipboard-list fa-2x mb-3"></i>
                                <p class="mb-0">Nenhuma atividade registrada ainda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
@endsection
