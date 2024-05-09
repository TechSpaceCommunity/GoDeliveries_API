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
                          {{ __('Add Commission Rate') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('createcommissionrate') }}" enctype="multipart/form-data">
                              @csrf
                              
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="restaurant_id" class="col-md-4 col-form-label fw-bolder">{{ __('Restaurant') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="restaurant_id" class="form-control  rounded-pill @error('restaurant_id') is-invalid @enderror" autofocus>
                                        <option value="">--Select the restaurant--</option>
                                        @foreach ($restaurants as $restaurant)
                                          <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                        @endforeach
                                    </select>
        
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
                                        <input id="rate" type="number" step="0.01" class="form-control rounded-pill bg-light @error('rate') is-invalid @enderror"  name="rate" value="{{ old('rate') }}" required autocomplete="rate"  placeholder="" autofocus>
        
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
          <div class="card" >
            <div class="card-header py-3 text-dark fw-bolder" style="background-color:#ff8542;">
              <h6 class="m-0 fw-bolder text-dark float-left">Commissionrates List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(count($commissionrates)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white ">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></i></th>
                      <th>Restaurant</th>
                      <th>Commission Rate</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></i></th>
                      <th>Restaurant</th>
                      <th>Commission Rate</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($commissionrates as $commissionrate)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                            <td>
                              @foreach ($restaurants as $restaurant)
                                  @if ($restaurant->id == $commissionrate->restaurant_id)
                                      {{$restaurant->name}}
                                  @endif
                              @endforeach
                            </td>
                            <td>{{$commissionrate->rate}}</td>
                            <td>
                                @if($commissionrate->status=="active")
                                    <span class="fw-bold text-success">Active</span>
                                @else
                                    <span class="fw-bold text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 details rounded border shadow-lg ">
                                        <a class="btn btn-success fw-bolder " href="./editcommissionrate/{{$commissionrate->id}}">
                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                          </a>
                                      </span>
                                      <span class="mx-1 rounded border shadow-lg  ">
                                        <form action="{{route('destroycommissionrate', $commissionrate->id) }}" method="post">
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
                {{-- <span style="float:right">{{$commissionrates->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No commissionrates found!!! Please create commissionrate</h6>
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