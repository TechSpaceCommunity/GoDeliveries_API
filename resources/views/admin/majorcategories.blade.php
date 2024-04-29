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
                          {{ __('Add Food Category') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('createmajorcategory') }}" enctype="multipart/form-data">
                              @csrf
                              
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
                                      <button type="submit" class="btn btn-warning fw-bolder text-center w-25 rounded-pill" style="box-shadow: 2px 2px 4px black">
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
          <div class="card">
            <div class="card-header py-3 text-dark fw-bolder" style="background-color:#ff8542;">
              <h6 class="m-0 fw-bolder text-dark float-left">Category Lists</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(count($categories)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white ">
                    <tr>
                      <th>S.N.</th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th>S.N.</th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($categories as $category)
                      @php
                      @endphp
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>
                              @if($category->photo)
                                  <img src="./storage/majorcategory_photo/{{$category->photo}}" class="img-fluid" style="max-width:80px" alt="{{$category->photo}}">
                              @else
                                  <img src="{{asset('./storage/majorcategory_photo/noImage.png')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                              @endif
                          </td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->summary}}</td>
                            <td>
                                @if($category->status=='active')
                                    <span class="fw-bold text-success">{{$category->status}}</span>
                                @else
                                    <span class="fw-bold text-danger">{{$category->status}}</span>
                                @endif
                            </td>
                            <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 details rounded border shadow-lg ">
                                        <a class="btn btn-success fw-bolder " href="./editmajorcategory/{{$category->id}}">
                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                          </a>
                                      </span>
                                      <span class="mx-1 rounded border shadow-lg  ">
                                        <form action="{{route('destroymajorcategory', $category->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger fw-bolder"><i class="b bi-trash"></i></button>
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
                {{-- <span style="float:right">{{$categories->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No Categories found!!! Please create Category</h6>
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
