@extends('layouts.main-layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">
        <i class="fa-solid fa-clock-rotate-left me-2"></i>Histórico
    </h2>

    @forelse($medias as $media)
        <div class="card mb-3">
            <div class="row g-0 align-items-center">
                <div class="col-md-2">
                    <img src="{{ asset($media->image) }}"
                         class="img-fluid rounded-start"
                         style="height: 100px; object-fit: cover; width: 100%"
                         alt="{{ $media->title }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $media->title }}</h5>
                        <p class="card-text text-secondary mb-1">
                            <small>
                                <i class="fa-solid fa-calendar me-1"></i>
                                Assistido em: {{ \Carbon\Carbon::parse($media->pivot->last_time_played)->format('d/m/Y H:i') }}
                            </small>
                        </p>
                        <p class="card-text text-secondary">
                            <small>
                                <i class="fa-solid fa-heart me-1 {{ $media->pivot->is_liked ? 'text-danger' : '' }}"></i>
                                {{ $media->pivot->is_liked ? 'Curtido' : 'Não curtido' }}
                            </small>
                        </p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <a href="{{ route('view_media', $media->id) }}"
                       class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-play me-1"></i>Assistir
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-secondary mt-5">
            <i class="fa-solid fa-film fa-3x mb-3"></i>
            <p>Nenhuma mídia assistida ainda.</p>
            <a href="{{ route('home_page') }}" class="btn btn-outline-primary">
                Explorar mídias
            </a>
        </div>
    @endforelse
</div>
@endsection