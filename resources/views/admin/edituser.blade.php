@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    @if(Auth::user()->role=='admin')
    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50 fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                          {{ __('Edit User') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updateuser', $user->id) }}">
                              @csrf
      
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="name" class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control rounded-pill bg-light @error('name') is-invalid @enderror"  name="name" value="{{$user->name }}" required autocomplete="name"  placeholder="User Name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="email" class="col-md-4 col-form-label fw-bolder">{{ __('email') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control rounded-pill bg-light @error('email') is-invalid @enderror"  name="email" value="{{ $user->email }}" autocomplete="email" placeholder="abc@example.com" readonly autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="number" class="col-md-4 col-form-label fw-bolder">{{ __('Number') }}</label>
    
                                  <div class="col-md-12">
                                      <input id="number" type="number" class="form-control rounded-pill bg-light @error('number') is-invalid @enderror"  name="number" value="{{ $user->number }}" placeholder="254712345678" required autocomplete="number" placeholder="Phone Number" autofocus>
      
                                      @error('number')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="col-6">
                                  <label for="role" class="col-md-4 col-form-label fw-bolder">{{ __('Role') }}</label>
                                  <select id="role" class="form-control rounded-pill bg-light @error('role') is-invalid @enderror" name="role" required>
                                      <option value="{{$user->role}}">{{$user->role}}</option>
                                      <option value="admin"{{ old('role') == 'admin' ? ' selected' : '' }}>Admin</option>
                                      <option value="rider_manager"{{ old('role') == 'rider_manager' ? ' selected' : '' }}>Rider Manager</option>
                                      <option value="vendor_manager"{{ old('role') == 'vendor_manager' ? ' selected' : '' }}>Vendor Manager</option>
                                      <option value="restaurant_manager"{{ old('role') == 'restaurant_manager' ? ' selected' : '' }}>Restaurant Manager</option>
                                      <option value="customer_manager"{{ old('role') == 'customer_manager' ? ' selected' : '' }}>Customer Manager</option>
                                  </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                 
                              </div>
      
                             {{--  <div class="row my-2">
                                <div class="col-md-12">
                                  <label for="password" class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label>
    
                                  <div class="col-md-12">
                                      <input id="password" type="password" class="form-control rounded-pill bg-light @error('password') is-invalid @enderror" name="password"  autocomplete="current-password"  placeholder="Password">
      
                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>
                              </div> --}}
                              <div class="row mb-0" align="start">
                                  <div class="col-md-8 offset-md-4 d-block">
                                      <button type="submit" class="primary_background_color fw-bolder text-center w-50 rounded-pill" style="box-shadow: 2px 2px 4px black">
                                          {{ __('SAVE') }}
                                      </button><br>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endif
  </main><!-- End #main -->

@endsection
