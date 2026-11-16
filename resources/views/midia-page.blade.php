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
                <h5 class="card-title">{{ $media->title }}</h2>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset($media->user->profileImage()) }}" class="rounded" style="width: 40px; height: 40px;" alt="">
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

@endsection