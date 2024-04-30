@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Coupons</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Coupons</li>
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
                          {{ __('Edit Coupon') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updatecoupon', $coupon->id) }}" enctype="multipart/form-data">
                              @csrf
                              
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="code" class="col-md-4 col-form-label fw-bolder">{{ __('code') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="code" type="text" class="form-control rounded-pill bg-light @error('code') is-invalid @enderror"  name="code" value="{{ $coupon->code }}" required autocomplete="code"  placeholder="" autofocus readonly>
        
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="type" class="col-md-4 col-form-label fw-bolder">{{ __('Type') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="type" class="form-control  rounded-pill @error('type') is-invalid @enderror" autofocus>
                                        <option value="{{$coupon->type}}">{{$coupon->type}}</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
        
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="value" class="col-md-4 col-form-label fw-bolder">{{ __('value') }}</label>
    
                                  <div class="col-md-12">
                                      <input id="value" type="number" step="0.01" class="form-control rounded-pill bg-light @error('value') is-invalid @enderror"  name="value" value="{{$coupon->value}}" required autocomplete="value"  placeholder="" autofocus>
      
                                      @error('value')
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
                                        <option value="{{$coupon->status}}">
                                          @if($coupon->status==1)
                                              <span class="fw-bold text-success">Active</span>
                                          @else
                                              <span class="fw-bold text-danger">Inactive</span>
                                          @endif
                                        </option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
