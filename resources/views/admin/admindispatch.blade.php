@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dispatches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Rider Dispatches</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="bdispatch-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Rider Dispatches') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($dispatches)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Rider Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Rider Amount</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Rider Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Rider Amount</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($dispatches as $dispatch)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>
                              @foreach ($orders as $order)
                                  @if ($order->id == $dispatch->order_id)
                                      {{$order->order_number}}
                                  @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach ($riders as $rider)
                              @if ($rider->id == $dispatch->rider_id)
                                  {{$rider->email}}
                              @endif
                             @endforeach  
                            </td>
                            <td>{{$dispatch->address}}</td>
                            <td>{{$dispatch->rider_amount}}</td>
                            <td>{{$dispatch->order_amount}}</td>
                            <td>
                              @if($dispatch->status=='delivered')
                                    <span class="fw-bold text-success">{{$dispatch->status}}</span>
                                @else
                                    <span class="fw-bold text-warning">{{$dispatch->status}}</span>
                                @endif
                              </td>
                    
                            <td>{{$dispatch->created_at}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$dispatches->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No dispatches found!!! Please create dispatch</h6>
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
