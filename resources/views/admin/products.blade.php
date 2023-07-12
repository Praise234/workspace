@php
  use App\Models\Variations;
@endphp

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::to('admin/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{ URL::to('admin/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/plugins/fancy-file-uploader/fancy_fileupload.css')}}" rel="stylesheet" />
	<link href="{{ URL::to('admin/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ URL::to('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/bootstrap-extended.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/style.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- datatables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> -->
    <!-- loader-->
    <link href="{{ URL::to('admin/css/pace.min.css')}}" rel="stylesheet" />
    
    <!--Theme Styles-->
    <link href="{{ URL::to('admin/css/dark-theme.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/light-theme.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/semi-dark.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('admin/css/header-colors.css')}}" rel="stylesheet" />
    
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link>  
    
    <script src="{{ URL::to('admin/js/jquery.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/p6ais1ohum70fwrl1stnx5uytpoe4eeakdll6vezo5ml2jbr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Shecluded - Coworkpace - Admin</title>
</head>
<body>
  
        <header class="top-header2">
            <nav class="navbar">
                

                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav">
                        
                        @if(Session::has('user'))
                        <li>
                            <a class="dropdown-item" href="{{Route('logout')}}">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="bi bi-lock-fill"></i></div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
<!--end top header-->


<!--start sidebar -->
@if(Session::has('user'))
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ URL::to('images/logo.png')}}" class="img-fluid" alt="logo icon">
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ URL::to('administrator/confirm_booking')}}" class="menu-label mt-3">
                        <div class="parent-icon"><i class="bi bi-book"></i>
                        </div>
                        <div class="menu-title">Confirm Booking</div>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('administrator/categories/')}}" class="menu-label mt-3">
                        <div class="parent-icon"><i class="bi bi-laptop"></i>
                        </div>
                        <div class="menu-title">Categories</div>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('administrator/show_variations/')}}" class="menu-label mt-3">
                        <div class="parent-icon"><i class="bi bi-laptop"></i>
                        </div>
                        <div class="menu-title">Variations</div>
                    </a>
                </li>              
                <li>
                    <a href="{{ URL::to('administrator/unavailable')}}" class="menu-label mt-3">
                        <div class="parent-icon"><i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="menu-title">Unavailable Days</div>
                    </a>
                </li> 
               
            </ul>
            <!--end navigation-->
        </aside>

<!--end sidebar -->
@endif

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
                                                <tr class="text-center">
                                                  <td>Other Details</td>
                                                  <td>{!!html_entity_decode($product->other_details)!!}</td>
                                                </tr>
                                                
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
                                              <label class="form-label ">Other Details</label>
                                              <textarea id="update_editor{{$product->id}}" name="other_details_update">{{$product->other_details}}</textarea>
                                            </div>
                                            <script>
                                              tinymce.init({
                                                  selector:'#update_editor{{$product->id}}',
                                                  menubar: false,
                                                 
                                              });
                                            </script>
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
                                              <label class="form-label ">Other Details</label>
                                              <textarea id="add_editor" name="other_details_add"></textarea>
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

<script>
        tinymce.init({
            selector:'#add_editor',
            menubar: false,
            
        });



    </script>


</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
<!-- Bootstrap bundle JS -->
<script src="{{ URL::to('admin/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ URL::to('admin/js/jquery.min.js')}}"></script>
<script src="{{ URL::to('admin/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ URL::to('admin/plugins/metismenu/js/metisMenu.min.js')}}"></script>

<script src="{{ URL::to('admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ URL::to('admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ URL::to('admin/js/pace.min.js')}}"></script>
<script src="{{ URL::to('admin/plugins/fancy-file-uploader/jquery.ui.widget.js')}}"></script>
<script src="{{ URL::to('admin/plugins/fancy-file-uploader/jquery.fileupload.js')}}"></script>
<script src="{{ URL::to('admin/plugins/fancy-file-uploader/jquery.iframe-transport.js')}}"></script>
<script src="{{ URL::to('admin/plugins/fancy-file-uploader/jquery.fancy-fileupload.js')}}"></script>
<script src="{{ URL::to('admin/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
<script src="{{ URL::to('admin/js/form-file-upload.js')}}"></script>
<!--app-->
<script src="{{ URL::to('admin/js/app.js')}}"></script>



<!-- datatables -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script src="{{ URL::to('admin/js/buttons.html5.js')}}"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script> 

<script>
    $(function(){
        

        $('#product_image').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                $('#img1').attr('src', e.target.result);
                }
            reader.readAsDataURL(input.files[0]);
            }
        });

    });
</script>


</html>

