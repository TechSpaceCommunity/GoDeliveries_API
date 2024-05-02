@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle" style="margin-top: -4%">
        {{-- <h1>Vendors</h1> --}}
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('restaurants')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Update Restaurant Profile</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header w-50 primary_background_color fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px; background-color:#ff8542;" >
                            {{ __('Update Restaurant') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('updaterestaurantprofile', $restaurant->id) }}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{$restaurant->email}}"  required autocomplete="email" autofocus readonly>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">    
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"  name="password" autocomplete="current-password" placeholder="Restaurant's password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"  name="name" value="{{$restaurant->name}}" required autocomplete="name" autofocus placeholder="Restaurant's name">
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="address" type="text" class="form-control rounded-pill @error('address') is-invalid @enderror"  name="address" value="{{$restaurant->address}}" required autocomplete="address" autofocus placeholder="Restaurant's address">
            
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <label for="Opening_time" class="col-md-12 col-form-label fw-bolder">{{ __('Opening Time') }}</label>
                                            <input id="opening_time" type="time" class="form-control rounded-pill @error('opening_time') is-invalid @enderror"  name="opening_time" value="{{$restaurant->opening_time}}"  required autocomplete="opening_time" autofocus placeholder="opening Time">
            
                                            @error('opening_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <label for="Closing_time" class="col-md-12 col-form-label fw-bolder">{{ __('Closing Time') }}</label>
                                            <input id="closing_time" type="time" class="form-control rounded-pill @error('closing_time') is-invalid @enderror"  name="closing_time" value="{{$restaurant->closing_time}}"  required autocomplete="closing_time" autofocus placeholder="closing Time">
            
                                            @error('closing_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <input id="minimum_order" type="number" class="form-control rounded-pill @error('minimum_order') is-invalid @enderror"  name="minimum_order" value="{{ $restaurant->minimum_order}}" required autocomplete="minimum_order" autofocus placeholder="Minimum Order">
            
                                            @error('minimum_order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 d-flex">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <input id="AboutMe" type="text" class="form-control rounded-pill @error('AboutMe') is-invalid @enderror"  name="AboutMe" value="{{ $restaurant->description}}" required autocomplete="AboutMe" autofocus placeholder="About">
            
                                            @error('AboutMe')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <label for="cover_image" class="col-md-12 col-form-label fw-bolder">{{ __('Restaurant Cover Image') }}</label>
                                            <input id="cover_image" type="file" class="form-control rounded-pill @error('cover_image') is-invalid @enderror"  name="cover_image" value="{{ old('cover_image') }}"  autocomplete="cover_image" autofocus >
            
                                            @error('cover_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0" align="start">
                                    <div class="col-md-8 offset-md-4 d-flex">
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
</main>
@endsection
