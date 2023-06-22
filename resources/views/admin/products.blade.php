@php
  use App\Models\Variations;
@endphp
@extends('admin.layout')
<script src="{{ URL::to('admin/js/jquery.min.js')}}"></script>
@section('viewTruck')


<!--start content-->
<main class="page-content">
              
  
<div class="col-12 col-lg-10 col-xl-10 d-flex mx-auto">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0">Products</h6>
                      <div class="fs-5 ms-auto dropdown">
                         <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                           
                       </div>
                     </div>
                     <div class="table-responsive mt-2">
                      <table class="table align-middle mb-0">
                        <thead class="table-light">
                        <tr class="text-center">
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Total Slots</th>
                            <th>Open on Saturday</th>
                            <th>Open on Sunday</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                          <!-- <td colspan = 6 class="text-center">No record found</td> -->
                          @php
                          $i = 1;
                          @endphp
                          @foreach($products as $product)
                          <tr class="text-center">
                          <td>{{$i}}</td>
                            @php
                              $i++;
                            @endphp
                            <td>{{$product->name}}</td>
                            <td>{{$product->total_slots}}</td>
                            <td>{{($product->open_saturday) ? 'Yes' : 'No'}}</td>
                            <td>{{($product->open_sunday) ? 'Yes' : 'No'}}</td>
                            <td>
                              <div class="d-flex justify-content-center fs-6 gap-3 ms-3">
                                <a href="javascript:;" class="text-dark" data-bs-toggle="modal" data-bs-target="#viewProduct{{$product->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal" data-bs-target="#viewTruck"><i class="bi bi-eye-fill"></i></a>
                                 <!-- Modal -->
                                 <div class="modal fade" id="viewProduct{{$product->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Product: {{$product->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="col-md-8 col-lg-5 mx-auto">
                                          <div class="mt-5"></div>
                                          <img src="/storage/{{$product->imgUrl}}"  id="img" alt="image" class="d-block mb-3" style="height: 200px;width:200px;" />
                                          <div class="table-responsive mt-2">
                                            <table class="table align-middle mb-0">
                                              <thead class="table-light">
                                                <tr class="text-center">
                                                  <th></th>
                                                  <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr class="text-center">
                                                  <td>Category</td>
                                                  <td>{{$product->name}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Total Slots</td>
                                                  <td>{{$product->total_slots}}</td>
                                                </tr>
                                                <!-- <tr class="text-center">
                                                  <td>Available Slots Today</td>
                                                  <td>
                                                   
                                                  </td>
                                                </tr> -->
                                                <tr class="text-center">
                                                  <td>Open on Saturday</td>
                                                  <td>{{($product->open_saturday) ? 'Yes' : 'No'}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Open on Saturday</td>
                                                  <td>{{($product->open_sunday) ? 'Yes' : 'No'}}</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            @php
                                              $vars = Variations::where(['product_id' => $product->id])->get();
                                            @endphp

                                            @if($vars->count() > 0)
                                            <h2 class="mt-5">Variations</h2>
                                            <table class="table align-middle mb-0">
                                              <thead class="table-light">
                                                <thead>
                                                  <tr class="text-center">
                                                    <td>Type</td><td>Price</td>
                                                  </tr>
                                                </thead>
                                                @foreach($vars as $var)
                                                  <tr class="text-center"><td>{{$var->variation_type}}</td><td>#{{number_format($var->price)}}</td></tr>
                                                @endforeach
                                              </table>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>      
                              
                              <a href="javascript:;" class="text-warning" data-bs-toggle="modal" data-bs-target="#editProduct{{$product->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal"><i class="bi bi-pencil-fill"></i></a>
                                <!-- Modal -->
                                <div class="modal fade " id="editProduct{{$product->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <div class="col-md-8 col-lg-5 mx-auto">
                                      <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                      </div>
                                        <div class="mt-5"></div>
                                        
                                        <form  method="post" id="update_form{{$product->id}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{$product->id}}">
                                            <div class="col-12 mb-2">
                                              <img src="/storage/{{$product->imgUrl}}" id="img{{$product->id}}" alt="image" class="d-block mb-3 img" style="height: 200px;width:200px;" />
                                              <label class="form-label float-start" >Image:</label>
                                              <input type="file" class="form-control prodImg" name="prodImg" id = "prodImg{{$product->id}}" />
                                              <script>
                                                $(function(){
                                                    $('#prodImg{{$product->id}}').change(function(){
                                                        var input = this;
                                                        var url = $(this).val();
                                                        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                                                        if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) 
                                                        {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                            $('#img{{$product->id}}').attr('src', e.target.result);
                                                            }
                                                        reader.readAsDataURL(input.files[0]);
                                                        }
                                                    });
                                                  });
                                              </script>
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Product Name</label>
                                              <input type="text"  class="form-control" name="product_name" id="product_name" value="{{$product->name}}"/>
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Slots</label>
                                              <input type="number" class="form-control" name="total_slots" id="total_slots" value="{{$product->total_slots}}"/>
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label">Open Saturday</label>
                                              <input type="checkbox" name="open_saturday" id="open_saturday" {{($product->open_saturday) ? 'checked' : ''}} />
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label">Open Sunday</label>
                                              <input type="checkbox" name="open_sunday" id="open_sunday" {{($product->open_sunday) ? 'checked' : ''}}/>
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
                                <a href="javascript:;" class="text-danger" onclick="deleteCategory({{$product->id}})"><i class="bi bi-trash-fill"></i></a>
                              </div>
                            </td>
                          </tr>
                          <script>
                            $(document).ready(function (e) {
                                $("#update_form{{$product->id}}").on('submit',(function(e) {
                                    e.preventDefault();
                                    swal({
                                            title: 'Are you sure?',
                                            text: 'You want to update this record',
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, update it!',
                                            cancelButtonText: 'No, cancel',
                                            confirmButtonClass: 'confirm-class',
                                            cancelButtonClass: 'cancel-class',

                                        })
                                        .then((isConfirm) => {
                                          if (isConfirm.value) {
                                              $.ajax({
                                                  type: 'POST',
                                                  url: "{{Route('update_category')}}",
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
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
                                                          swal({
                                                            title: 'Error!',
                                                            text: "",
                                                            type: 'warning',
                                                            showConfirmButton:false,
                                                            timer: 800,
                                                        });
                                                    $(".print-error-msg").find("ul").html('');
                                                    $(".print-error-msg").css('display','block');
                                                    $.each( response.error, function( key, value ) {
                                                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                                          });
                                                      }

                                                  },
                                                  error: function(xhr, status, error) {
                                                      alert(xhr.responseText);
                                                      // stopLoader('body');
                                                  }
                                              });
                                          }
                                      });

                                  }));
                            });

                          </script>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end row-->

            <div class="card-body offset-md-4 offset-2">
                    {{ $products->links() }}
                  </div>
                  <a href="javascript:;" class="text-center text-decoration-underline" data-bs-toggle="modal" data-bs-target="#addCategory" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal"><h6>&#43; Add New Category</h6></a>
                                <!-- Modal -->
                                <div class="modal fade " id="addCategory" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <div class="col-md-8 col-lg-5 mx-auto">
                                      <div class="alert alert-danger print-error-msg1" style="display:none">
                                        <ul></ul>
                                      </div>
                                        <div class="mt-5"></div>
                                        
                                        <form  method="post" id="add_form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-12 mb-2">
                                              <img src="/images/default.jpg"  id="img1" alt="image" class="d-block mb-3" style="height: 200px;width:200px;" />
                                              <label class="form-label float-start" >Image:</label>
                                              <input type="file" class="form-control" name="product_image" id = "product_image" />
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Product Name</label>
                                              <input type="text"  class="form-control" name="product_name" id="product_name" />
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label float-start">Slots</label>
                                              <input type="number" class="form-control" name="total_slots" id="total_slots" />
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label">Open Saturday</label>
                                              <input type="checkbox" name="open_saturday" id="open_saturday" />
                                            </div>
                                            <div class="col-12 mb-2">
                                              <label class="form-label">Open Sunday</label>
                                              <input type="checkbox" name="open_sunday" id="open_sunday" />
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
            </main>
         <!--end page main-->

         <script>
   function deleteCategory(id) {
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
                      type: 'GET',
                      url: '{{Route("delete_category")}}',
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



  $(document).ready(function (e) {
      $("#add_form").on('submit',(function(e) {
          e.preventDefault();
          swal({
                  title: 'Are you sure?',
                  text: 'You want to add this record',
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
                        url: "{{Route('add_category')}}",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
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
                                swal({
                                  title: 'Error!',
                                  text: "",
                                  type: 'warning',
                                  showConfirmButton:false,
                                  timer: 800,
                              });
                          $(".print-error-msg1").find("ul").html('');
                          $(".print-error-msg1").css('display','block');
                          $.each( response.error, function( key, value ) {
                              $(".print-error-msg1").find("ul").append('<li>'+value+'</li>');
                });
                            }

                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                            // stopLoader('body');
                        }
                    });
                }
            });

        }));
  });





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
