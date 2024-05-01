@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Food Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Major Food Category</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                          {{ __('Edit Food Category') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('updatemajorcategory', $category->id) }}" enctype="multipart/form-data">
                              @csrf
                              
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="title" class="col-md-4 col-form-label fw-bolder">{{ __('Title') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ $category->title }}" required autocomplete="title"  placeholder="" autofocus>
        
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
                                        <input type="text" id="summary"  class="form-control rounded-pill bg-light @error('summary') is-invalid @enderror"  name="summary" value="{{ $category->summary }}" required autocomplete="summary"   autofocus>
        
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
                                        <option value="{{$category->status}}">{{$category->status}}</option>
                                        <option value="">--Select Status--</option>
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
                                      <button type="submit" class="btn btn-warning fw-bolder text-center w-50 rounded-pill" style="box-shadow: 2px 2px 4px black">
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
