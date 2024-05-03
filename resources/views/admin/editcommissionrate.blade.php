@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Commission Rates</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Restaurant Commission Rates</li>
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
                          {{ __('Update Commission Rate') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updatecommissionrate', $commissionrate->id) }}" enctype="multipart/form-data">
                              @csrf
                              
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="restaurant_id" class="col-md-4 col-form-label fw-bolder">{{ __('Restaurant') }}</label>
      
                                    <div class="col-md-12">
                                          @foreach ($restaurants as $restaurant)
                                            @if ($restaurant->id==$commissionrate->restaurant_id)
                                            <input name="restaurant_id" type="text" class="form-control  rounded-pill @error('restaurant_id') is-invalid @enderror" value="{{$restaurant->name}}" autofocus @readonly(true)>
                                            @endif
                                          @endforeach
                                               
                                        @error('restaurant_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="rate" class="col-md-4 col-form-label fw-bolder">{{ __('Rate') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="rate" type="number" step="0.01" class="form-control rounded-pill bg-light @error('rate') is-invalid @enderror"  name="rate" value="{{ $commissionrate->rate }}" required autocomplete="rate"  placeholder="" autofocus>
        
                                        @error('rate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">
                                  <div class="col-12">
                                    <label for="status" class="col-md-12 col-form-label fw-bolder">{{ __('Status') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="status" class="form-control  rounded-pill @error('status') is-invalid @enderror" autofocus>
                                        <option value="{{$commissionrate->status}}">{{$commissionrate->status}}</option>
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
