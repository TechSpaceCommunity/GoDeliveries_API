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
                  <h6 class="text-success fw-bold"> &longmapsto; Click the Customer Email to view the Payment Details -</h6>
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order Date</th>
                        {{-- <th scope="col" colspan="1" align="center">Actions</th> --}}
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($payments as $payment)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>
                              <a class="text-decoration-none fw-bold cursor-pointer" style="cursor: pointer" data-order-id="{{ $payment->id }}" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                              {{$payment->email}}
                              </a>
                            </td>
                            <td>{{$payment->order_number}}</td>
                            <td>{{$payment->total_amount}}</td>
                            <td>{{$payment->created_at}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$payments->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No payments found!!!</h6>
                @endif
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="verticalycentered" tabindex="-1" >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" >
          <div class="modal-header" style="background-color:#ff8542;">
            <h5 class="modal-title fw-bold" >Payment Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <!-- The content will be injected here -->
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  // Attach event listener to each order number link
                  document.querySelectorAll('[data-order-id]').forEach(function (orderLink) {
                      orderLink.addEventListener('click', function (event) {
                          // Prevent default link behavior
                          event.preventDefault();
              
                          // Get the order ID from the data attribute
                          var orderId = this.getAttribute('data-order-id');
              
                          // Make an AJAX request to fetch order details
                          fetch('/payment/' + orderId)
                              .then(response => response.json())
                              .then(data => {
                                // Parse the payment details JSON string
                                const paymentDetails = JSON.parse(data.payment_details);

                                  // Populate the modal with order details
                                  document.querySelector('#verticalycentered .modal-body').innerHTML = `
                                  <div class="card-body" >  
                                <div class="table-responsive">
                                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                                    <tbody class="w-100">
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold" >Customer ID</td>
                                            <td>${data.customer_id}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Customer Email</td>
                                            <td>${data.email}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Order Number</td>
                                            <td>${data.order_number}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Quantity</td>
                                            <td>${data.quantity}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Amount</td>
                                            <td>${data.total_amount}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Payment Number</td>
                                            <td>${paymentDetails.EMAIL}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Payment ID</td>
                                            <td>${paymentDetails.TOKEN}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Payment Method</td>
                                            <td>${data.payment_method}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Payment Status</td>
                                            <td>${data.payment_status === 'paid' ? '<span class="fw-bold text-success">' + data.payment_status + '</span>' : '<span class="fw-bold text-danger">' + data.payment_status + '</span>'}</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-secondary text-light fw-bold">Order Date</td>
                                            <td>${data.created_at}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                                  `;
              
                                  // Open the modal
                                  /* var modal = new bootstrap.Modal(document.querySelector('#verticalycentered'));
                                  modal.show(); */
                              })
                              .catch(error => console.error('Error:', error));
                      });
                  });
              });
              
              </script>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- End #main -->

@endsection
