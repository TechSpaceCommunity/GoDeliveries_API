@extends('layouts.restaurantdashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Food</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('restaurants')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Category Food</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
      <div class="container">
          <div class="row ">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header w-50 bg-warning fw-bolder" style="border-bottom-right-radius: 30px;border-top-right-radius: 30px" >
                          {{ __('Add Food') }}</div>
      
                      <div class="card-body">
                          <form method="POST" action="{{ route('createfood') }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                              <div class="row mb-3 d-flex">
                                  <div class="col-6">
                                    <label for="title" class="col-md-6 col-form-label fw-bolder">{{ __('Title') }}</label>
      
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control rounded-pill bg-light @error('title') is-invalid @enderror"  name="title" value="{{ old('title') }}" required autocomplete="title"  placeholder="" autofocus>
        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="summary" class="col-md-6 col-form-label fw-bolder">{{ __('Description') }}</label>
      
                                    <div class="col-md-12">
                                        <textarea id="summary"  class="form-control rounded-pill bg-light @error('summary') is-invalid @enderror"  name="summary" value="{{ old('summary') }}" required autocomplete="summary"  placeholder="" autofocus></textarea>
        
                                        @error('summary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="child_cat_id" class="col-md-12 col-form-label fw-bolder">Child Food Category <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <select name="child_cat_id" id="child_cat_id" class="form-control rounded-pill">
                                      <option value="">--Select any category--</option>
                                      @foreach($categories as $cat_data)
                                          <option value='{{$cat_data->id}}'>{{$cat_data->title}}
                                          
                                          </option>
                                      @endforeach
                                  </select>

                                    @error('child_cat_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  </div>

                                  <div class="col-6">
                                    <label for="price" class="col-md-6 col-form-label fw-bolder">Price($) <span class="text-danger">*</span></label>
      
                                    <div class="col-md-12">
                                      <input id="price" type="number" class="form-control rounded-pill bg-light @error('price') is-invalid @enderror"  name="price" value="{{ old('price') }}" required autocomplete="price"  placeholder="" autofocus>
        
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>

                              <div class="row mb-3 d-flex">
                                <div class="col-6">
                                  <label for="discount" class="col-md-6 col-form-label fw-bolder">Discount(%) </label>
    
                                  <div class="col-md-12">
                                    <input id="discount" type="number" class="form-control rounded-pill bg-light @error('discount') is-invalid @enderror"  name="discount" value="{{ old('discount') }}" required autocomplete="discount"  placeholder="" autofocus>
      
                                      @error('discount')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="col-6">
                                  <label for="stock" class="col-md-6 col-form-label fw-bolder">Quantity <span class="text-danger">*</span></label>
    
                                  <div class="col-md-12">
                                    <input id="stock" type="number" class="form-control rounded-pill bg-light @error('stock') is-invalid @enderror"  name="stock" value="{{ old('stock') }}" required autocomplete="stock"  placeholder="" autofocus>
      
                                      @error('stock')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3 d-flex">

                                <div class="col-6">
                                  <label for="Photo" class="col-md-6 col-form-label fw-bolder">{{ __('Photo') }}</label>
    
                                  <div class="col-md-12">
                                    <input id="photo" type="file" class="form-control rounded-pill @error('photo') is-invalid @enderror"  name="photo" value="{{ old('photo') }}" required autocomplete="photo" autofocus >
            
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>

                                  <div class="col-6">
                                    <label for="status" class="col-md-6 col-form-label fw-bolder">{{ __('Status') }}</label>
      
                                    <div class="col-md-12">
                                      <select name="status" class="form-control  rounded-pill @error('status') is-invalid @enderror" autofocus>
                                        <option value="">--Select Status--</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
        
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
      
                              <div class="row mb-0" align="start">
                                  <div class="col-md-8 offset-md-4 d-block">
                                      <button type="submit" class="btn btn-warning fw-bolder text-center w-25 rounded-pill" style="box-shadow: 2px 2px 4px black">
                                          {{ __('SAVE') }}
                                      </button><br>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <section class="section profile">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left">Food Lists</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(count($products)>0)
                <table class="table table-hover" id="banner-dataTable" width="100%" cellspacing="0">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th>S.N.</th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Child Category</th>
                      <th>Major Category</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-dark text-white">
                    <tr>
                      <th>S.N.</th>
                      <th>Photo</th>
                      <th>Title</th>
                      <th>Child Category</th>
                      <th>Major Category</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
        
                    @foreach($products as $product)
                      @php
                      @endphp
                        <tr>
                          <td>{{$product->id}}</td>
                          <td>
                            <img src="./storage/food_photo/{{$product->photo}}" class="img-fluid" style="max-width:80px" alt="{{$product->photo}}">
                          </td>
                          <td>{{$product->title}}</td>
                          <td>{{$product->child_cat_info['title']}}
                          </td>
                          <td>{{$product->parent_cat_info['title']}}
                          </td>
                          <td>$. {{$product->price}} /-</td>
                          <td>  {{$product->discount}}% OFF</td>
                          <td>
                            @if($product->stock>0)
                            <span class="text-primary">{{$product->stock}}</span>
                            @else
                            <span class="text-danger">{{$product->stock}}</span>
                            @endif
                          </td>
                          
                          <td>
                              @if($product->status=='active')
                                  <span class="fw-bold text-success">{{$product->status}}</span>
                              @else
                                  <span class="fw-bold text-warning">{{$product->status}}</span>
                              @endif
                          </td>
                          <td>
                              {{-- <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a> --}}
                          <form method="POST" action="{{route('food.destroy',[$product->id])}}">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></button>
                              </form>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <span style="float:right">{{$categories->links()}}</span> --}}
                @else
                  <h6 class="text-center text-danger fw-bolder">No Food found!!! Please create Category Food</h6>
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
