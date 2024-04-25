@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    @if(Auth::user()->role=='admin')
    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50 fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                          {{ __('Add User') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('createuser') }}">
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
      
                              <div class="row my-2">
                                <div class="col-md-12">
                                  <select id="role" class="form-control rounded-pill bg-light @error('role') is-invalid @enderror" name="role" required>
                                      <option value="">Select Role</option>
                                      <option value="admin"{{ old('role') == 'admin' ? ' selected' : '' }}>Admin</option>
                                      <option value="rider_manager"{{ old('role') == 'rider_manager' ? ' selected' : '' }}>Rider Manager</option>
                                      <option value="vendor_manager"{{ old('role') == 'vendor_manager' ? ' selected' : '' }}>Vendor Manager</option>
                                      <option value="restaurant_manager"{{ old('role') == 'restaurant_manager' ? ' selected' : '' }}>Restaurant Manager</option>
                                      <option value="customer_manager"{{ old('role') == 'customer_manager' ? ' selected' : '' }}>Customer Manager</option>
                                  </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                              <div class="row mb-0" align="start">
                                  <div class="col-md-8 offset-md-4 d-block">
                                      <button type="submit" class="primary_background_color fw-bolder text-center w-25 rounded-pill" style="box-shadow: 2px 2px 4px black">
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
                        {{ __('System Users') }}</div>
                    <div class="card-body" style="margin: -1.3%">  
                    
                    @if (count($users)>=1)
                    <table  class="table table-hover">
                       {{--  <h6 class="text-danger"><i><b>You can only perform Actions on post you have created</b></i></h6> --}}
                        <thead class="primary_background_color  fw-bolder">
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Role</th>
                            <th scope="col">Joining Date</th>
                            <th scope="col" colspan="1" align="center">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><a href="#" class="text-primary fw-bold">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>@if ($user->number == '')
                                    Null
                                @else
                                {{$user->number}}
                                @endif</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->created_at}}</td>
                                <td ><span @if ($user->status == 'active')
                                  class="btn btn-success fw-bolder"
                                @else
                                class="btn btn-danger fw-bolder"
                                @endif >{{$user->status}}</span>
                                </td>
                                    @if(Auth::user()->role=='admin')
                                    
                                    <td>
                                      @if ($user->status == 'active')
                                      <form action="{{route('destroyuser', $user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger fw-bolder">Delete</button>
                                      </form>
                                      @else
                                      <form action="{{route('activateuser', $user->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success fw-bolder">Activate</button>
                                      </form>
                                      @endif
                                      
                                    </td>
                                    @endif
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div>
                      <div class="alert alert-danger text-white fw-bolder bg-danger">No Users Found!</div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>

  </main><!-- End #main -->

@endsection
