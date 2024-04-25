@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle" style="margin-top: -4%">
        {{-- <h1>notifications</h1> --}}
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Notifications</li>
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
                        <div class="card-header w-50 fw-bolder" style="background-color:#ff8542;border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                            {{ __('Send Notification') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('createnotification') }}">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col">
                                      {{-- <label for="name" class="col-md-4 col-form-label fw-bolder">{{ __('Name') }}</label> --}}
        
                                      <div class="col-md-12">
                                          <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ old('title') }}" required autocomplete="title"  placeholder="Title" autofocus>
          
                                          @error('title')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>
                                </div>
  
                                <div class="row mb-3 d-flex">
                                    <div class="col">
                                        {{-- <label for="body" class="col-md-4 col-form-label fw-bolder">{{ __('body') }}</label> --}}
          
                                        <div class="col-md-12">
                                            <textarea id="body"  class="form-control rounded bg-light @error('body') is-invalid @enderror"  name="body" value="{{ old('body') }}" required autocomplete="body"  placeholder="Notification Body" rows="5" autofocus></textarea>
            
                                            @error('body')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card " style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Notification History') }}</div>
                        <div class="card-body" style="margin: -1.3%">  
                        
                        @if (count($users)>=1)
                        <table  class="table table-hover">
                            <thead class="primary_background_color fw-bolder">
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Sent Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td><a href="#" class="text-primary fw-bold">{{$user->title}}</a></td>
                                    <td>{{$user->body}}</td>
                                    <td>{{$user->created_at}}</td>
                                        @if(Auth::user()->role=='admin')
                                        
                                        <td>
                                          <form action="{{route('destroynotification', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger fw-bolder"><i class="bi bi-trash text-white fw-bolder"></i></button>
                                          </form>                                          
                                        </td>
                                        @endif
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div>
                          <div class="alert alert-danger text-white fw-bolder bg-danger">No Notification Record Found!</div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </section>
    @endif
</main>
@endsection
