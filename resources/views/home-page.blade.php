@extends('layouts.main-layout')

@include('partials.top-bar')

@section('content')

    @if (count($medias) != 0)

        <div class="row row-cols-4 mx-5 justify-content-center">
            @foreach ($medias as $media)
                @include('partials.midia-item')
            @endforeach
        </div>

    @else

        <h1>Não temos mídias no momento</h1>

    @endif

@endsection