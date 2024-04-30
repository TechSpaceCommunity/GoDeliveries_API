@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Food</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Category Food</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50 fw-bolder" style="background-color:#ff8542;border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                          {{ __('Edit Food') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updatefood', $food->id) }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="title" class="col-md-6 col-form-label fw-bolder">{{ __('Title') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ $food->title }}" required autocomplete="title"  placeholder="" autofocus>
        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="summary" class="col-md-6 col-form-label fw-bolder">{{ __('Description') }}</label>
      
                                    <div class="col-md-12">
                                        <input type="text" id="summary"  class="form-control rounded-pill bg-light @error('summary') is-invalid @enderror"  name="summary" value="{{$food->summary}}" required autocomplete="summary"  placeholder="" autofocus>
        
                                        @error('summary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="child_cat_id" class="col-md-12 col-form-label fw-bolder">Child Food Category <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <select name="child_cat_id" id="child_cat_id" class="form-control rounded-pill">
                                    <option value="{{$food->child_cat_id}}">{{$food->child_cat_id}}</option>
                                      @foreach($categories as $cat_data)
                                          <option value='{{$cat_data->id}}'>{{$cat_data->title}}
                                          
                                          </option>
                                      @endforeach
                                  </select>

                                    @error('child_cat_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="price" class="col-md-6 col-form-label fw-bolder">Price($) <span class="text-danger">*</span></label>
      
                                    <div class="col-md-12">
                                      <input id="price" type="number" class="form-control rounded-pill bg-light @error('price') is-invalid @enderror"  name="price" value="{{ $food->price }}" required autocomplete="price"  placeholder="" autofocus>
        
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>

                              <div class="row mb-3 d-flex">
                                <div class="col-6">
                                  <label for="discount" class="col-md-6 col-form-label fw-bolder">Discount(%) </label>
    
                                  <div class="col-md-12">
                                    <input id="discount" type="number" class="form-control rounded-pill bg-light @error('discount') is-invalid @enderror"  name="discount" value="{{ $food->discount }}" required autocomplete="discount"  placeholder="" autofocus>
      
                                      @error('discount')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="col-6">
                                  <label for="stock" class="col-md-6 col-form-label fw-bolder">Quantity <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <input id="stock" type="number" class="form-control rounded-pill bg-light @error('stock') is-invalid @enderror"  name="stock" value="{{ $food->stock }}" required autocomplete="stock"  placeholder="" autofocus>
      
                                      @error('stock')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="Photo" class="col-md-6 col-form-label fw-bolder">{{ __('Photo') }}</label>
    
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
                                    <label for="status" class="col-md-6 col-form-label fw-bolder">{{ __('Status') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="status" class="form-control  rounded-pill @error('status') is-invalid @enderror" autofocus>
                                      <option value="{{$food->status}}">{{$food->status}}</option>
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
