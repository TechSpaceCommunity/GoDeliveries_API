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
            <li class="breadcrumb-item active"> Edit Restaurant Section</li>
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
                        <form method="POST" action="{{ route('editrestaurantsection', $restaurantsection->id) }}">
                            @csrf
                            <div class="d-flex">
                                <div class="card-header w-50  fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px;background-color:#ff8542;" >
                                    {{ __('Edit Restaurant Section') }}
                                </div>
                                <div class="card-header w-50  fw-bolder d-flex" style="border: none">
                                    <label for="enable">Enable</label>
                                    <div class="form-check form-switch mx-2"> 
                                        <input type="hidden" name="status" value="0">
                                        @if ($restaurantsection->status == 1)
                                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1">
                                        @endif                                      
                                        
                                    </div>
                                </div>
                            </div>
            
                            <div class="card-body">
                                <div class="row mb-3 d-block">
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"  name="name" value="{{ $restaurantsection->name }}" required autocomplete="name" autofocus >
            
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
                                                            <input type="checkbox" name="restaurants[{{$restaurant->id}}][selected]" id="restaurants{{$restaurant->id}}"
                                                            @if(in_array($restaurant->id, $existingRestaurantIds)) checked @endif>
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
</main>
@endsection
