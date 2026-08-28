@extends('layouts.main-layout')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <div class="text-center p-3">
                        <img src="{{ asset('assets/images/youif_logo.png') }}"
                             alt="youif logo"
                             width="150px"
                             height="150px">
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">

                            @yield('form-content')

                        </div>
                    </div>

                    <div class="text-center text-secondary mt-3">
                        <small>&copy;Copyright {{ date('Y') }}</small>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection