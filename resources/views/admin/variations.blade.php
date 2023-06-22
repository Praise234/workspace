@php
  use App\Models\Variations;
@endphp
@extends('admin.layout')

@section('viewTruck')


<!--start content-->
<main class="page-content">
              
  
  <div class="col-md-12 d-flex mx-auto">
    <form  method="post" id="update_form" class="mx-auto" method="post" action = "{{Route('variation_search')}}" >
      @csrf
      
      <div class="col-md-12 d-flex gap-3 mt-3 mb-2">
        <label class="form-label">Product Name</label>
        <select name="products" class="form-control" id="products">
          @foreach($products as $product)
              <option value="{{$product->id}}" {{($product->id == old('products')) ? 'selected' : ''}}>{{$product->name}}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
  </div>

  @if(!empty($variations))
  
  
  <div class="col-md-7  d-flex mx-auto mt-4">     
    <div class="card radius-10 w-100">
      <div class="card-body">
        
        <div class="table-responsive mt-2">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr class="text-center">
                <th>#ID</th>
                <th>Type</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <!-- <td colspan = 6 class="text-center">No record found</td> -->
              @php
              $i = 1;
              @endphp
              
                @if($variations->count() > 0)
                          @foreach($variations as $variation)
                          <tr class="text-center">
                            <td>{{$i}}</td>
                            @php
                              $i++;
                            @endphp
                            <td>{{strtoupper($variation->variation_type)}}</td>
                            <td>#{{number_format($variation->price)}}</td>
                            <td>
                              <div class="d-flex justify-content-center fs-6 gap-3 ms-3">
                                
                              
                              <a href="javascript:;" class="text-warning" data-bs-toggle="modal" data-bs-target="#editVariation{{$variation->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal"><i class="bi bi-pencil-fill"></i></a>
                                <!-- Modal -->
                                <div class="modal fade " id="editVariation{{$variation->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Edit Variation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="col-md-8 col-lg-5 mx-auto">
                                          <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                          </div>
                                        <div class="mt-5"></div>
                                        
                                        <form  method="post" onsubmit = "updateVariation(event, {{$variation->id}})" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id{{$variation->id}}" value="{{$variation->id}}">
                                            
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Variation Type</label>
                                              <select name="variation_type" class="form-control" id="variation_type{{$variation->id}}">
                                                  <option value="hourly" {{($variation->variation_type == "hourly") ? 'selected' : ''}}>Hourly</option>
                                                  <option value="daily" {{($variation->variation_type == "daily") ? 'selected' : ''}}>Daily</option>
                                                  <option value="weekly" {{($variation->variation_type == "weekly") ? 'selected' : ''}}>Weekly</option>
                                                  <option value="monthly" {{($variation->variation_type == "monthly") ? 'selected' : ''}}>Monthly</option>
                                              </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Price</label>
                                              <input type="number" class="form-control" name="price" id="price{{$variation->id}}" value="{{$variation->price}}"/>
                                            </div>
                                            
                                            <div class="col-12">
                                              <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                      
                                      
                                    </div>
                                  </div>
                                </div>
                                <a href="javascript:;" class="text-danger" onclick="deleteVariation({{$variation->id}})"><i class="bi bi-trash-fill"></i></a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr class="text-center">
                          
                            <td colspan = "4">There are no variations yet.</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              @if($variations->count() < 4)
                <div class="col-12 text-center h6" id="add_new_var"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addVariation" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal" class="text-center text-decoration-underline">&#43; add new variation</a></div>
                
                  <!-- Modal -->
                  <div class="modal fade " id="addVariation" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Variation</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="col-md-8 col-lg-5 mx-auto">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                              <ul></ul>
                            </div>
                          <div class="mt-5"></div>
                          
                          <form  method="post" onsubmit="addVariation(event)">
                              @csrf
                              <input type="hidden" name="product_id" id="product_id" value="{{$product_id}}">
                              
                              <div class="col-12 mb-2">
                                <label class="form-label float-start">Variation Type</label>
                                <select name="add_variation_type" class="form-control" id="add_variation_type">
                                    <option value="hourly">Hourly</option>
                                    <option value="daily" >Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                              </div>
                              <div class="col-12 mb-2">
                                <label class="form-label float-start">Price</label>
                                <input type="number" class="form-control" name="add_price" id="add_price" value=""/>
                              </div>
                              
                              <div class="col-12">
                                <div class="d-grid">
                                  <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
         
          </div>
        @endif
              @endif
     
 
  

  

  </main>
      
<script>
   function deleteVariation(id) {
      swal({
              title: 'Are you sure?',
              text: 'You will not be able to recover the record',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel',
              confirmButtonClass: 'confirm-class',
              cancelButtonClass: 'cancel-class',

          })
          .then((isConfirm) => {
              if (isConfirm.value) {
                  $.ajax({
                      type: 'POST',
                      url: '{{Route("delete_variation")}}',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          'id': id,
                      },
                      beforeSend: function() {
                          swal({
                              title: 'Processing...',
                              allowEscapeKey: false,
                              allowOutsideClick: false,
                              onOpen: () => {
                                  swal.showLoading();
                              }
                          });
                      },

                      success: function(response) {

                          if (response.status == 1) {
                              swal("Success!", response.message, "success").then(function() {
                                  location.reload();
                              });

                          } else {
                              swal("Error!", response.error, "error")
                          }

                      },
                      error: function(xhr, status, error) {
                          alert(xhr.responseText);
                          // stopLoader('body');
                      }
                  });
              }
          });

}


function addVariation(e) {
  e.preventDefault();
  let variation_type = document.getElementById('add_variation_type').value;
  let price = document.getElementById('add_price').value;
  let product_id = document.getElementById('product_id').value;

      swal({
              title: 'Are you sure?',
              text: 'You want to add new variation',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, add it!',
              cancelButtonText: 'No, cancel',
              confirmButtonClass: 'confirm-class',
              cancelButtonClass: 'cancel-class',

          })
          .then((isConfirm) => {
              if (isConfirm.value) {
                  $.ajax({
                      type: 'POST',
                      url: '{{Route("add_variation")}}',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          'variation_type': variation_type,
                          'price': price,
                          'product_id': product_id,
                      },
                      beforeSend: function() {
                          swal({
                              title: 'Processing...',
                              allowEscapeKey: false,
                              allowOutsideClick: false,
                              onOpen: () => {
                                  swal.showLoading();
                              }
                          });
                      },

                      success: function(response) {


                          if (response.status == 1) {
                              swal("Success!", response.message, "success").then(function() {
                                  location.reload();
                              });

                          } else {
                              printErrorMsg(response.error);
                          }

                      },
                      error: function(xhr, status, error) {
                          alert(xhr.responseText);
                          // stopLoader('body');
                      }
                  });
              }
          });

}
function updateVariation(e, id) {
  e.preventDefault();
  let variation_type = document.getElementById('variation_type' + id).value;
  let price = document.getElementById('price' + id).value;
  let product_id = document.getElementById('product_id').value;

      swal({
              title: 'Are you sure?',
              text: 'You want to add new variation',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, add it!',
              cancelButtonText: 'No, cancel',
              confirmButtonClass: 'confirm-class',
              cancelButtonClass: 'cancel-class',

          })
          .then((isConfirm) => {
              if (isConfirm.value) {
                  $.ajax({
                      type: 'POST',
                      url: '{{Route("update_variation")}}',
                      data: {
                          "_token": "{{ csrf_token() }}",
                          'variation_type': variation_type,
                          'price': price,
                          'id': id,
                          'product_id': product_id,
                      },
                      beforeSend: function() {
                          swal({
                              title: 'Processing...',
                              allowEscapeKey: false,
                              allowOutsideClick: false,
                              onOpen: () => {
                                  swal.showLoading();
                              }
                          });
                      },

                      success: function(response) {


                          if (response.status == 1) {
                              swal("Success!", response.message, "success").then(function() {
                                  location.reload();
                              });

                          } else {
                              printErrorMsg(response.error);
                          }

                      },
                      error: function(xhr, status, error) {
                          alert(xhr.responseText);
                          // stopLoader('body');
                      }
                  });
              }
          });

}

function printErrorMsg (msg) {
      swal({
              title: 'Error!',
              text: "",
              type: 'warning',
              showConfirmButton:false,
              timer: 800,
          });
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
  }
</script>

@endsection
