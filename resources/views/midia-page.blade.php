@extends('layouts.main-layout')

@section('content')

    @include('partials.top-bar')
    
    <div class="card mx-2">
        <div class="card-img-top d-flex flex-row justify-content-center">
            @if ($media->type === "video")
                <video controls src="{{ asset('storage/'.$media->file) }}"></video>
            @elseif ($media->type === "audio")

                <div class="row w-50 bg-dark">
                    <img src="{{ asset('storage/'.$media->image) }}">
                    <audio controls src="{{ asset('storage/'.$media->file) }}"></audio>
                </div>
            @endif
        </div>
    </div>

    {{-- <div>

        <div class="midia_frame">

            <video width="500" height="500" autoplay>
                <source  src="{{ asset('uploaded/midia/videos/cat_walking.mp4') }}" type="video/mp4">
            </video>

        </div>

        <hr>

        <div class="title">
            <h2>Titulo da Midia</h2>
        </div>

        <div class="options">
            <button>
                <img src="{{ asset('assets/images/camera.webp') }}" alt="" width="50px">
                <h6>Author</h6>
            </button>
            <button><i class="fa-regular fa-thumbs-up"></i></button>
            <button><i class="fa-regular fa-thumbs-down"></i></button>
        </div>

        <p class="description">
            0 Visualizações &nbsp; 1 de jan. de 2026
            </br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu cursus arcu, interdum molestie sem. Suspendisse metus purus, scelerisque eget pulvinar ut, venenatis vel eros. Donec faucibus placerat malesuada. Praesent nibh libero, sagittis at enim quis, maximus semper quam. Quisque at bibendum nulla. Sed nec ultricies nibh. Nam ultrices auctor tempor. Donec tincidunt eget erat in luctus. Ut ac laoreet lectus. Nullam tincidunt tellus mauris, ut malesuada nunc tempus non.
            </br>
            Vivamus sem lectus, fermentum a ex non, laoreet varius arcu. Sed ac nulla posuere, vehicula dui ac, lobortis ipsum. Curabitur eget libero ut nibh porttitor gravida quis a leo. Sed sit amet dictum orci. Pellentesque eu tortor non ipsum malesuada efficitur a pulvinar quam. Nam congue, diam id dignissim tincidunt, felis diam malesuada leo, ut rhoncus ante nibh id dolor. Mauris ultricies malesuada ipsum vitae consequat. Donec eget posuere justo.
        </p>

    </div> --}}

@endsection