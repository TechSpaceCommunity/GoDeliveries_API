@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle" style="margin-top: -4%">
        {{-- <h1>zones</h1> --}}
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">Zones</li>
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
                        <div class="card-header w-50  fw-bolder" style="background-color:#ff8542;border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                            {{ __('Zone') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('createzone') }}">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
        
                                      <div class="col-md-12">
                                          <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ old('title') }}" required autocomplete="title"  placeholder="Title" autofocus>
          
                                          @error('title')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
          
                                        <div class="col-md-12">
                                            <input id="description" type="text" class="form-control rounded-pill bg-light @error('description') is-invalid @enderror"  name="description" value="{{ old('description') }}" required autocomplete="description"  placeholder="Description" autofocus>
            
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
  
                                <div class="row mb-3 d-flex">
                                      <input id="pac-input" class="controls form-control rounded-pill bg-light" type="text" placeholder="Search for a place">
                                      <div id="map" style="height: 400px;"></div>

                                      <input type="text" name="cordinates" id="cordinates" class="form-control">
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

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header py-3 text-dark fw-bolder" style="background-color:#ff8542;">
                          <h6 class="m-0 fw-bolder text-dark float-left">Zones</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive"> 
                            @if (count($users)>=1)
                            <table  class="table table-hover w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                        <th scope="col">Title</th>
                                        <th scope="col w-50">Description</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot class="bg-dark text-white">
                                    <tr>
                                        <th scope="col"><i class="bi bi-stop fw-bolder fs-5"></i></th>
                                        <th scope="col">Title</th>
                                        <th scope="col w-50">Description</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><i class="bi bi-stop fw-bolder fs-5"></i></td>
                                        <td>{{$user->title}}</td>
                                        <td class="w-25">{{$user->description}}</td>
                                        <td>{{$user->created_at}}</td>
                                        {{-- @if(Auth::user()->role=='admin') --}}
                                        
                                        <td>
                                            <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                                    <li class="w-100 d-flex">
                                                    <span class="mx-1 details rounded border shadow-lg ">
                                                        <a class="btn btn-success fw-bolder " href="./editzone/{{$user->id}}">
                                                            <i class="bi bi-pen fw-bolder text-white" ></i>
                                                        </a>
                                                    </span>
                                                    <span class="mx-1 rounded border shadow-lg  ">
                                                        <form action="{{route('destroyzone', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger fw-bolder"><i class="b bi-trash"></i></button>
                                                        </form>  
                                                    </span>
                                                    
                                                    </li>
                                                    </ul>
                                            </a>                                         
                                        </td>
                                        {{-- @endif --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div>
                            <div class="alert alert-danger text-white fw-bolder bg-danger">No Zone Record Found!</div>
                            </div>
                            @endif
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    </section>
    @endif
</main>

<script>
    var map;
    var drawingManager;
    var autocomplete;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 1.3107, lng: 36.8250 },
            zoom: 10
        });

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon']
            }
        });
        drawingManager.setMap(map);

        var input = document.getElementById('pac-input');
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); 
            }
        });


        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            if (event.type === 'polygon') {
                var coordinates = event.overlay.getPath().getArray();
                var coordinateStrings = coordinates.map(coord => coord.lat() + ',' + coord.lng());
                var coordinatesString = coordinateStrings.join(';');
                document.getElementById('cordinates').value = coordinatesString;
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0X7ZtlzuNrfybfRykn_Pw1bxTqvCtdNQ&libraries=drawing,places&callback=initMap"></script>

@endsection
