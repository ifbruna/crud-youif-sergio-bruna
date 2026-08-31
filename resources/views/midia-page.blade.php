@extends('layouts.main-layout')

@use('Illuminate\Support\Carbon')
@use('App\Services\Operations')
@use('App\Models\User')

@php
    $user = User::find(session()->get('user.id'));

    $pivot = $media->users()->where('user_id', $user->id)->first();
@endphp

@section('content')
    
    <div class="card mx-2">
        <div class="card-img-top d-flex flex-row justify-content-center bg-dark">
            <div class="row w-50">
                @if ($media->type === "video")
                    <video controls src="{{ asset('storage/'.$media->file) }}"></video>
                @elseif ($media->type === "audio")

                    <img src="{{ asset('storage/'.$media->image) }}">
                    <audio controls src="{{ asset('storage/'.$media->file) }}"></audio>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header align-items-center">
                <h5 class="card-title">Titulo da Midia</h2>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('assets/images/unknownuser.jpg') }}" class="rounded" style="width: 40px; height: 40px;" alt="">
                    <p class="mb-0 fs-5">{{ $media->user->name }}</p>

                    <div class="d-flex align-items-center gap-2">
                        <p class="mb-0 fs-5">Likes: {{ $media->users()->where('is_liked', true)->count() }}</p>
                        <a href="{{ route('like_media', ["pivot"=>$pivot, "id"=>Operations::encryptId($media->id)]) }}">
                            <i class="fa-{{ ($pivot->pivot->is_liked == true) ? "solid" : "regular" }} fa-thumbs-up fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-text p-2 px-3">
                <p>
                    {{ $media->users()->count() }} {{ ($media->users()->count() == 1) ? "Visualização" : "Visualizações" }} &nbsp;{{ Carbon::parse($media->posted_at)->format('j \d\e M. \d\e Y') }}
                    </br>
                    {{ $media->description }}
                </p>
            </div>
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