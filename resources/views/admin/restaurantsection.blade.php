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
            <li class="breadcrumb-item active">Restaurant Section</li>
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
                        <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                            {{ __('Add Restaurant Section') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('createrestaurantsection') }}">
                                @csrf
        
                                <div class="row mb-3 d-block">
                                    <div class="col-md-12">
                                        <input id="search" type="search" class="form-control rounded-pill @error('search') is-invalid @enderror"  name="search" value="{{ old('search') }}" required autocomplete="search" autofocus placeholder="Search Restaurant">
        
                                        @error('search')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-block">
                                    <div class="col-md-12">
                                        <input type="checkbox" name="" id=""><label for="">restaurant_1</label>
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
    @endif

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card " style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Restaurant Sections') }}</div>
                        <div class="card-body" style="margin: -1.3%">                            
                            @if (count($users)>=1)
                            <table  class="table table-hover">
                               {{--  <h6 class="text-danger"><i><b>You can only perform Actions on post you have created</b></i></h6> --}}
                                <thead class="bg-warning  fw-bolder">
                                  <tr>
                                    <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Restaurants</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <form action="">
                                                <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" >
                                                </div>
                                            </form>
                                        </td>
                                        <td>{{$user->restaurants}}</td>
                                         <td>
                                            <i class="ri ri-more-2-fill fw-bolder"></i>
                                        </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div>
                                    <div class="alert alert-danger text-white fw-bolder bg-danger">No Restaurant Section Found!</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
