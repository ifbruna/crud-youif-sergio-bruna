@extends('layouts.main_layout')

@section('content')

<div class="row mb-3 align-items-center px-5">

   
    <div class="col">
        <div class="container-sm">
            <a href="#">
                <img src="{{ asset('assets/img/youif_logo.png') }}"
                     class="img-fluid"
                     width="100px"
                     height="100px">
            </a>
        </div>
    </div>

    
    <div class="col text-center">
        <span class="text-danger">A simple </span>
        <span class="text-success">Laravel</span>
        <span class="text-danger">project!</span>
    </div>

    
    <div class="col d-flex justify-content-end">

        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                Menu
            </button>

            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="#">
                        Logout
                        <i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        Histórico
                        <i class="fa-solid fa-clock-rotate-left ms-2"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>

<hr>

@endsection