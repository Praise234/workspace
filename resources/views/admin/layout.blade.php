<!doctype html>
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

@yield('thecontent')
@yield('thelogin')
@yield('viewTruck')
@yield('addTruck')
@yield('addInc')
@yield('viewInc')
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
        $('#prodImg').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
                }
            reader.readAsDataURL(input.files[0]);
            }
        });

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


   