@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Payments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Payments</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="bpayment-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Restaurant Payments') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($payments)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment Number</th>
                        <th scope="col">Payment ID</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col" colspan="1" align="center">Payment Status</th>
                        <th scope="col">Order Date</th>
                        {{-- <th scope="col" colspan="1" align="center">Actions</th> --}}
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment Number</th>
                        <th scope="col">Payment ID</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col" colspan="1" align="center">Payment Status</th>
                        <th scope="col">Order Date</th>
                        {{-- <th scope="col" colspan="1" align="center">Actions</th> --}}
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($payments as $payment)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>{{$payment->customer_id}}</td>
                            <td>{{$payment->email}}</td>
                            <td>{{$payment->order_number}}</td>
                            <td>{{$payment->quantity}}</td>
                            <td>{{$payment->total_amount}}</td>
                            @php
                                  $paymentDetails = json_decode($payment->payment_details, true);
                              @endphp

                              <td>{{$paymentDetails['EMAIL'] ?? 'Null'}}</td>
                              <td>{{$paymentDetails['TOKEN'] ?? 'Null'}}</td>
                            <td>{{$payment->payment_method}}</td>
                            <td>
                              @if($payment->payment_status=='paid')
                                    <span class="fw-bold text-success">{{$payment->payment_status}}</span>
                                @else
                                    <span class="fw-bold text-danger">{{$payment->payment_status}}</span>
                                @endif
                              </td>
                    
                            <td>{{$payment->created_at}}</td>
                            
                            {{-- <td>
                              <a class="dropdown text-decoration-none"  data-bs-toggle="dropdown"><i class="ri ri-more-2-fill fw-bolder cursor-pointer"></i>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile text-align-center align-items-center">
                                    <li class="w-100 d-flex">
                                      <span class="mx-1 rounded bpayment shadow-lg  ">
                                        <form method="POST" action="{{route('payment.destroy',[$payment->id])}}">
                                          @csrf
                                          @method('delete')
                                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$payment->id}} style="height:30px; width:30px;bpayment-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></button>
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
                {{-- <span style="float:right">{{$payments->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No payments found!!! Please create payment</h6>
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
