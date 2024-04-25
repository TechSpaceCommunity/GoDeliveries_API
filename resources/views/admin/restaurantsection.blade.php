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
                        <form method="POST" action="{{ route('createrestaurantsection') }}">
                            @csrf
                            <div class="d-flex">
                                <div class="card-header w-50  fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                                    {{ __('Add Restaurant Section') }}
                                </div>
                                <div class="card-header w-50  fw-bolder d-flex" style="border: none">
                                    <label for="enable">Enable</label>
                                    <div class="form-check form-switch mx-2"> 
                                        <input type="hidden" name="status" value="0">                                      
                                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1" checked>
                                    </div>
                                </div>
                            </div>                     
            
                            <div class="card-body">
                                <div class="row mb-3 d-block">
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Restaurant Section Name">
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3 d-block">
                                        <div class="col-md-12">
                                            <table class="table table-hover">
                                                @if (count($restaurants))
                                                <thead>
                                                    <th>[]</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>address</th>
                                                </thead>
                                                @foreach ($restaurants as $restaurant)
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="restaurants[{{$restaurant->id}}][selected]" id="restaurants{{$restaurant->id}}" >
                                                        </td>
                                                        <td>{{$restaurant->id}}</td>
                                                        <input type="hidden" name="restaurants[{{$restaurant->id}}][id]" value="{{$restaurant->id}}">
                                                        <td>{{$restaurant->name}}</td>
                                                        <input type="hidden" name="restaurants[{{$restaurant->id}}][name]" value="{{$restaurant->name}}">
                                                        <td>{{$restaurant->address}}</td>
                                                        <input type="hidden" name="restaurants[{{$restaurant->id}}][address]" value="{{$restaurant->address}}">
                                                    </tr>
                                                    
                                                </tbody>                                                
                                                @endforeach
                                            @else
                                                <h6 class="fw-bolder text-danger">No Restaurant Available!</h6>
                                            @endif
                                            </table>
                                        </div>
                                    </div>
            
                                    <div class="row mb-0" align="start">
                                        <div class="col-md-8 offset-md-4 d-block">
                                            <button type="submit" class="primary_background_color fw-bolder text-center w-25 rounded-pill" style="box-shadow: 2px 2px 4px black">
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

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card " style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Restaurant Sections') }}</div>
                        <div class="card-body" style="margin: -1.3%">                            
                            @if (count($restaurantsections)>=1)
                            <table  class="table table-hover">
                               {{--  <h6 class="text-danger"><i><b>You can only perform Actions on post you have created</b></i></h6> --}}
                                <thead class="primary_background_color   fw-bolder">
                                  <tr>
                                    <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Restaurants</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurantsections as $restaurantsection)
                                    <tr>
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <td>{{$restaurantsection->name}}</td>
                                        <td>
                                            <form action="">
                                                @if ($restaurantsection->status == 1)
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status" checked disabled>
                                                    </div>
                                                @else
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status" disabled>
                                                    </div>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="w-50">{{$restaurantsection->restaurants}}</td>
                                         <td>
                                            <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                                    <li class="w-100 d-flex">
                                                      <span class="mx-1 details rounded border shadow-lg ">
                                                        <a class="btn btn-success fw-bolder " href="./editadminrestaurantsection/{{$restaurantsection->id}}">
                                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                                          </a>
                                                      </span>
                                                      <span class="mx-1 rounded border shadow-lg  ">
                                                        <form action="{{route('destroyrestaurantsection', $restaurantsection->id) }}" method="post">
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
