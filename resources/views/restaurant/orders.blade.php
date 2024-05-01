@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Orders</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="border-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Restaurant Orders') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($orders)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Order Number</th>
                      <th>Customer ID</th>
                      <th>Sub Total</th>
                      <th>Coupon</th>
                      <th>Total Amount</th>
                      <th>Quantity</th>
                      <th>Payment Method</th>
                      <th>Payment Status</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Country</th>
                      <th>Post Code</th>
                      <th>Address 1</th>
                      <th>Address 2</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Order Number</th>
                      <th>Customer ID</th>
                      <th>Sub Total</th>
                      <th>Coupon</th>
                      <th>Total Amount</th>
                      <th>Quantity</th>
                      <th>Payment Method</th>
                      <th>Payment Status</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Country</th>
                      <th>Post Code</th>
                      <th>Address 1</th>
                      <th>Address 2</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($orders as $order)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->customer_id}}</td>
                            <td>{{$order->sub_total}}</td>
                            <td>{{$order->coupon}}</td>
                            <td>{{$order->total_amount}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>
                              @if($order->payment_status=='paid')
                              <span class="fw-bold text-success">{{$order->payment_status}}</span>
                              @else
                                  <span class="fw-bold text-danger">{{$order->payment_status}}</span>
                              @endif  
                            </td>
                            <td>
                                @if($order->status=='new')
                                    <span class="fw-bold text-warning">{{$order->status}}</span>
                                @elseif($order->status=='process')
                                    <span class="fw-bold text-primary">{{$order->status}}</span>
                                @elseif($order->status=='delivered')
                                    <span class="fw-bold text-success">{{$order->status}}</span>
                                @else
                                    <span class="fw-bold text-danger">{{$order->status}}</span>
                                @endif
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->country}}</td>
                            <td>{{$order->post_code}}</td>
                            <td>{{$order->address1}}</td>
                            <td>@if ($order->address2 != '')
                              {{$order->address2}}
                            @else
                                Null
                            @endif</td>
                            <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 rounded border shadow-lg  ">
                                        <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                                          @csrf
                                          @method('delete')
                                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                          </form>  
                                      </span>
                                      
                                    </li>
                                </ul>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$orders->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No orders found!!! Please create order</h6>
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
