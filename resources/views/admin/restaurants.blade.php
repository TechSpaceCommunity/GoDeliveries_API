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
            <li class="breadcrumb-item active">Restaurants</li>
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
                        <div class="card-header w-50 primary_background_color fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px; background-color:#ff8542;" >
                            {{ __('Add Restaurant') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('createrestaurant') }}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Restaurant's email">
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">    
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="Restaurant's password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Restaurant's name">
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input id="address" type="text" class="form-control rounded-pill @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Restaurant's address">
                                            </div>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <script>
                                        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
                                    </script>
                                </div>

                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="delivery_time" type="text" class="form-control rounded-pill @error('delivery_time') is-invalid @enderror"  name="delivery_time" value="{{ old('delivery_time') }}" required autocomplete="delivery_time" autofocus placeholder="Delivery Time">
            
                                            @error('delivery_time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <input id="minimum_order" type="number" class="form-control rounded-pill @error('minimum_order') is-invalid @enderror"  name="minimum_order" value="{{ old('minimum_order') }}" required autocomplete="minimum_order" autofocus placeholder="Minimum Order">
            
                                            @error('minimum_order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <input id="sales_tax" type="number" class="form-control rounded-pill @error('sales_tax') is-invalid @enderror"  name="sales_tax" value="{{ old('sales_tax') }}" required autocomplete="sales_tax" autofocus placeholder="Sales Tax">
            
                                            @error('sales_tax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            
                                            <input id="cover_image" type="file" class="form-control rounded-pill @error('cover_image') is-invalid @enderror"  name="cover_image" value="{{ old('cover_image') }}" required autocomplete="cover_image" autofocus >
            
                                            @error('cover_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0" align="start">
                                    <div class="col-md-8 offset-md-4 d-flex">
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
    @endif

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card" >
                        <div class="card-header py-3 text-dark fw-bolder" style="background-color:#ff8542;">
                          <h6 class="m-0 fw-bolder text-dark float-left">Restaurants</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">                          
                            @if (count($users)>=1)
                            <table  class="table table-hover w-100">
                                <thead class="bg-dark text-white ">
                                  <tr>
                                    <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Delivery Time</th>
                                    <th scope="col">Minimum Order</th>
                                    <th scope="col">Sales Tax</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tfoot class="bg-dark text-white ">
                                    <tr>
                                      <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Address</th>
                                      <th scope="col">Delivery Time</th>
                                      <th scope="col">Minimum Order</th>
                                      <th scope="col">Sales Tax</th>
                                      <th scope="col">Action</th>
                                  </tr>
                                  </tfoot>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>{{-- <a href="#"><img src="./storage/restaurant_cover_images/{{$user->cover_image}}" alt="" width="15%"></a> --}}
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <td scope="row"  ><img src="./storage/restaurant_cover_images/{{$user->cover_image}}" alt="" class="img-fluid rounded" style="max-width:80px"></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->delivery_time}}</td>
                                        <td>{{$user->minimum_order}}</td>
                                        <td>{{$user->sales_tax}}</td>
                                         <td>
                                            <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                                    <li class="w-100 d-flex">
                                                      <span class="mx-1 details rounded border shadow-lg ">
                                                        <a class="btn btn-success fw-bolder " href="./editadminrestaurants/{{$user->id}}">
                                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                                          </a>
                                                      </span>
                                                      <span class="mx-1 rounded border shadow-lg  ">
                                                        <form action="{{route('destroyrestaurant', $user->id) }}" method="post">
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
                                    <div class="alert alert-danger text-white fw-bolder bg-danger">No Restaurant Found!</div>
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
