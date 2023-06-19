@extends('admin.layout')

@section('viewTruck')


<!--start content-->
<main class="page-content">
              
  
<div class="col-md-8 col-lg-5 mx-auto mb-5">
              <div class="mt-3"></div>
                <h6 class="mb-0 text-uppercase">{{$prod_name}}</h6>
                
                <hr/>
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
                @endif
                @if(isset($success))
                    <div class="alert alert-success">
                        {{ $success }}
                    </div>
                @endif
                @if(request()->route('product_name') !== 'coworkspace_daily' && request()->route('product_name') !== 'coworkspace_weekly' && request()->route('product_name') !== 'coworkspace_monthly')
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('product_update', [request()->route('product_name')]) }}">
                  @csrf
                  @foreach($products as $product)
                  <div class="col-12">
                    <img src="/storage/{{$product->imgUrl}}"  id="img" alt="image" class="d-block img-fluid mb-3"  />
                    <label class="form-label">Image:</label>
                   <input type="file" class="form-label" name="prodImg" id = "prodImg"/>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Total Slots</label>
                    <input type="number" class="form-control" name="total_slots" value="{{$product->total_slots}}">
                  </div>
                  @if(request()->route('product_name') !== 'coworkspace')
                  <div class="col-12">
                    <label class="form-label">Price</label>
                    <input type="text"  class="form-control" name="price" value="{{$product->price}}">
                  </div>
                  @endif
                  @endforeach
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                  </div>
                </form>


                @else


                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('product_update', [request()->route('product_name')]) }}">
                  @csrf
                  @foreach($products as $product)
                  <div class="col-12">
                    <label class="form-label">Price</label>
                    <input type="text"  class="form-control" name="price" value="{{$product->price}}">
                  </div>
                  @endforeach
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                  </div>
                </form>
                @endif








                </div>

  
            </main>
         <!--end page main-->

        


@endsection
