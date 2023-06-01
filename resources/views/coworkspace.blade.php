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
	    <!-- Custom  Css -->
	    <link href="css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <style>
            @media (min-width: 600px) { 
                #home{
                    background: url('images/coworkspace.jpg') center center;
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
            <div class="bg-overlay d-none d-md-block"></div>
            <div class="container">
                <div class="row justify-content-end ">
                    <div class="col-xl-5 col-lg-5 col-md-6 d-md-none d-sm-block">
                        <img src="images/coworkspace.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div class="card shadow rounded-md border-0 ms-xl-5">
                            <div class="card-body">
                                <h4 class="card-title text-center">Book a spot in <i style="color:#EB2590;">Shecluded hub</i></h4>

                                <form class="login-form mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">                                               
                                                <label class="form-label fs-6">Date <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <input type="date" min = "{{date('Y-m-d', strtotime('now'))}}" class="form-control" name="booking_date" id="booking_date" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label fs-6">Plan <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <select name="plan" id="plan" class="form-control" required="">
                                                        <option value="daily">Daily (#5000)</option>
                                                        <option value="weekly">Weekly (#25000)</option>
                                                        <option value="monthly">Monthly (#100000)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label fs-6">No of seats <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <input type="number" class="form-control" name="no_of_seats" id="no_of_seats" placeholder="No of seats" value="1" required="">
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
                                            <div style="display:none;" id="bookcoworkspace">
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

       

       


        <!-- Start Footer -->
        <footer class="bg-footer footer-bar">
            <div class="footer-py-30">
                <div class="container text-center">
                    <div class="row align-items-center">
                        <div class="col-sm-3">
                            <div class="text-sm-start">
                                <a href="#" class="logo-footer">
                                    <img src="images/logo-light.png" alt="" width="200px">
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <div class="text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Shecluded.</p>
                            </div>
                        </div>
    
                        <!-- <div class="col-sm-3 mt-4 mt-sm-0 pt-2 pt-sm-0"> -->
                            <!-- <ul class="list-unstyled social-icon foot-social-icon text-sm-end mb-0">
                                <li class="list-inline-item mb-0"><a href=""><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item mb-0"><a href=""><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item mb-0"><a href=""><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                <li class="list-inline-item mb-0"><a href=""><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                            </ul> -->
                            <!--end icon-->
                        <!-- </div> -->
                        <!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </div>
        </footer><!--end footer-->
        <!-- End Footer -->

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
       
         </script>
    </body>
</html>