<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page { size: A4 portrait; margin: 1.5cm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 22px; margin: 0; color: #1e3a8a; }
        .cabecalho { border-bottom: 3px solid #1e3a8a; padding-bottom: 10px; margin-bottom: 20px; }
        table.itens { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table.itens th { background: #1e3a8a; color: #fff; padding: 8px; text-align: left; }
        table.itens td { border-bottom: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <div class="container mt-5">

        <hr>
<div class="cabeçalho">
        <p class="text-secondary">
            Registro das ações realizadas pelos alunos na plataforma.
        </p>
</div>
        <div class="table-responsive">
            <table class="itens">
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
                            <td>
                                {{ $activity->created_at->format('d/m/Y - H:i:s') }}
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
</body>
</html>