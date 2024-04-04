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
                        <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
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
                                            <input id="address" type="text" class="form-control rounded-pill @error('address') is-invalid @enderror"  name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Restaurant's address">
            
                                            @error('address')
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
                <div class="col-md-12 ">
                    <div class="card " style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Restaurants') }}</div>
                        <div class="card-body overflow-auto" style="margin: -1.3%">                            
                            @if (count($users)>=1)
                            <table  class="table table-hover">
                                <thead class="bg-warning  fw-bolder">
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
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>{{-- <a href="#"><img src="./storage/restaurant_cover_images/{{$user->cover_image}}" alt="" width="15%"></a> --}}
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <th scope="row"  style="width: 5%"><img src="./storage/restaurant_cover_images/{{$user->cover_image}}" alt="" class="img-fluid rounded-pill" ></th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->delivery_time}}</td>
                                        <td>{{$user->minimum_order}}</td>
                                        <td>{{$user->sales_tax}}</td>
                                         <td>
                                            <i class="ri ri-more-2-fill fw-bolder"></i>
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
    </section>
</main>
@endsection
