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
                        <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
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
                                    
                                      {{-- geographical map that cordinates can be selected --}}
                                      <div id="map" style="height: 400px;"></div>

                                      <input type="text" name="cordinates" id="cordinates" class="form-control">
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

    <section class="section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card overflow-auto" style="border-radius: 10px">
                        <div class="card-header bg-white fw-bolder" >
                            {{ __('Zones') }}</div>
                        <div class="card-body" style="margin: -1.3%">  
                        
                        @if (count($users)>=1)
                        <table  class="table table-hover">
                            <thead class="bg-warning  fw-bolder">
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col w-50">Description</th>
                                <th scope="col w-25 overflow-auto" >cordinates</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td><a href="#" class="text-primary fw-bold">{{$user->title}}</a></td>
                                    <td class="w-25">{{$user->description}}</td>
                                    <td class="overflow-auto" style="max-width: 50px; max-height:50px">{{$user->cordinates}}</td>
                                    <td>{{$user->created_at}}</td>
                                        @if(Auth::user()->role=='admin')
                                        
                                        <td>
                                          <form action="{{route('destroyzone', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger fw-bolder">Delete</button>
                                          </form>                                          
                                        </td>
                                        @endif
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
          </section>
    @endif
</main>

<script>
    var map;
    var drawingManager;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
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

        // Add event listener to capture coordinates when a polygon is drawn
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQMAYTywUqaahxnQUe-Y-C5GVMVb-Bwc8&libraries=drawing&callback=initMap"></script>

@endsection
