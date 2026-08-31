@extends('layouts.main-layout')

@section('content')

    @if (count($medias) != 0)

        <div class="row row-cols-4 mx-5 justify-content-center">
            @foreach ($medias as $media)
                <x-media-card :media="$media"/>
            @endforeach
        </div>

    @else

        <div class="text-center text-secondary mt-5">
            <i class="fa-solid fa-film fa-3x mb-3"></i>
            <p>Ainda não temos mídias disponíveis.</p>
        </div>

    @endif

@endsection