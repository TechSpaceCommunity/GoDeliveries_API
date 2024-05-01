@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle" style="margin-top: -4%">
        {{-- <h1>customers</h1> --}}
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Customers</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      @if(Auth::user()->role=='admin')
    {{-- <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                            {{ __('Add Customer') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('createcategory') }}">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
                                      <label for="name" class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label>
        
                                      <div class="col-md-12">
                                          <input id="name" type="text" class="form-control rounded-pill bg-light @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="User Name" autofocus>
          
                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>
  
                                    <div class="col-6">
                                      <label for="email" class="col-md-4 col-form-label fw-bolder">{{ __('email') }}</label>
        
                                      <div class="col-md-12">
                                          <input id="email" type="email" class="form-control rounded-pill bg-light @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Email" autofocus>
          
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
                                    <label for="number" class="col-md-4 col-form-label fw-bolder">{{ __('Number') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="number" type="number" class="form-control rounded-pill bg-light @error('number') is-invalid @enderror"  name="number" value="{{ old('number') }}" required autocomplete="number" placeholder="Phone Number" autofocus>
        
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
  
                                    <div class="col-6">
                                      <label for="password" class="col-md-4 col-form-label fw-bolder">{{ __('Password') }}</label>
        
                                      <div class="col-md-12">
                                          <input id="password" type="password" class="form-control rounded-pill bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Password">
          
                                          @error('password')
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
    </section> --}}

    @endif 
    
    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header py-3 text-dark fw-bolder" style="background-color:#ff8542;">
                          <h6 class="m-0 fw-bolder text-dark float-left">App Customers</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                        
                            @if (count($users)>=1)
                            <table  class="table table-hover w-100">
                                <thead class="bg-dark text-white ">
                                    <tr>
                                        <th><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Joining Date</th>
                                        <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tfoot class="bg-dark text-white">
                                    <tr>
                                        <th><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Joining Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <td><a href="#" class="text-primary text-decoration-none text-dark">{{$user->name}}</a></td>
                                        <td>{{$user->email}}</td>
                                        <td>@if ($user->number == '')
                                            Null
                                        @else
                                        {{$user->number}}
                                        @endif</td>
                                        <td>{{$user->created_at}}</td>
                                            @if(Auth::user()->role=='admin')
                                            
                                            <td>
                                            <form action="{{route('destroycustomer', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger fw-bolder"><i class="b bi-trash"></i></button>
                                            </form>                                          
                                            </td>
                                            @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div>
                            <div class="alert alert-danger text-white fw-bolder bg-danger">No Customer Found!</div>
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
