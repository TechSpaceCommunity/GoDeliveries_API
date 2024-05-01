@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Reviews</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Rating & Reviews</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="breview-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Food Ratings & Reviews') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($reviews)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Food</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Date</th>
                        {{-- <th scope="col" colspan="1" align="center">Actions</th> --}}
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Food</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Date</th>
                        {{-- <th scope="col" colspan="1" align="center">Actions</th> --}}
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($reviews as $review)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>{{$review->customer_id}}</td>
                            <td>{{$review->name}}</td>
                            <td>
                              @foreach ($foods as $food)
                                  @if ($food->id == $review->product_id)
                                      {{$food->title}}
                                  @endif
                              @endforeach
                              </td>
                            <td>{{$review->rating}}</td>
                            <td>{{$review->comment}}</td>                    
                            <td>{{$review->created_at}}</td>
                            
                            {{-- <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 rounded breview shadow-lg  ">
                                        <form method="POST" action="{{route('review.destroy',[$review->id])}}">
                                          @csrf
                                          @method('delete')
                                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$review->id}} style="height:30px; width:30px;breview-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                          </form>  
                                      </span>
                                      
                                    </li>
                                </ul>
                            </a>
                            </td> --}}
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$reviews->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No reviews & ratings found!!! Please create review</h6>
                @endif
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

@endsection
