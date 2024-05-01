@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div
              class="card-body profile-card pt-4 d-flex flex-column align-items-center"
            >
              <img
                src="./storage/restaurant_cover_images/{{$restaurant->cover_image}}"
                alt="Profile"
                class="rounded-circle"
              />
              <h2>{{ $restaurant->name }}</h2>
              <h3>{{ $restaurant->email  }}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"
                  ><i class="bi bi-facebook"></i
                ></a>
                <a href="#" class="instagram"
                  ><i class="bi bi-instagram"></i
                ></a>
                <a href="#" class="linkedin"
                  ><i class="bi bi-linkedin"></i
                ></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item mx-1">
                  <button
                    class="nav-link active primary_background_color text-dark fw-bold "
                    data-bs-toggle="tab"
                    data-bs-target="#profile-overview"
                    style="border-bottom-right-radius: 30px;border-top-right-radius: 30px; background-color:#ff8542;"
                    
                  >
                  Restaurant Details
                  </button>
                </li>
                <li class="nav-item mx-1">
                  <a href="./editrestaurantprofile/{{$restaurant->id}}"
                    class="nav-link bg-success text-white fw-bold btn "
                    style="border-bottom-right-radius: 30px;border-top-right-radius: 30px"
                  >
                    Update Details
                  </a>
                </li>

              </ul>
              <div class="tab-content pt-2">
                <div
                  class="tab-pane fade show active profile-overview"
                  id="profile-overview"
                >

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ $restaurant->name  }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">
                        {{ $restaurant->email }}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ $restaurant->address  }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Opening Time</div>
                    <div class="col-lg-9 col-md-8">{{ $restaurant->opening_time  }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Closing Time</div>
                    <div class="col-lg-9 col-md-8">{{ $restaurant->closing_time  }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Minimum Order</div>
                    <div class="col-lg-9 col-md-8">{{ $restaurant->minimum_order  }}</div>
                  </div>
                  </div>
                </div>

                
              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

@endsection
