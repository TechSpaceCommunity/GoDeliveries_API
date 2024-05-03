@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Restaurant Dasboard</h1>
      <nav> 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Restaurant</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="container">
          <div class="row d-flex">
                  <div class="col-xxl-3 col-xl-3 " >
                      <div class="card " style="background-color:  rgb(207, 231, 240)" >  
                          <div class="card-body align-items-center justify-content-center" style="margin-top: -8%">
                              <h5 class="card-title"><span class="fw-bolder text-dark">Total Categories</h5>
          
                              <div class="row d-flex justify-content-space-between" >
                                  <div class="col mx-1 "><h6 class="fw-bolder fs-5">{{$totalcategories}}</h6></div>
                                  <div class="col mx-1 "><i class="bi bi-bar-chart-line-fill"></i></div>
                              </div>
                          </div>
                      </div>
                  </div>
      
                  <div class="col-xxl-3 col-xl-3 ">
                      <div class="card " style="background-color: rgb(169, 240, 169)" >  
                          <div class="card-body align-items-center justify-content-center" style="margin-top: -8%">
                              <h5 class="card-title"><span class="fw-bolder text-dark">Total Inventory</h5>
          
                              <div class="row d-flex justify-content-space-between" >
                                  <div class="col mx-1 "><h6 class="fw-bolder fs-5">{{$totalfood}}</h6></div>
                                  <div class="col mx-1 "><i class="bi bi-bar-chart-line-fill"></i></div>
                              </div>
                          </div>
                      </div>
                  </div>
      
                  <div class="col-xxl-3 col-xl-3 ">
                      <div class="card " style="background-color:rgb(207, 231, 240)" >  
                          <div class="card-body align-items-center justify-content-center" style="margin-top: -8%">
                              <h5 class="card-title"><span class="fw-bolder text-dark">Total Orders</h5>
          
                              <div class="row d-flex justify-content-space-between" >
                                  <div class="col mx-1 "><h6 class="fw-bolder fs-5">{{$totalorders}}</h6></div>
                                  <div class="col mx-1 "><i class="bi bi-bar-chart-line-fill"></i></div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-xxl-3 col-xl-3 ">
                      <div class="card " style="background-color: rgb(247, 196, 101)" >  
                          <div class="card-body align-items-center justify-content-center" style="margin-top: -8%">
                              <h5 class="card-title"><span class="fw-bolder text-dark" >Total Revenue</h5>
          
                              <div class="row d-flex justify-content-space-between" >
                                  <div class="col mx-1 "><h6 class="fw-bolder fs-5">Ksh. {{$totalrevenue}}</h6></div>
                                  <div class="col mx-1 "><i class="bi bi-bar-chart-line-fill"></i></div>
                              </div>
                          </div>
                      </div>
                  </div>
              
          </div>
          <div class="row ">
              
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <!-- Line Chart -->
                      <div id="reportsChart"></div>

                      <script>
                          document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#reportsChart"), {
                              series: [
                                  {
                                      name: 'Categories',
                                      data: {!! json_encode($categoryMonthlyData) !!}
                                  },
                                  {
                                      name: 'Inventory',
                                      data: {!! json_encode($foodMonthlyData) !!}
                                  },
                                  {
                                      name: 'Orders',
                                      data: {!! json_encode($orderMonthlyData) !!}
                                  }
                              ],
                              chart: {
                                  height: 350,
                                  type: 'area',
                                  toolbar: {
                                      show: false
                                  },
                              },
                              markers: {
                                  size: 4
                              },
                              colors: ['#4154f1', '#2eca6a', '#ff771d'],
                              fill: {
                                  type: "gradient",
                                  gradient: {
                                      shadeIntensity: 1,
                                      opacityFrom: 0.3,
                                      opacityTo: 0.4,
                                      stops: [0, 90, 100]
                                  }
                              },
                              dataLabels: {
                                  enabled: false
                              },
                              stroke: {
                                  curve: 'smooth',
                                  width: 2
                              },
                              xaxis: {
                                  type: 'category',
                                  categories: {!! json_encode(range(1, 12)) !!}
                              },
                          }).render();

                          });
                      </script>
                      
                      <!-- End Line Chart -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  </main>
  <!-- End #main -->

@endsection
