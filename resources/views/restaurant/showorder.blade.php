@extends('restaurant.orders')

@section('order')
<div class="modal fade" id="verticalycentered" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
      <div class="modal-content" >
        <div class="modal-header" style="background-color:#ff8542;">
          <h5 class="modal-title fw-bold" >Order Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <div class="card-body" >  
            <div class="table-responsive">
            <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                <thead class="w-100">
                    <tr ><th colspan="2" class="bg-dark text-white fw-bolder">Order Payment Details</th></tr>
                </thead>
                <tbody class="w-100">
                    <tr>
                        <td class="bg-secondary text-light fw-bold" >Order Number</td>
                        <td>{{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Customer Id</td>
                        <td>{{$order->customer_id}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Sub Total</td>
                        <td>{{$order->sub_total}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Coupon</td>
                        <td>{{$order->coupon}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Total Amount</td>
                        <td>{{$order->total_amount}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Quantity</td>
                        <td>{{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Payment Method</td>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Payment Status</td>
                        <td>
                            @if($order->payment_status=='paid')
                            <span class="fw-bold text-success">{{$order->payment_status}}</span>
                            @else
                                <span class="fw-bold text-danger">{{$order->payment_status}}</span>
                            @endif  
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Order Status</td>
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
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Date</td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Order Description</td>
                        <td>{{$order->description}}</td>
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
                        <td>{{$order->name}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Email</td>
                        <td>{{$order->email}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Phone</td>
                        <td>{{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Country</td>
                        <td>{{$order->country}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Post Code</td>
                        <td>{{$order->post_code}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Address 1</td>
                        <td>{{$order->address1}}</td>
                    </tr>
                    <tr>
                        <td class="bg-secondary text-light fw-bold">Address 2</td>
                        <td>{{$order->address2}}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="primary_background_color fw-bold rounded-pill " data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
