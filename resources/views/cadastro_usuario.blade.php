@extends('layouts.main_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">

                    <div class="text-center p-3">
                        <img src="{{ asset('assets/images/youif_logo.png') }}"
                             alt="youif logo"
                             width="200px"
                             height="200px">
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">

                            <form action="#" method="POST" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="text_username" class="form-label">
                                        Usuário
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa-solid fa-user"></i>
                                        </span>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="text_username"
                                            value="{{ old('text_username') }}">
                                    </div>

                                    @error('text_username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_name" class="form-label">
                                        Nome e sobrenome
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa-solid fa-id-card"></i>
                                        </span>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="text_name"
                                            value="{{ old('text_name') }}">
                                    </div>

                                    @error('text_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_email" class="form-label">
                                        E-mail
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="text_email"
                                            value="{{ old('text_email') }}">
                                    </div>

                                    @error('text_email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_password" class="form-label">
                                        Senha
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa-solid fa-key"></i>
                                        </span>

                                        <input
                                            type="password"
                                            class="form-control"
                                            name="text_password"
                                            value="{{ old('text_password') }}">
                                    </div>

                                    @error('text_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="text_passwordconfirm" class="form-label">
                                        Confirme a senha
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa-solid fa-key"></i>
                                        </span>

                                        <input
                                            type="password"
                                            class="form-control"
                                            name="text_passwordconfirm"
                                            value="{{ old('text_passwordconfirm') }}">
                                    </div>

                                    @error('text_passwordconfirm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">
                                        <i class="fa-solid fa-user-plus"></i>
                                        &nbsp;&nbsp;Cadastro
                                    </button>
                                </div>
                            </form>

                            @if(session('login_error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('login_error') }}
                                </div>
                            @endif

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