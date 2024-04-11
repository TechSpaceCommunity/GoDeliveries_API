@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 py-4" style="margin-top: 8rem;">
            <div class="text-center">
                <h2 class="fw-bolder">Welcome to GoDeliveries</h2>
                <p>This is your one-stop solution for delivery services.</p>
            </div>
            <div class="text-center mt-3">
                <img src="assets/img/RiderLogin.gif" alt="Rider Login" width="400">
            </div>
        </div>
        <div class="col-md-6 py-4" style="margin-top: 8rem;">
            <div class="card border-0 bg-white rounded" style="margin: 8% 1%; border-radius:10px">
                <div class="card-header w-50 fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px; background-color: #ff8542;">{{ __('Login to GoDeliveries') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 d-block">
                            <label for="email" class="col-md-4 col-form-label fw-bolder">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" style="border:none; border-bottom:1px solid black" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" style="border:none; border-bottom:1px solid black" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-block">
                            <div class="col-md-12 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label fw-bolder" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0" align="start">
                            <div class="col-md-8 offset-md-4 d-block">
                                <button type="submit" class="btn fw-bolder text-center w-50" style="box-shadow: 2px 2px 4px black; background-color: #ff8542">
                                    {{ __('Login') }}
                                </button><br>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link fw-bold" href="{{ route('password.request') }}">
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