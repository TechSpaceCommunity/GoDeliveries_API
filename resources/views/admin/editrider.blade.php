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
            <li class="breadcrumb-item active">Edit Rider</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      @if(Auth::user()->role=='admin' || Auth::user()->role=='rider_manager')
    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('editrider', $rider->id) }}" enctype="multipart/form-data">
                            @csrf
                        <div class="d-flex">
                            <div class="card-header w-50  fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                                {{ __('Edit Rider') }}
                            </div>
                            <div class="card-header w-50  fw-bolder d-flex" style="border: none">
                                <label for="enable">Available</label>
                                <div class="form-check form-switch mx-2"> 
                                    <input type="hidden" name="status" value="0">
                                        @if ($rider->status == 1)
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
                                      {{-- <label for="name" class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="name" type="text" class="form-control rounded-pill bg-light @error('name') is-invalid @enderror"  name="name" value="{{ $rider->name}}" required autocomplete="name"   autofocus>
          
                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      {{-- <label for="username" class="col-md-4 col-form-label fw-bolder">{{ __('UserName') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="email" type="email" class="form-control rounded-pill bg-light @error('email') is-invalid @enderror"  name="email" value="{{ $rider->email}}" required autocomplete="email"  autofocus readonly>
          
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
                                      {{-- <label for="password" class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="password" type="text" class="form-control rounded-pill bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  value="{{$rider->password}}">
          
                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      {{-- <label for="number" class="col-md-4 col-form-label fw-bolder">{{ __('Number') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="number" type="number" class="form-control rounded-pill bg-light @error('number') is-invalid @enderror"  name="number" value="{{ $rider->number}}" required autocomplete="number" placeholder="254712345678"  autofocus>
          
                                          @error('number')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>
                                </div>
        
                                <div class="row my-2">
                                  <div class="col-md-12">
                                    <select name="zone" id="zone" class="form-control rounded-pill bg-light  @error('zone') is-invalid @enderror" autocomplete="zone" autofocus required>
                                        <option value="{{$rider->zone}}">{{$rider->zone}}</option>
                                        @foreach ($zones as $zone)
                                        <option value="{{$zone->title}}">{{$zone->title}}</option>
                                        @endforeach    
                                    </select>
                                      
                                      @error('zone')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <label for="id_number" class="col-md-12 col-form-label fw-bolder" style="font-size: 0.8em">{{ __('National ID_Number') }}</label>
          
                                        <div class="col-md-12">
                                            <input type="number" id="id_number"  class="form-control rounded-pill bg-light @error('id_number') is-invalid @enderror"  name="id_number" value="{{ $rider->id_number }}" required autocomplete="id_number" placeholder="ID Number" autofocus>
            
                                            @error('id_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>

                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <label for="id_image" class="col-md-12 col-form-label fw-bolder"  style="font-size: 0.8em">{{ __('National ID Image') }}</label>
                                                <input id="id_image" type="file" class="form-control rounded-pill @error('id_image') is-invalid @enderror"  name="id_image" value="{{ old('id_image') }}" required autocomplete="id_image" autofocus >
                
                                                @error('id_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <label for="rider_image" class="col-md-12 col-form-label fw-bolder" style="font-size: 0.8em">{{ __('Rider image') }}</label>
                                                <input id="rider_image" type="file" class="form-control rounded-pill @error('rider_image') is-invalid @enderror"  name="rider_image" value="{{ old('rider_image') }}" autocomplete="rider_image" autofocus >
                
                                                @error('rider_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <label for="bike_image" class="col-md-12 col-form-label fw-bolder"  style="font-size: 0.8em">{{ __('Bike Number Plate') }}</label>
                                                <input id="bike_image" type="file" class="form-control rounded-pill @error('bike_image') is-invalid @enderror"  name="bike_image" value="{{ old('bike_image') }}" autocomplete="bike_image" autofocus >
                
                                                @error('bike_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0" align="start">
                                    <div class="col-md-8 offset-md-4 d-block">
                                        <button type="submit" class="primary_background_color fw-bolder text-center w-50 rounded-pill" style="box-shadow: 2px 2px 4px black">
                                            {{ __('SAVE') }}
                                        </button><br>
                                    </div>
                                </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</main>
@endsection
