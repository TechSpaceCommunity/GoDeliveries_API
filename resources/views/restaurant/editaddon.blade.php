@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Food Addons</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Addon</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50  fw-bolder" style="background-color:#ff8542;border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                          {{ __('Update Food Addon') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updateaddon', $addon->id) }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="title" class="col-md-4 col-form-label fw-bolder">{{ __('Title') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ $addon->title }}" required autocomplete="title"  placeholder="Title" autofocus>
        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="summary" class="col-md-4 col-form-label fw-bolder">{{ __('Description') }}</label>
      
                                    <div class="col-md-12">
                                        <input type="text" id="summary"  class="form-control rounded-pill bg-light @error('summary') is-invalid @enderror"  name="summary" value="{{ $addon->summary }}" required autocomplete="summary"  placeholder="Description" autofocus>
        
                                        @error('summary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">

                                <div class="col-12">
                                  <label for="product_id" class="col-md-6 col-form-label fw-bolder">Major Food addon <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <select name="product_id" id="product_id" class="form-control rounded-pill">
                                      <option value="{{$addon->product_id}}">
                                        @foreach($foods as $food)
                                        @if ($food->id==$addon->product_id)
                                        {{$food->title}}
                                        @endif
                                        @endforeach
                                      @foreach($foods as $food)
                                          <option value='{{$food->id}}'>{{$food->title}}</option>
                                      @endforeach
                                  </select>

                                    @error('product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                              </div>

                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="Photo" class="col-md-4 col-form-label fw-bolder">{{ __('Photo') }}</label>
    
                                  <div class="col-md-12">
                                    <input id="photo" type="file" class="form-control rounded-pill @error('photo') is-invalid @enderror"  name="photo" value="{{ old('photo') }}" autocomplete="photo" autofocus >
            
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>

                                  <div class="col-6">
                                    <label for="status" class="col-md-4 col-form-label fw-bolder">{{ __('Status') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="status" class="form-control  rounded-pill @error('status') is-invalid @enderror" autofocus>
                                        <option value="{{$addon->status}}">{{$addon->status}}</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
        
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

@endsection
