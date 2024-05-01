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
          <li class="breadcrumb-item active">Addons</li>
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
                          {{ __('Add Food Addon') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('createaddon') }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="title" class="col-md-4 col-form-label fw-bolder">{{ __('Title') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ old('title') }}" required autocomplete="title"  placeholder="" autofocus>
        
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
                                        <textarea id="summary"  class="form-control rounded-pill bg-light @error('summary') is-invalid @enderror"  name="summary" value="{{ old('summary') }}" required autocomplete="summary"  placeholder="" autofocus></textarea>
        
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
                                  <label for="product_id" class="col-md-6 col-form-label fw-bolder">Food  <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <select name="product_id" id="product_id" class="form-control rounded-pill">
                                      <option value="">--Select the food--</option>
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
                                    <input id="photo" type="file" class="form-control rounded-pill @error('photo') is-invalid @enderror"  name="photo" value="{{ old('photo') }}" required autocomplete="photo" autofocus >
            
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

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="border-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Food Addons List') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($addons)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Food</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Food</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($addons as $addon)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>
                              @if($addon->photo)
                                  <img src="./storage/addons_photo/{{$addon->photo}}" class="img-fluid" style="max-width:80px" alt="{{$addon->photo}}">
                              @else
                                  <img src="{{asset('./storage/addons_photo/noImage.png')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                              @endif
                          </td>
                            <td>{{$addon->title}}</td>
                            <td>
                              @foreach($foods as $food)
                              @if ($food->id==$addon->product_id)
                              {{$food->title}}
                              @endif
                              @endforeach</td>
                            <td>{{$addon->summary}}</td>
                            <td>
                                @if($addon->status=='active')
                                    <span class="fw-bold text-success">{{$addon->status}}</span>
                                @else
                                    <span class="fw-bold text-warning">{{$addon->status}}</span>
                                @endif
                            </td>
                            <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 details rounded border shadow-lg ">
                                        <a class="btn btn-success fw-bolder " href="./editaddon/{{$addon->id}}">
                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                          </a>
                                      </span>
                                      <span class="mx-1 rounded border shadow-lg  ">
                                        <form method="POST" action="{{route('addon.destroy',[$addon->id])}}">
                                          @csrf
                                          @method('delete')
                                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$addon->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                          </form>  
                                      </span>
                                      
                                    </li>
                                </ul>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$addons->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No addons found!!! Please create addon</h6>
                @endif
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

@endsection
