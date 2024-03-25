@extends('layouts.app')

@section('content')
    <div class="container shadow-lg bg-white mt-lg-5 min-h-screen">
        <div class="row d-flex justify-content-between">
            <div class="col-md-4">
                <img src="assets/img/LoginPage.gif" alt="" width="100%" height="100%">
            </div>
            <div class="col-md-6 pt-5">
                <div class="card h-100 bg-white d-flex border-0 flex-column justify-center">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder fs-3">{{ __('Login to GoDeliveries') }}</h5>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3 d-block">
                                <label for="email"
                                    class="col-md-4 col-form-label fw-bolder">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control p-3 @error('email') is-invalid @enderror" style=""
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <i class="bi bi-envelope"></i>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 d-block">
                                <label for="password" class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control p-3 @error('password') is-invalid @enderror" style=""
                                        name="password" required autocomplete="current-password">
                                    <i class="bi bi-lock"></i>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0 mt-5" align="start">
                                <div class="col-md-12 d-block">
                                    <button type="submit" class="btn fw-bolder p-3 text-center w-100"
                                        style="background-color:#eb8334">
                                        {{ __('Login') }}
                                    </button><br>
                                </div>
                            </div>
                            <div class="row mb-3 d-block mt-4 d-flex justify-content-between align-content-center">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label fw-bolder" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6" align="end">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link fw-bold text-decoration-none"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
