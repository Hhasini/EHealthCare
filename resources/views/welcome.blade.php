@extends('app')

@section('content')
<!-- === BEGIN CONTENT === -->
                    <div id="content">



                        <div class="container no-padding">
                            <div class="row">

                                <!-- Carousel Slideshow -->
                                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example" data-slide-to="1"></li>
                                        <li data-target="#carousel-example" data-slide-to="2"></li>
                                    </ol>
                                    <div class="clearfix"></div>
                                    <!-- End Carousel Indicators -->
                                    <!-- Carousel Images -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="{{ asset('/assets/img/slideshow/slide6.jpg') }}">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('/assets/img/slideshow/slide7.jpg') }}">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('/assets/img/slideshow/slide8.jpg') }}">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('/assets/img/slideshow/slide7.jpg') }}">
                                        </div>
                                    </div>
                                    <!-- End Carousel Images -->
                                    <!-- Carousel Controls -->
                                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                    <!-- End Carousel Controls -->
                                </div>
                                <!-- End Carousel Slideshow -->
                            </div>
                        </div>
                        <div class="container background-gray-lighter">
                            <div class="row">
                                <h2 class="animate fadeIn text-center margin-top-50">As You Care - We Care</h2>
                                <hr class="margin-top-15">
                                <p class="animate fadeIn text-center">e-Care offers a collection service from the comfort and convenience of your home or office.</p>
                                <p class="text-center animate fadeInUp margin-bottom-50">
                                </p>
                            </div>
                        </div>

                        <div class="container background-gray-lighter">
                            <div class="row row-no-margin">
                                <!-- Portfolio -->
                                <ul class="portfolio-group">
                                    <!-- Portfolio Item -->

                                    <li class="portfolio-item col-sm-4 col-xs-6 no-padding">
                                        <a href="{{ url('/echanneling') }}">
                                            <h3>Channel your doctor</h3>
                                            <figure class="animate fadeInLeft animated">
                                                <img alt="image1" src="{{ asset('/assets/img/frontpage/echanneling.png') }}">
                                                <figcaption>
                                                    <span style="color:#212121; ">We are No.1 website offering you the top best channeling service in Sri Lanka that allows you to channel your doctor from anywhere, anytime within seconds in a few easy steps.</span>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </li>
                                    <!-- //Portfolio Item// -->
                                    <!-- Portfolio Item -->
                                    <li class="portfolio-item col-sm-4 col-xs-6 no-padding">
                                        <a href="{{ url('/auth/login') }}">
                                            <h3>Health is wealth</h3>
                                            <figure class="animate fadeInLeft animated">
                                                <img alt="image2" src="{{ asset('/assets/img/frontpage/medical_checkup.png') }}">
                                                <figcaption>
                                                    <span style="color:#212121; ">A balanced diet, exercise and of course preventive screening hold the key to longevity. E-care offers a range of health screenings as a proactive lifestyle choice for the early detection of diseases.</span>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </li>
                                    <!-- //Portfolio Item// -->
                                    <!-- Portfolio Item -->
                                    <li class="portfolio-item col-sm-4 col-xs-6 no-padding">
                                        <a href="{{ url('/organDonation') }}">
                                            <h3>A gift for another life</h3>
                                            <figure class="animate fadeInLeft animated">
                                                <img alt="image3" src="{{ asset('/assets/img/frontpage/organ_donation.png') }}">
                                                <figcaption>
                                                    <span style="color:#212121; ">If you needed an organ transplant would you have one? If so please help those in need of a transplant by opting to donate organs and tissue. e-Care will help you to save a life.</span>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </li>

                                </ul>
                                <!-- End Portfolio -->
                            </div>
                        </div>

                        <div class="container">
                            <div class="row margin-vert-30">
                                <!-- Main Text -->
                                <div class="col-md-12">
                                    <h2 style="font-family: fantasy">e-Care</h2>
                                    <p>e-Care links to health information from the National Institutes of Health and other federal government agencies. e-Care also links to health information from non-government Web sites. See our disclaimer about external links and our quality guidelines.</p>
                                    <p>The high quality of health-care professionals in Sri Lanka is acknowledged around the world and creating awareness about and adopting the newest innovations in different branches of medicine, technology and science will undoubtedly enable us to improve the overall quality of national health.</p>

                                    <img class="visible-lg animate fadeInUp" style="bottom: -50px; position: relative; left: 85px; margin-top: -20px;" src="{{ asset('/assets/img/frontpage/top1.jpg') }}" alt="">

                                </div>
                                <!-- End Main Text -->
                                <!-- Side Column -->

                                <!-- End Side Column -->
                            </div>
                        </div>
                    </div>
@endsection