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
            <li class="breadcrumb-item active">Edit Zone</li>
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
                            {{ __('Edit Zone') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('updatezone', $zone->id) }}">
                                @csrf
        
                                <div class="row mb-3 d-flex">
                                    <div class="col-6">
        
                                      <div class="col-md-12">
                                          <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ $zone->title}}" required autocomplete="title"  autofocus>
          
                                          @error('title')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                    </div>

                                    <div class="col-6">
          
                                        <div class="col-md-12">
                                            <input id="description" type="text" class="form-control rounded-pill bg-light @error('description') is-invalid @enderror"  name="description" value="{{ $zone->description }}" required autocomplete="description"  autofocus>
            
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

                                      <input type="text" name="cordinates" id="cordinates" class="form-control" value="{{$zone->cordinates}}">
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
