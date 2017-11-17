<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <!-- Title -->
        <title>eHealth</title>
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Favicon -->
        <link href="favicon.ico" rel="shortcut icon">
        <!-- Bootstrap Core CSS -->		
        <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/animate.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/assets/css/nexus.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">


        @yield('page_styles')



    </head>
    <body>
         
        
        
        
        <div id="body_bg">
            <div id="pre_header" class="container">
                <div class="row margin-top-10 visible-lg">
                    <div class="col-md-6">
                        <p>
                            <strong>Phone:</strong>&nbsp;1-800-123-4567</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>
                            <strong>Email:</strong>info@example.com</p>

                    </div>
                </div>
            </div>
            <div class="primary-container-group">
                <!-- Background -->
                <div class="primary-container-background">
                    <div class="primary-container"></div>
                    <div class="clearfix" ></div>
                </div>
                <!--End Background -->
                <div class="primary-container">
                    <div id="header" class="container">
                        <div class="row">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.html" title="">
                                    <img src="{{ asset('/assets/img/logo1.png') }}" alt="Logo" />
                                </a>
                            </div>
                            <!-- End Logo -->

                            <ul class="social-icons pull-right hidden-xs">





                                <li class="social-rss">
                                    <a href="#" target="_blank" title="RSS"></a>
                                </li>
                                <li class="social-twitter">
                                    <a href="#" target="_blank" title="Twitter"></a>
                                </li>
                                <li class="social-facebook">
                                    <a href="#" target="_blank" title="Facebook"></a>
                                </li>
                                <li class="social-googleplus">
                                    <a href="#" target="_blank" title="GooglePlus"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Top Menu -->
                    <div id="hornav" class="container no-padding">
                        <div class="row">
                            <div class="col-md-12 no-padding">
                                <div class="pull-right visible-lg">
                                    <ul id="hornavmenu" class="nav navbar-nav">



                                        <li>
                                            <a href="{{'/'}}" class="fa-home">Home</a>
                                        </li>

                                        @if(!\Auth::check() or \Auth::user()->user_type=="Member")
                                            <li>
                                                <a href="{{ url('/feedback') }}">Feedback</a>
                                            </li>
                                            <li>
                                                <span class="fa-copy">Services</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('/ServicesPages/angyography') }}">Angiography</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/ServicesPages/CTscanning') }}">C.T. Scanning</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/ServicesPages/PreventiveHealthCheck') }}">Preventive Health Checks</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/ServicesPages/AboutLaborataries') }}">About Laborataries
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Diabetes Screening
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/echanneling') }}">
                                                            E-Channeling
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Endoscopy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>
                                            @endif



                                        @if(\Auth::check() && \Auth::user()->user_type=="Doctor")
                                            <li>
                                                <a href="{{ url('/doctorvisits') }}">Bookings</a>
                                            </li>


                                                    <li>
                                                        <a href="{{ url('/patientlist') }}">Patients</a>
                                                    </li>




                                        @endif

                                        @if(\Auth::check() && \Auth::user()->user_type=="Pharmacy")

                                                    <li>
                                                        <a href="{{ url('/medicinecarts') }}">Pharmacy</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/medicines') }}">Medicines</a>
                                                    </li>

                                        @endif

                                        @if(\Auth::check() && \Auth::user()->user_type=="Administrator")
                                            <li>
                                                <span class="fa-copy">E-Channelling Scheduling</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('/EC_Schedule') }}">
                                                            Scheduling Calander</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ url('/EC_Schedule/create') }}">
                                                            Add Schedules</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('EC_Schedule/list_schedules') }}">
                                                            List Schedules</a>
                                                    </li>

                                                </ul>
                                            </li>

                                            <li>
                                                <span class="fa-copy">E-Channelling Payments</span>
                                                <ul>
                                                    <li class="active"><a href="{{ url('/EC_DOC_RATES/create') }}">Add E-Channelling Rates</a>
                                                    </li>
                                                    <li class="active"><a href="{{ url('/EC_DOC_RATES') }}">E-Channelling Rates</a>
                                                    </li>

                                                </ul>
                                            </li>
                                        @endif

                                        @if(\Auth::check() && \Auth::user()->user_type=="Laboratory")
                                            <li>
                                                <span class="fa-copy">Resource Allocation</span>
                                                <ul>

                                                    <!-- Menu Toggle Button -->

                                                    <li>
                                                        <a href="{{ url('/checkup_shedules') }}">View Laboratory Allocation Schedules</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/checkup_shedules/create') }}">Allocate Resources</a>
                                                    </li>
                                                </ul>

                                            </li>

                                            <li>
                                                <span class="fa-copy">Checkup Scheduling</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('checkup_shedules/viewLabDetails') }}">My Calender</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ url('/patient_shedules') }}">Available Checkup List</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ url('patient_schedules/viewScheduledCheckups') }}">Scheduled Checkup List</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <span class="fa-copy">Checkup results</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('patient_schedules/viewCompletedCheckups') }}">Add Blood Results</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ url('patient_schedules/viewReports') }}">Print Blood Reports</a>
                                                    </li>
                                                </ul>
                                            </li>


                                        @endif


                                        {{--<li>
                                            <!-- Menu Toggle Button -->
                                            <a href="{{ url('/auth/register') }}">
                                                <span class="hidden-xs">Register</span>
                                            </a>
                                        </li>--}}


                                        @if(!\Auth::check())
                                        <li class="active"><a href="{{ url('/members/create') }}">Member Registration</a>
                                        </li>
                                        @endif





                                        @if(\Auth::check() && \Auth::user()->user_type=="Administrator")
                                            <li class="active"><a href="{{ url('/doctors/create') }}">Doctor Registration</a>
                                            </li>
                                        @endif

                                        @if(!\Auth::check())
                                            <li>
                                                <!-- Menu Toggle Button -->
                                                <a href="{{ url('/auth/login') }}">
                                                    <span class="hidden-xs">Login</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if(\Auth::check())
                                            <li>
                                                <!-- Menu Toggle Button -->
                                                <a href="{{ url('/auth/logout') }}">
                                                    <span class="hidden-xs">Logout</span>
                                                </a>
                                            </li>
                                        @endif




                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Top Menu -->
                    <!-- === END HEADER === -->
                    @yield('content')
                </div>
            </div>
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
                <div class="container padding-vert-30 margin-top-40">
                    <div class="row">
                        <!-- Sample Menu -->
                        <div class="col-md-4 margin-bottom-20">
                            <h3 class="margin-bottom-10">Our Services</h3>
                            <ul class="menu">
                                <li>
                                    <a class="fa-tasks">E Channeling</a>
                                </li>
                                <li>
                                    <a class="fa-users">Medical Checkups</a>
                                </li>
                                <li>
                                    <a class="fa-signal" >Organ Donation</a>
                                </li>
                                <li>
                                    <a class="fa-coffee">Pharmacy</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <!-- End Sample Menu -->
                        <!-- Contact Details -->
                        <div class="col-md-4 margin-bottom-20">
                            <h3 class="margin-bottom-10">Contact Details</h3>
                            <p>
                                <span class="fa-phone">Telephone:</span>011-7860987
                                <br>
                                <span class="fa-envelope">Email:</span>
                                <a>info@ecare.com</a>
                                <br>
                                <span class="fa-link">Website:</span>
                                <a href="http://www.ecarer.com">www.ecarer.com</a>
                            </p>
                            <p>The Dunes, Top Road,
                                <br>Strandhill,
                                <br>Co. Sligo,
                                <br>Ireland</p>
                        </div>

                        <div class="col-md-4 margin-bottom-20">
                            <h3 class="margin-bottom-10">About Us</h3>
                            <p>e-Care links to health information from the National Institutes of Health and other federal government agencies. e-Care also links to health information from non-government Web sites. See our disclaimer about external links and our quality guidelines.</p>

                            <div class="clearfix"></div>
                        </div>
                        <!-- End Disclaimer -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- Footer Menu -->
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div id="copyright" class="col-md-4">
                            <p>(c) 2014 Your Copyright Info</p>
                        </div>
                        <div id="footermenu" class="col-md-8">
                            <ul class="list-unstyled list-inline pull-right">

{{--
                                <li>
                                    <a href="{{'/admin_panel'}}" style="color: #cb2027 ; font-size: 200%">ADMIN</a>
                                </li>--}}


                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- End Footer Menu -->

        @yield('page_script1')
            <!-- JS -->
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.min.js') }}" type="text/javascript"></script>
            <script type="text/javascript" src="{{ asset('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script type="text/javascript" src="{{ asset('/assets/js/scripts.js') }}"></script>
            <!-- Isotope - Portfolio Sorting -->
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.isotope.js') }}" type="text/javascript"></script>
            <!-- Mobile Menu - Slicknav -->
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.slicknav.js') }}" type="text/javascript"></script>
            <!-- Animate on Scroll-->
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.visible.js') }}" charset="utf-8"></script>
            <!-- Sticky Div -->
            <script type="text/javascript" src="{{ asset('/assets/js/jquery.sticky.js') }}" charset="utf-8"></script>
            <!-- Slimbox2-->
            <script type="text/javascript" src="{{ asset('/assets/js/slimbox2.js') }}" charset="utf-8"></script>
            <!-- Modernizr -->
            <script src="{{ asset('/assets/js/modernizr.custom.js') }}" type="text/javascript"></script>
            <!-- End JS -->



        @yield('page_script2')


    </body>
</html>
<!-- === END FOOTER === -->