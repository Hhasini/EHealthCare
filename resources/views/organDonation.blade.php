@extends('app')

@section('content')

<div class="container">

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row margin-vert-30">
        <!-- Side Column -->
        <div class="col-md-3">
            <!-- About -->
           
            <!-- End About -->
            <!-- Actions -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Actions</h3>
                </div>

                <ul class="list-group sidebar-nav" id="sidebar-nav">
                    <!-- Search Doctor -->

                    <!-- End Search Doctor -->
                    <!-- Channel doctor -->
                    <li class="list-group-item ">
                        <a href="{{ url('/organs/create') }}">Register As  Donor</a> 
                    </li>
                    <li class="list-group-item ">
                        <a href="{{ url('/organvisits/create') }}">Visit As A Blood Donor</a> 
                    </li>
                    <!-- End of Actions -->
                    <!-- Visit doctor -->
                    <li class="list-group-item">
                        <a href="{{ url('/orgontypevisits/create') }}">Visit As An Organ Donor</a>
                    </li>
                    <li class="list-group-item list-toggle">
                        <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Statics</a>
                        <ul id="collapse-typography" class="collapse">
                            <li>
                                <a href="{{ url('/organvisits/bloodchart') }}">
                                    See Blood Stock</a>
                            </li>
                            <li>
                                <a href="{{ url('/organvisits/visitchart') }}">
                                    See Visits</a>
                            </li>
                            <li>
                                <a href="{{ url('/orgontypevisits/organchart') }}">
                                    See Organ Stock</a>
                            </li>
                            <li>
                                <a href="{{ url('/orgontypevisits/visitchart') }}">
                                    See Visits</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End Visit doctor  --> 
                    <!-- only logged in users should see channeling history  --> 
                    <!--                        <li class="list-group-item">
                                                <a href="#">Channeling history</a>
                                            </li>-->
                </ul>

            </div>
             <div class="panel panel-primary invert">
                <div class="panel-heading">
                    <h3 class="panel-title">About</h3>
                </div>
                <div class="panel-body">
                    If you needed an organ transplant would you have one? If so please help those in need of a transplant by opting to donate organs and tissue. e-Care will help you to save a life.
                </div>
            </div>
            
            <!-- End recent Posts -->

        </div>
        <!-- End Side Column -->
        <!-- Main Column -->
        <div class="col-md-9">
            <!-- Main Content -->
            <h2><center><b>ORGAN DONATION</b></center> </h2>

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
                                <img alt="organ_donation" src="{{ asset('/assets/img/services/organ_donnation_banner.png') }}">
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

            <br>
            <div class="container background-gray-lighter">
                <div class="row">
                    <h2 class="animate fadeIn text-center margin-top-50">As You Care - We Care</h2>
                    <hr class="margin-top-15">
                   
                    
                </div>
            </div>


        
            

            <!-- End Main Content -->


        </div>
        <!-- End Main Column -->
    </div>

</div>


@endsection
