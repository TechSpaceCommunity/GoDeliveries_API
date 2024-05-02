@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle" style="margin-top: -4%">
        {{-- <h1>Vendors</h1> --}}
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Edit Restaurant</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->

      @if(Auth::user()->role=='admin')
    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('editrestaurant', $restaurant->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex">
                                <div class="card-header w-50  fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                                    {{ __('Edit Restaurant') }}
                                </div>
                                <div class="card-header w-50  fw-bolder d-flex" style="border: none">
                                    <label for="enable">Enable</label>
                                    <div class="form-check form-switch mx-2"> 
                                        <input type="hidden" name="status" value="0">
                                        @if ($restaurant->status == 1)
                                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1">
                                        @endif                                      
                                        
                                    </div>
                                </div>
                            </div>
        
                        <div class="card-body">
                            
        
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
                                            <div class="input-group">
                                                <input id="address" type="text" class="form-control rounded-pill @error('address') is-invalid @enderror" name="address" value="{{ $restaurant->address }}" required autocomplete="address" autofocus placeholder="Restaurant's address">
                                            </div>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <script>
                                        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
                                    </script>
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
                                            <input id="description" type="text" class="form-control rounded-pill @error('description') is-invalid @enderror"  name="description" value="{{ $restaurant->description}}" required autocomplete="description" autofocus placeholder="Restaurant About">
            
                                            @error('description')
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
    @endif
</main>
@endsection
