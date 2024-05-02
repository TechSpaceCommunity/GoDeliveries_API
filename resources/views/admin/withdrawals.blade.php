@extends('layouts.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Withdrawal Requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Rider Withdrawal Requests</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card " style="bwithdrawal-radius: 10px; ">
            <div class="card-header  fw-bolder" style="background-color:#ff8542;">
                {{ __('Withdrawal Requests') }}
            </div>
            <div class="card-body">  
              <div class="table-responsive">
                @if(count($withdrawals)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Rider Phone Number</th>
                        <th scope="col">Rider Email</th>
                        <th scope="col">Transaction Code</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th><i class="bi bi-stop fw-bolder fs-5"></th>
                        <th scope="col">Rider Phone Number</th>
                        <th scope="col">Rider Email</th>
                        <th scope="col">Transaction Code</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($withdrawals as $withdrawal)
                      @php
                      @endphp
                        <tr>
                            <td><i class="bi bi-stop fw-bolder fs-5"></td>
                            <td>
                              @foreach ($riders as $rider)
                              @if ($rider->id == $withdrawal->rider_id)
                                  {{$rider->number}}
                              @endif
                             @endforeach
                            </td>
                            <td>
                              @foreach ($riders as $rider)
                              @if ($rider->id == $withdrawal->rider_id)
                                  {{$rider->email}}
                              @endif
                             @endforeach  
                            </td>
                            <td>{{$withdrawal->transaction_code}}</td>
                            <td>{{$withdrawal->amount}}</td>
                            <td>
                              @if($withdrawal->status=='completed')
                                    <span class="fw-bold text-success">{{$withdrawal->status}}</span>
                                @else
                                    <span class="fw-bold text-warning">{{$withdrawal->status}}</span>
                                @endif
                              </td>
                    
                            <td>{{$withdrawal->created_at}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$withdrawals->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No withdrawal requests found!!! Please create withdrawal</h6>
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
