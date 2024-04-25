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
            <li class="breadcrumb-item active">Riders</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      @if(Auth::user()->role=='admin' || Auth::user()->role=='rider_manager')
    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('createrider') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="d-flex">
                            <div class="card-header w-50  fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                                {{ __('Add Rider') }}
                            </div>
                            <div class="card-header w-50  fw-bolder d-flex" style="border: none">
                                <label for="enable">Available</label>
                                <div class="form-check form-switch mx-2"> 
                                    <input type="hidden" name="status" value="0">                                      
                                    <input type="checkbox" name="status" id="status" class="form-check-input" value="1" checked>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                                   
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                      {{-- <label for="name" class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="name" type="text" class="form-control rounded-pill bg-light @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="Rider Name" autofocus>
          
                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      {{-- <label for="username" class="col-md-4 col-form-label fw-bolder">{{ __('UserName') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="email" type="email" class="form-control rounded-pill bg-light @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="email" autofocus>
          
                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>
                                </div>
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                      {{-- <label for="password" class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="password" type="password" class="form-control rounded-pill bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Password">
          
                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      {{-- <label for="number" class="col-md-4 col-form-label fw-bolder">{{ __('Number') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="number" type="number" class="form-control rounded-pill bg-light @error('number') is-invalid @enderror"  name="number" value="{{ old('number') }}" required autocomplete="number" placeholder="Phone Number" autofocus>
          
                                          @error('number')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>
                                </div>
        
                                <div class="row my-2">
                                  <div class="col-md-12">
                                    <select name="zone" id="zone" class="form-control rounded-pill bg-light  @error('zone') is-invalid @enderror" required autocomplete="zone" autofocus>
                                        <option value="">---Select Zone---</option>
                                        @foreach ($zones as $zone)
                                        <option value="{{$zone->title}}">{{$zone->title}}</option>
                                        @endforeach    
                                    </select>
                                      
                                      @error('zone')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <label for="rider_image" class="col-md-12 col-form-label fw-bolder" style="font-size: 0.8em">{{ __('Rider image') }}</label>
                                                <input id="rider_image" type="file" class="form-control rounded-pill @error('rider_image') is-invalid @enderror"  name="rider_image" value="{{ old('rider_image') }}" required autocomplete="rider_image" autofocus >
                
                                                @error('rider_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="col-md-12">
                                                <label for="bike_image" class="col-md-12 col-form-label fw-bolder"  style="font-size: 0.8em">{{ __('Bike Number Plate') }}</label>
                                                <input id="bike_image" type="file" class="form-control rounded-pill @error('bike_image') is-invalid @enderror"  name="bike_image" value="{{ old('bike_image') }}" required autocomplete="bike_image" autofocus >
                
                                                @error('bike_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
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
                <div class="col-md-12 ">
                    <div class="card " style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Riders') }}</div>
                        <div class="card-body overflow-auto" style="margin: -1.3%">                            
                            @if (count($users)>=1)
                            <table  class="table table-hover">
                               {{--  <h6 class="text-danger"><i><b>You can only perform Actions on post you have created</b></i></h6> --}}
                                <thead class="primary_background_color fw-bolder">
                                  <tr>
                                    <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                    <th scope="col">Rider Image</th>
                                    <th scope="col">Bike Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Zone</th>
                                    <th scope="col">Available</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <th scope="row"  style="width: 5%"><img src="./storage/rider_images/{{$user->rider_image}}" alt="" class="img-fluid rounded-pill" ></th>
                                        <th scope="row"  style="width: 5%"><img src="./storage/bike_images/{{$user->bike_image}}" alt="" class="img-fluid rounded-pill" ></th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$user->number}}</td>
                                        <td>{{$user->zone}}</td>
                                        <td>
                                            <form action="">
                                                @if ($user->status == 1)
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
                                         <td>
                                            <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                                    <li class="w-100 d-flex">
                                                      <span class="mx-1 details rounded border shadow-lg ">
                                                        <a class="btn btn-success fw-bolder " href="./editrider/{{$user->id}}">
                                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                                          </a>
                                                      </span>
                                                      <span class="mx-1 rounded border shadow-lg  ">
                                                        <form action="{{route('destroyrider', $user->id) }}" method="post">
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
                                    <div class="alert alert-danger text-white fw-bolder bg-danger">No Rider Found!</div>
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
