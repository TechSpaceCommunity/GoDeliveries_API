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
        <div class="col-md-12 border shadow-lg rounded">
          <div class="card " style="border-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Restaurant Orders') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($orders)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <h6 class="text-success fw-bold"> &longmapsto; Click the Order Number to view the Order Details -</h6>
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Order Number</th>
                      <th>Total Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                      <th>Order Number</th>
                      <th>Total Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($orders as $order)
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                              {{-- href="{{route('showorder', $order->id) }}" --}}
                            <td><a class="text-decoration-none fw-bold cursor-pointer" style="cursor: pointer" data-order-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                              {{ $order->order_number }}
                              </a>
                            </td>
                            <td>{{$order->total_amount}}</td>
                            <td>{{$order->created_at}}</td>
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
        {{-- <div class="col-md-6 border shadow-lg" style="height: 70vh; overflow-y:scroll;">
          @yield('order')
        </div> --}}
        <div class="modal fade" id="verticalycentered" tabindex="-1" >
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
            <div class="modal-content" >
              <div class="modal-header" style="background-color:#ff8542;">
                <h5 class="modal-title fw-bold" >Order Details</h5>
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
                              fetch('/orders/' + orderId)
                                  .then(response => response.json())
                                  .then(data => {
                                      // Populate the modal with order details
                                      document.querySelector('#verticalycentered .modal-body').innerHTML = `
                                      <div class="card-body" >  
                                    <div class="table-responsive">
                                    <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                                        <thead class="w-100">
                                            <tr ><th colspan="2" class="bg-dark text-white fw-bolder">Order Payment Details</th></tr>
                                        </thead>
                                        <tbody class="w-100">
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold" >Order Number</td>
                                                <td>${data.order_number}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Customer Id</td>
                                                <td>${data.customer_id}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Sub Total</td>
                                                <td>${data.sub_total}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Coupon</td>
                                                <td>${data.coupon}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Total Amount</td>
                                                <td>${data.total_amount}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Quantity</td>
                                                <td>${data.quantity}</td>
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
                                                <td class="bg-secondary text-light fw-bold">Order Status</td>
                                                <td>
                                                  ${data.status === 'new' ? '<span class="fw-bold text-warning">' + data.status + '</span>' :
                                                  data.status === 'process' ? '<span class="fw-bold text-primary">' + data.status + '</span>' :
                                                  data.status === 'delivered' ? '<span class="fw-bold text-success">' + data.status + '</span>' :
                                                  '<span class="fw-bold text-danger">' + data.status + '</span>'}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Date</td>
                                                <td>${data.created_at}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Order Description</td>
                                                <td>${data.description}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                                        <thead class="w-100">
                                            <tr ><th colspan="2"  class="bg-dark text-white fw-bolder">Order Shipping Details</th></tr>
                                        </thead>
                                        <tbody class="w-100">
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Name</td>
                                                <td>${data.name}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Email</td>
                                                <td>${data.email}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Phone</td>
                                                <td>${data.phone}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Country</td>
                                                <td>${data.country}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Post Code</td>
                                                <td>${data.post_code}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Address 1</td>
                                                <td>${data.address1}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-secondary text-light fw-bold">Address 2</td>
                                                <td>${data.address2}</td>
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
      
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

@endsection
