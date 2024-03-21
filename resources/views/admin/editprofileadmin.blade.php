@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Update Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item  mx-1">
                  <button
                    class="nav-link active bg-success text-white fw-bold"
                    data-bs-toggle="tab"
                    data-bs-target="#profile-update"
                  >
                  Update Profile Details
                  </button>
                </li>

              </ul>
              <div class="tab-content pt-2">
                <div
                  class="tab-pane fade show active profile-overview"
                  id="profile-update"
                >

                <div>
                  <form action="{{ route('admin.updateprofile', $user) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('POST')
                      <div class="form-group">
                          <label for="name" class="fw-bolder">Full Name</label>
                          <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                      </div>
                      
                      <div class="form-group">
                          <label for="email" class="fw-bolder">Email</label>
                          <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="4Gb ram, 500HDD, core i5, 7th generation" readonly>
                      </div>
                      <button type="submit" class="btn btn-success w-100 align-items-center mt-2 fw-bolder" align="center">Update</button>
                  </form>
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
