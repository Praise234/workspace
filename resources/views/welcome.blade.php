@php
  use App\Models\Variations;
@endphp
<!doctype html>
<html lang="en">
	<head>
       
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Shecluded - Co Workspace</title>
	    <meta name="description" content="" />
	    <meta name="keywords" content="" />
	    <meta name="author" content= "" />
	    <meta name="website" content="" />
	    <meta name="email" content="" />
	    <meta name="version" content="" />
	    <!-- favicon -->
        <link href="images/favicon.ico" rel="shortcut icon">
		<!-- Bootstrap core CSS -->
	    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	    <link href="css/tobii.min.css" type="text/css" rel="stylesheet" />
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Playfair Display' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'></link> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	   
        <!-- Custom  Css -->
	    <link href="css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <style>
            #imgg{
                height: 250px;
                width: 300px;
               }
               #home{
                    background: url('storage/{{$coworkspace[0]->imgUrl}}') center center;
                    background-size: auto;
                }
            a:hover{
                    text-decoration: underline;
                }
            @media (max-width: 600px) { 
               #imgg{
                height: 200px;
                width: 250px;
               }
                
            }
            
        </style>
	</head>

	<body>
        <!-- START NAVBAR -->
        <nav id="navbar" class="navbar navbar-expand-lg nav-light fixed-top sticky">
            <div class="container">
                <a class="navbar-brand" href="">
                    <span class="logo-light-mode">
                        <img src="images/logo-light.png" class="l-light" width = "200px" alt="">
                        <img src="images/logo.png" class="l-dark" width = "200px" alt="">
                    </span>
                    <img src="images/logo-light.png" class="logo-dark-mode" alt="">
                </a>
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i data-feather="menu"></i>
                </button> -->

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-navlist">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#space">Book a Space</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact Us</a>
                        </li>
                    </ul>
                </div> -->
                <!--end collapse-->
            </div>
            <!--end container-->
        </nav>
        <!-- END NAVBAR -->

        <!-- Start Hero -->
        <section class="bg-half-170 d-table w-100" id="home">
            <div class="bg-overlay d-md-block"></div>
            <div class="container">
                   
                <div class="row  ">
                    <div class="col-xl-7 col-lg-7 col-md-6 justify-content-start text-white">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <!-- <h1>Shecluded Hub:</h1> -->
                            <span id="trans"><p style="font-size: 3.2em;line-height:1.3em;font-family: Playfair Display;">A Space where <span style="color:#EB2590;">Productivity</span> meets <span style="color:#EB2590;">Community</span>.</p></span>
                            <p style="font-family: Lato; font-size: 1.2em;">Shecluded Hub is more than just a co-working space - it's a movement. From our workspace options to our community events, we've designed our co-working space for women to come together, collaborate, and create amazing things.</p>

                        </div>  
                    </div>
                    
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div class="card shadow rounded-md border-0 ms-xl-5">
                            <div class="card-body">
                                <h4 class="card-title text-center">Book a spot in <span style="color:#EB2590;">Shecluded Hub</span></h4>

                                <form class="login-form mt-4" method="post" action="{{Route('book_coworkspace_page')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">                                               
                                                <label class="form-label fs-6">Date <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <input type="date" onchange="returnCheck()" min = "{{date('Y-m-d', strtotime('now'))}}" class="form-control" name="booking_date" id="booking_date" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label fs-6">Plan <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <select onchange="returnCheck()" name="plan" id="plan" class="form-control" required="">
                                                    @php
                                                        $variations = Variations::where(['product_id' => $coworkspace[0]->id])->get();
                                                    @endphp
                                                    @foreach($variations as $variation)
                                                    <option value="{{$variation->variation_type}}">{{ucfirst($variation->variation_type)}} (#{{number_format($variation->price)}})</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label fs-6">No of seats <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <input type="number" onchange="returnCheck()" class="form-control" name="no_of_seats" id="no_of_seats" placeholder="No of seats" value="1" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        
                                        
                                        <div class="col-md-12 text-center">
                                            <div style="display:none;" id="successcoworkspace">
                                                <p class="text-success" id="success"></p>
                                            </div>
                                            <div style="display:none;" id="errorcoworkspace">
                                                <p class="text-danger" id="error"></p>
                                            </div>
                                            <div style="display:grid;" id="checkcoworkspace">
                                                <button class="btn btn-primary btn-pills border-0">Check Availability</button>
                                            </div>
                                            <div style="display:none;" id="bookcoworkspace" data-bs-toggle="modal" 
                                            data-bs-target="#co" title="" data-bs-original-title="co" aria-label="co"  data-bs-toggle="modal">
                                                <button class="btn btn-primary btn-pills border-0">Book</button>
                                            </div>
                                            <div class="spinner-border mt-2" style="display:none;" role="status" id="loadingcoworkspace">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form><!--end form-->
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End Hero -->

       

        <!-- Start -->
        <section class="section" id="space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12 mb-4 pb-2">
                        <div class="section-title text-center">
                            <h2 class="title mb-4" style="font-family: Playfair Display;">Pricing</h2>
                            <!-- <p class="para-desc mx-auto mb-0" style="color: #FF7733">Private offices, Board Room, Virtual Office, Children Playroom or host your events in our space .</p> --> 
                            <p class="para-desc mx-auto mb-0" style="color: rgba(60,60,60, 1);font-size: 1em;font-family: Playfair Display;font-weight: bold;">We have designed our pricing plans to be flexible and affordable, to meet your unique needs.
                             <br /> Book a space with us!</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

               
                <div class="row position-relative z-index-1">
                    @foreach($products as $product)
                    @php
                        $variations = Variations::where(['product_id' => $product->id])->get();
                    @endphp
                    @if($variations->count() > 0)
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="pricing pricing-primary shadow rounded-md text-center bg-white">
                            <div class="border-bottom p-4">
                                <img src="storage/{{$product->imgUrl}}" alt=""  id="imgg" />
                            </div>

                            <div class="p-4 text-start">
                                <h5 class="text-pink">{{ucwords($product->name)}}:</h5>

                                <ul class="list-unstyled mb-0 ps-0">

                                @foreach($variations as $variation)
                                    <li class="text-muted mb-0"><span class="icon h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>{{ucfirst($variation->variation_type)}} (#{{number_format($variation->price)}})</li>
                                @endforeach
                                    
                                    
                                </ul>
                                
                                <a href="" class="btn btn-primary btn-pills border-0 w-100 mt-4" id="bookspace{{$product->id}}" data-bs-toggle="modal" 
                                            data-bs-target="#modal{{$product->id}}" title="{{$product->name}}" data-bs-original-title="{{$product->name}}" aria-label="{{$product->name}}"  data-bs-toggle="modal">Book</a>
                                          
                            </div>
                        </div>
                    </div><!--end col-->
                    @endif
                    @endforeach

                    
                    
                    
                    
                    
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->














         <!-- Start -->
         <section class="section" style="background-color:#FFC95C;" id="contact">
            <div class="container">
                
                <div class="row align-items-center">
                    <div class="col-12 mt-4 pt-2">
                        <video height="540" class="row align-items-center" style="margin:auto;" controls>
                            <source src="/videos/Shecluded Hub.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->





























       

        <!-- Start -->
        <section class="section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 mb-4 pb-2">
                        <div class="section-title text-center">
                            <h2 class="title mb-4" style="font-family: Playfair Display;">Contact Us</h2>
                            <p class="para-desc mx-auto mb-0" style="color: rgba(60,60,60,1);font-size: 1em;font-family: Playfair Display;font-weight: bold;">Having issues booking? Get in touch!</p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row align-items-center">
                    <div class="col-12 mt-4 pt-2">
                        <form method="post" id="myForm" name="myForm" method="POST" action="{{Route('send_mail')}}">
                            @csrf
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        {{session('success')}}
                                    </div>
                                @endif
                               
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Name :">
                                            </div>
                                        </div>
        
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Email :">
                                            </div> 
                                        </div><!--end col-->
        
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <input name="subject" id="subject" class="form-control" placeholder="Subject :">
                                            </div>
                                        </div><!--end col-->
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <textarea name="message" id="comments" rows="4" class="form-control" placeholder="Message :"></textarea>
                                    </div>
                                </div>
                            </div><!--end row-->

                            <div class="row justify-content-end">
                                <div class="col-12 text-end">
                                    <button type="submit" id="submit" name="send" class="btn btn-primary btn-pills border-0">Send Message</button>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->


        <!--Google map-->
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
            <iframe src="https://maps.google.com/maps?q=8 The Rock Drive, Lekki Phase 1&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
        </div>

        <!--Google Maps-->

        <!-- Start Footer -->
        <!-- <footer class=" footer-bar bg-dark">
            <div class="footer-py-30">
                <div class="container text-center">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="text-sm-start">
                                <a href="#" class="logo-footer">
                                    <img src="images/logo.png" alt="" width="200px">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-lg-end">
                                <p class="text-white h5">© <script>document.write(new Date().getFullYear())</script> Shecluded.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer> -->
        <!--end footer-->
        <!-- End Footer -->



















        
        <!-- start footer -->
        <footer class=" footer-bar" style="background-color: #000;">
            <div class="footer-py-30 ">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-2 col-md-6">
                            <div class="widget about-widget">
                                <div class="footer-logo">
                                    <img src="images/logo-light.png" alt style="width:200px;">
                                </div>
                                
                                
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 col-lg-3 text-center">
                            <div class="widget donate-widget">
                                <h4 class="widget-title text-white">Who We Are</h4>
                                <ul class = "list-unstyled ">
                                    <li class ="p-2"><a href="https://shecluded.com/about" class="text-white link">About Us</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/about" class="text-white link">What we do</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/about" class="text-white link">Who we serve</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/about" class="text-white link">Our Services</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 col-lg-2 text-center">
                            <div class="widget action-widget">
                                <h4 class="widget-title text-white">Support</h4>
                                <ul class = "list-unstyled">
                                    <li class ="p-2"><a href="https://shecluded.com/faq" class="text-white link">FAQs</a></li>
                                    <li class ="p-2"><a href="https://t.me/+DJAseXicKRRiYijRk" class="text-white link">Community</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/contact" class="text-white link">Contact Us</a></li>
                                    <li class ="p-2"><br /></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 col-lg-2 text-center ">
                            <div class="widget action-widget">
                                <h4 class="widget-title text-white">Legal</h4>
                                <ul class = "list-unstyled">
                                    <li class ="p-2"><a href="https://shecluded.com/terms" class="text-white link">Cookies Policy</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/terms" class="text-white link">Privacy Policy</a></li>
                                    <li class ="p-2"><a href="https://shecluded.com/terms" class="text-white link">Terms of Service</a></li>
                                    <li class ="p-2"><br /></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="widget action-widget">
                            <p class="widget-title h6 mx-auto">Connect with us</p>
                                <ul class = "list-unstyled social-links d-flex">
                                    <li class ="p-2 m-1 text-center" style="background-color: #eb2590;border-radius: 60px;width:40px;" ><a href="https://instagram.com/shecluded" target="_blank"><i class="fa fa-instagram text-white"></i></a></li>
                                    <li class ="p-2 m-1 text-center" style="background-color: #eb2590;border-radius: 60px;width:40px;" ><a href="https://twitter.com/shecluded" target="_blank"><i class="fa fa-twitter text-white"></i></a></li>
                                    <li class ="p-2 m-1 text-center" style="background-color: #eb2590;border-radius: 60px;width:40px;" ><a href="https://www.youtube.com/channel/UCw-HgPM7ZkveoxnYuths-LQ" target="_blank" ><i class="fa fa-youtube text-white"></i></a></li>
                                    <li class ="p-2 m-1 text-center" style="background-color: #eb2590;border-radius: 60px;width:40px;" ><a href="https://www.linkedin.com/company/shecluded/" target="_blank"><i class="fa fa-linkedin text-white"></i></a></li>
                                </ul>
                                <br />
                                <br />
                                <br />
                                <br />
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end container -->
                <hr class="col-md-9 mx-auto"/>
                <div class="col-md-9 mx-auto">
                    <div>
                        <p class="text-white ">Copyright <script>document.write(new Date().getFullYear())</script> Shecluded Solutions Ltd.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->



































        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top rounded-pill fs-5"><i data-feather="arrow-up" class="fea icon-sm icons align-middle"></i></a>
        <!-- Back to top -->

        <!-- JAVASCRIPTS -->
	    <script src="js/bootstrap.bundle.min.js"></script>
	    <script src="js/gumshoe.js"></script>
	    <script src="js/tobii.min.js"></script>
	    <script src="js/contact.js"></script>
        <script src="js/feather.min.js"></script>
	    <!-- Custom -->
	    <script src="js/plugins.init.js"></script>
	    <script src="js/app.js"></script>

        <script src="js/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 500, function(){
            

                });
                } // End if
            });
        });
    </script>
      <script>
            document.getElementById("checkcoworkspace").addEventListener('click', function (event) {
                event.preventDefault();
               
                $.ajax({
                        type: 'GET',
                        url: '{{Route("check_coworkspace_availability")}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'booking_date': $('#booking_date').val(),
                            'plan': $('#plan').val(),
                            'product': "coworkspace",
                            'booking_time': $('#booking_time').val(),
                            'no_of_seats': $('#no_of_seats').val(),
                            'id': {{$coworkspace[0]->id}},
                        },
                        beforeSend: function() {
                            $('#errorcoworkspace').hide();
                            $("#bookcoworkspace").hide();
                            $('#checkcoworkspace').hide()
                            $("#loadingcoworkspace").show();
                        },

                        success: function(response) {
                            $("#loadingcoworkspace").hide();
                            if (response.status == 1) {
                                $("#bookcoworkspace").css('display', "grid");
                                $('#checkcoworkspace').hide()
                                $("#loadingcoworkspace").hide();
                            } else if(response.status == 404){
                                $("#error").html(response.error);
                                $('#errorcoworkspace').show();
                                $('#checkcoworkspace').hide()
                                $("#bookcoworkspace").css('display', "grid");
                                $("#loadingcoworkspace").hide();
                            }else {
                                $("#error").html(response.error);
                                $('#errorcoworkspace').show();
                                $("#loadingcoworkspace").hide();
                                $('#checkcoworkspace').css('display', "grid");
                            }

                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                            // stopLoader('body');
                        }
                    });
            });
            function returnCheck(){
                $('#successcoworkspace').hide();
                $('#errorcoworkspace').hide();
                $("#bookcoworkspace").hide();
                $("#checkcoworkspace").css('display', "grid");
            }

            document.getElementById("bookcoworkspace").addEventListener('click', function (event) {
                event.preventDefault();
                $('#booking_date_modal').val($('#booking_date').val());
                $('#plan_modal').val($('#plan').val());
                $('#no_of_seats_modal').val($('#no_of_seats').val());
                $('#errorcoworkspace_modal').hide();
                $("#book_now_modal").css('display', "grid");
            });

            function availabilityCheck(){
               
                $.ajax({
                        type: 'GET',
                        url: '{{Route("check_coworkspace_availability")}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'booking_date': $('#booking_date_modal').val(),
                            'plan': $('#plan_modal').val(),
                            'product': "coworkspace",
                            'booking_time': $('#booking_time_modal').val(),
                            'no_of_seats': $('#no_of_seats_modal').val(),
                            'id': {{$coworkspace[0]->id}},
                        },
                        beforeSend: function() {
                            $('#errorcoworkspace_modal').hide();
                            $("#book_now_modal").hide();
                            $("#loadingcoworkspace_modal").show();
                        },

                        success: function(response) {
                            $("#loadingcoworkspace").hide();
                            if (response.status == 1) {
                                $("#book_now_modal").css('display', "grid");
                                $("#loadingcoworkspace_modal").hide();
                            } else if(response.status == 404){
                                $("#error_modal").html(response.error);
                                $('#errorcoworkspace_modal').show();
                                $("#book_now_modal").css('display', "grid");
                                $("#loadingcoworkspace_modal").hide();
                            }else {
                                $("#error_modal").html(response.error);
                                $('#errorcoworkspace_modal').show();
                                $("#loadingcoworkspace_modal").hide();
                            }

                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                            // stopLoader('body');
                        }
                    });
            }
            function bookNow(e){
              	e.preventDefault();
                if(document.getElementById("cus_name_modal").value.trim() == ""){
                    $("#error_modal").html("Please enter your name");
                            $('#errorcoworkspace_modal').show();
                            return false;
                }else if(document.getElementById("cus_email_modal").value.trim() == ""){
                    $("#error_modal").html("Please enter your email");
                            $('#errorcoworkspace_modal').show();
                            return false;
                }
                $('#errorcoworkspace_modal').hide();


                let amn = 0;
                $.ajax({
                            type: 'GET',
                            url: '{{Route("get_category_details")}}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'plan': $('#plan_modal').val(),
                                'id': {{$coworkspace[0]->id}},
                                
                            },
                            
                            success: function(response) {
                                
                                if(response.status == 1){
                                    amn = response.message;
                                if(amn == 0){

                            swal({
                                title: '',
                                text: 'Ensure that your details are correct',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Book!',
                                cancelButtonText: 'No, cancel',
                                confirmButtonClass: 'confirm-class',
                                cancelButtonClass: 'cancel-class',

                            })
                            .then((isConfirm) => {
                                if (isConfirm.value) {
                                    $.ajax({
                                        type: 'GET',
                                        url: '{{Route("book_free_now")}}',
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            'booking_date': $('#booking_date_modal').val(),
                                            'booking_time': $('#booking_time_modal').val(),
                                            'plan': $('#plan_modal').val(),
                                            'product': "Coworkspace",
                                            'duration': $('#plan_modal').val(),
                                            'no_of_seats': $('#no_of_seats_modal').val(),
                                            'cus_name': $('#cus_name_modal').val().trim(),
                                            'cus_email': $('#cus_email_modal').val().trim(),
                                            
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
                                            document.getElementById("form").reset();
                                            if(response.status == 1){
                                                swal("Success!", response.message, "success").then(function() {
                                                    location.reload();
                                                });

                                            }else{
                                                console.log(response);
                                            }
                                            
                                        },
                                        error: function(xhr, status, error) {
                                            alert(xhr.responseText);
                                            // stopLoader('body');
                                        }
                                    });
                                }
                            });


                }else{
                              
                
                
                let handler = PaystackPop.setup({
                    key: '{{$_ENV['LIVE_PUBLIC_KEY']}}', // Replace with your public key
                    email: document.getElementById("cus_email_modal").value,
                    amount:  $('#no_of_seats_modal').val() * amn * 100,
                    currency: 'NGN',
                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    label: "Shecluded",
                    // onClose: function(){
                    // alert('Window closed.');
                    // },
                    callback: function(response){
                        
                    // let message = 'Payment complete! Reference: ' + response.reference;
                    // alert(message);
                    $.ajax({
                            type: 'GET',
                            url: '{{Route("book_now")}}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'booking_date': $('#booking_date_modal').val(),
                                'booking_time': $('#booking_time_modal').val(),
                                'plan': $('#plan_modal').val(),
                                'product': "Coworkspace",
                                'duration': $('#plan_modal').val(),
                                'no_of_seats': $('#no_of_seats_modal').val(),
                                'cus_name': $('#cus_name_modal').val().trim(),
                                'cus_email': $('#cus_email_modal').val().trim(),
                                'reference': response.reference,
                            },
                            
                            success: function(response) {
                                document.getElementById("form").reset();
                                if(response == "success"){
                                    
                                    alert('Payment Successful! Please visit our center for the next line of action.')
                                    location.reload();
                                }else{
                                    alert(response);
                                }
                                
                            },
                            error: function(xhr, status, error) {
                                alert(xhr.responseText);
                                // stopLoader('body');
                            }
                        });
                    }
                });

                handler.openIframe();
            }
                }else{
                    alert(response);
                }
                
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                        // stopLoader('body');
                    }
                });
            }
        </script>
          <!-- Modal -->
        <div class="modal fade" id="co" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Book a space</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-8 col-lg-5 mx-auto">
                            <div class="mt-5"></div>
                            <div style="display:none; text-align:center; font-weight:bold;" id="errorcoworkspace_modal">
                                <p class="text-danger" id="error_modal"></p>
                            </div>
                                            
                            <form class="row g-3" method="post" action="" id="form" onsubmit="bookNow(event)">
                                @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label fs-6">Name <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input type="text" class="form-control" name="cus_name" id="cus_name_modal" placeholder="Your Name" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label fs-6">Email <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input type="email" class="form-control" name="cus_email" id="cus_email_modal" placeholder="Your Email" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">                                               
                                        <label class="form-label fs-6">Date <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input type="date" onchange="availabilityCheck()" min = "{{date('Y-m-d', strtotime('now'))}}" class="form-control" name="booking_date" id="booking_date_modal" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label fs-6">Plan <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <select name="plan" onchange="availabilityCheck()" id="plan_modal" class="form-control" required="">
                                                @php
                                                    $variations = Variations::where(['product_id' => $coworkspace[0]->id])->get();
                                                @endphp
                                                @foreach($variations as $variation)
                                                    <option value="{{$variation->variation_type}}">{{ucfirst($variation->variation_type)}} (#{{number_format($variation->price)}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label fs-6">No of seats <span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input type="number" onfocusout="availabilityCheck()" onchange="availabilityCheck()" class="form-control" name="no_of_seats" id="no_of_seats_modal" placeholder="No of seats" value="1" required="">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="modal-footer">
                                
                                    <div class="spinner-border mt-2" style="display:none;" role="status" id="loadingcoworkspace_modal">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="book_now_modal">Book Now</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
        @foreach($products as $product)
            @php
                $variations = Variations::where(['product_id' => $product->id])->get();
            @endphp
            @if($variations->count() > 0)
            <!-- Modal -->
            <div class="modal fade" id="modal{{$product->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">{{ucwords(str_replace("_", " ", $product->name))}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-8 col-lg-5 mx-auto">
                                <div class="mt-5"></div>
                                <div style="display:none; text-align:center; font-weight:bold;" id="errorcoworkspace_modal{{$product->id}}">
                                    <p class="text-danger" id="error_modal{{$product->id}}"></p>
                                </div>
                                                
                                <form class="row g-3" id="form{{$product->id}}" method="post" action="" onsubmit="bookNow{{$product->id}}(event)">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label fs-6">Name <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input type="text" class="form-control" name="cus_name{{$product->id}}" id="cus_name_modal{{$product->id}}" placeholder="Your Name" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label fs-6">Email <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input type="email" class="form-control" name="cus_email{{$product->id}}" id="cus_email_modal{{$product->id}}" placeholder="Your Email" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-12">
                                        <div class="mb-3">                                               
                                            <label class="form-label fs-6">Date <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input type="date" onchange="availabilityCheck{{$product->id}}()" min = "{{date('Y-m-d', strtotime('now'))}}" class="form-control" name="booking_date{{$product->id}}" id="booking_date_modal{{$product->id}}" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                
                                    <div class="col-md-12" id = "hourly{{$product->id}}">
                                        <div class="mb-3">                                               
                                            <label class="form-label fs-6">Time <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input type="time" onchange="availabilityCheck{{$product->id}}()" class="form-control" name="booking_time{{$product->id}}" id="booking_time_modal{{$product->id}}" >
                                            </div>
                                        </div>
                                    </div><!--end col-->
                            

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label fs-6">Plan <span class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <select name="plan" onchange="availabilityCheck{{$product->id}}()" id = 'plan_modal{{$product->id}}' class="form-control" required="">
                                                    @php
                                                        $variations = Variations::where(['product_id' => $product->id])->get();
                                                    @endphp
                                                    @foreach($variations as $variation)
                                                        <option value="{{$variation->variation_type}}">{{ucfirst($variation->variation_type)}} (#{{number_format($variation->price)}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
   					    <div class="form-icon position-relative">
                                                <input type="{{'hidden'}}" onfocusout="availabilityCheck{{$product->id}}()" onchange="availabilityCheck{{$product->id}}()" class="form-control" name="no_of_seats{{$product->id}}" id="no_of_seats_modal{{$product->id}}" placeholder="No of seats" value="1" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="modal-footer">
                                    
                                        <div class="spinner-border mt-2" style="display:none;" role="status" id="loadingcoworkspace_modal{{$product->id}}">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="book_now_modal{{$product->id}}">Book Now</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </form>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
            <script>
                document.getElementById("bookspace{{$product->id}}").addEventListener('click', function (event) {
                    event.preventDefault();
                    $('#booking_date_modal{{$product->id}}').val("");
                    $('#no_of_seats_modal{{$product->id}}').val(1);
                    $('#errorcoworkspace_modal{{$product->id}}').hide();
                    $("#book_now_modal{{$product->id}}").css('display', "grid");
                });
                function availabilityCheck{{$product->id}}(){
                    if($('#plan_modal{{$product->id}}').val() == "hourly"){
                        document.getElementById("hourly{{$product->id}}").required = true
                        $("#hourly{{$product->id}}").show();
                    }else{
                        document.getElementById("hourly{{$product->id}}").required = false
                        $("#hourly{{$product->id}}").hide();
                    }
                    $.ajax({
                        type: 'GET',
                        url: '{{Route("check_coworkspace_availability")}}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'booking_date': $('#booking_date_modal{{$product->id}}').val(),
                            'plan': $('#plan_modal{{$product->id}}').val(),
                            'product': "{{$product->name}}",
                            'booking_time': $('#booking_time_modal{{$product->id}}').val(),
                            'no_of_seats': $('#no_of_seats_modal{{$product->id}}').val(),
                            'id': {{$product->id}},
                        },
                        beforeSend: function() {
                            $('#errorcoworkspace_modal{{$product->id}}').hide();
                            $("#book_now_modal{{$product->id}}").hide();
                            $("#loadingcoworkspace_modal{{$product->id}}").show();
                        },

                        success: function(response) {
                            $("#loadingcoworkspace").hide();
                            if (response.status == 1) {
                                $("#book_now_modal{{$product->id}}").css('display', "grid");
                                $("#loadingcoworkspace_modal{{$product->id}}").hide();
                            } else if(response.status == 404){
                                $("#error_modal{{$product->id}}").html(response.error);
                                $('#errorcoworkspace_modal{{$product->id}}').show();
                                $("#book_now_modal{{$product->id}}").css('display', "grid");
                                $("#loadingcoworkspace_modal{{$product->id}}").hide();
                            }else {
                                $("#error_modal{{$product->id}}").html(response.error);
                                $('#errorcoworkspace_modal{{$product->id}}').show();
                                $("#loadingcoworkspace_modal{{$product->id}}").hide();
                            }

                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                            // stopLoader('body');
                        }
                    });
            }

            function bookNow{{$product->id}}(e){
                e.preventDefault();
                if($('#booking_time_modal').val() == "" || $('#booking_time_modal').val() <= Date.now()){
                    $("#error_modal").html("Please enter a valid time");
                            $('#errorcoworkspace_modal').show();
                            return false;
                }
                if(document.getElementById("cus_name_modal{{$product->id}}").value.trim() == ""){
                    $("#error_modal{{$product->id}}").html("Please enter your name");
                            $('#errorcoworkspace_modal{{$product->id}}').show();
                            return false;
                }else if(document.getElementById("cus_email_modal{{$product->id}}").value.trim() == ""){
                    $("#error_modal{{$product->id}}").html("Please enter your email");
                            $('#errorcoworkspace_modal{{$product->id}}').show();
                            return false;
                }
                let amn = 0;
                $.ajax({
                            type: 'GET',
                            url: '{{Route("get_category_details")}}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'plan': $('#plan_modal{{$product->id}}').val(),
                                'id': {{$product->id}},
                                
                            },
                            
                            success: function(response) {
                                
                                if(response.status == 1){
                                    amn = response.message;

                                    if(amn == 0){

                            swal({
                                title: '',
                                text: 'Ensure that your details are correct',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Book!',
                                cancelButtonText: 'No, cancel',
                                confirmButtonClass: 'confirm-class',
                                cancelButtonClass: 'cancel-class',

                            })
                            .then((isConfirm) => {
                                if (isConfirm.value) {
                                    $.ajax({
                                        type: 'GET',
                                        url: '{{Route("book_free_now")}}',
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            'booking_date': $('#booking_date_modal{{$product->id}}').val(),
                                            'booking_time': $('#booking_time_modal{{$product->id}}').val(),
                                            'plan': $('#plan_modal{{$product->id}}').val(),
                                            'product': "{{$product->name}}",
                                            'duration': $('#plan_modal{{$product->id}}').val(),
                                            'no_of_seats': $('#no_of_seats_modal{{$product->id}}').val(),
                                            'cus_name': $('#cus_name_modal{{$product->id}}').val().trim(),
                                            'cus_email': $('#cus_email_modal{{$product->id}}').val().trim(),
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
                                            document.getElementById("form").reset();
                                            if(response.status == 1){
                                                swal("Success!", response.message, "success").then(function() {
                                                    location.reload();
                                                });

                                            }else{
                                                console.log(response);
                                            }
                                            
                                        },
                                        error: function(xhr, status, error) {
                                            alert(xhr.responseText);
                                            // stopLoader('body');
                                        }
                                    });
                                }
                            });


                            }else{
                                    
                               
                $('#errorcoworkspace_modal{{$product->id}}').hide();
                let handler = PaystackPop.setup({
                    key: '{{$_ENV['LIVE_PUBLIC_KEY']}}', // Replace with your public key
                    email: document.getElementById("cus_email_modal{{$product->id}}").value,
                    amount:  $('#no_of_seats_modal{{$product->id}}').val() * amn * 100,
                    currency: 'NGN',
                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    label: "Shecluded",
                    // onClose: function(){
                    // alert('Window closed.');
                    // },
                    callback: function(response){
                    // let message = 'Payment complete! Reference: ' + response.reference;
                    // alert(message);
                    $.ajax({
                            type: 'GET',
                            url: '{{Route("book_now")}}',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'booking_date': $('#booking_date_modal{{$product->id}}').val(),
                                'booking_time': $('#booking_time_modal{{$product->id}}').val(),
                                'plan': $('#plan_modal{{$product->id}}').val(),
                                'product': "{{$product->name}}",
                                'duration': $('#plan_modal{{$product->id}}').val(),
                                'no_of_seats': $('#no_of_seats_modal{{$product->id}}').val(),
                                'cus_name': $('#cus_name_modal{{$product->id}}').val().trim(),
                                'cus_email': $('#cus_email_modal{{$product->id}}').val().trim(),
                                'reference': response.reference,
                            },
                            
                            success: function(response) {
                                document.getElementById("form{{$product->id}}").reset()
                                if(response == "success"){
                                    alert('Payment Successful! Please visit our center for the next line of action.')
                                    location.reload();
                                }else{
                                    alert(response);
                                }
                                
                            },
                            error: function(xhr, status, error) {
                                alert(xhr.responseText);
                                // stopLoader('body');
                            }
                        });
                    }
                });
                

                handler.openIframe();
            }

            }else{
                alert(response);
            }
                    
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    // stopLoader('body');
                }
            });
         }
         $(document).ready(function(){
            if($('#plan_modal{{$product->id}}').val() == "hourly"){
                document.getElementById("hourly{{$product->id}}").required = true
                $("#hourly{{$product->id}}").show();
            }else{
                document.getElementById("hourly{{$product->id}}").required = false
                $("#hourly{{$product->id}}").hide();
            }
        });
    </script>
             @endif
        @endforeach


        <script src="https://js.paystack.co/v1/inline.js"></script> 
        <script>
            var text = [
                '<p style="font-size: 3.2em;line-height:1.3em;font-family: Playfair Display;">A Space where Women <span style="color:#EB2590;">Collaborate</span> and <span style="color:#EB2590;">Create</span>.</p>',
                '<p style="font-size: 3.2em;line-height:1.3em;font-family: Playfair Display;">A Space where <span style="color:#EB2590;">Productivity</span> meets <span style="color:#EB2590;">Community</span>.</p>',
                        ];
            var counter = 0;
            var elem = $("#trans");
            setInterval(change, 3000);
            function change() {
                elem.fadeOut(function(){
                    elem.html(text[counter]);
                    counter++;
                    if(counter >= text.length) { counter = 0; }
                    elem.fadeIn();
                });
            }

           
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    </body>
</html>
