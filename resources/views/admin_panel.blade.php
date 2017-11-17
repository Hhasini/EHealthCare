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
                <div class="panel panel-primary invert">
                    <div class="panel-heading">
                        <h3 class="panel-title">About</h3>
                    </div>
                    <div class="panel-body">
                        We are No.1 website offering you the top best channeling service in Sri Lanka that allows you to channel your doctor from anywhere, anytime within seconds.
                    </div>
                </div>
                <!-- End About -->
                <!-- Actions -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Actions</h3>
                    </div>

                    <ul class="list-group sidebar-nav" id="sidebar-nav">
                        <!-- E-Channeling -->
                        <li class="list-group-item list-toggle">
                            <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">E-Channelling</a>
                            <ul id="collapse-typography" class="collapse">
                                <li>
                                    <a href="{{ url('/EC_Schedule') }}">
                                        Scheduling Calander</a>
                                </li>

                                <li>
                                    <a href="{{ url('/EC_Schedule/create') }}">
                                       Scheduling</a>
                                </li>
                                <li>
                                    <a href="{{ url('EC_Schedule/list_schedules') }}">
                                        List Schedules</a>
                                </li>
                            </ul>
                        </li>



                        <!-- Medical Checkup -->
                        <li class="list-group-item list-toggle">
                            <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Medical Checkup</a>
                            <ul id="collapse-typography" class="collapse">
                                <li>
                                    <a href="#">
                                        checkup scheduling</a>
                                </li>
                                <li>
                                    <a href="#">
                                        Public hospital</a>
                                </li>
                            </ul>
                        </li>


                        <!-- End Search Doctor -->
                        <!-- Channel doctor -->
                        <li class="list-group-item ">
                            <a href="#">Channel doctor</a>
                        </li>
                        <!-- End of Actions -->
                        <!-- Visit doctor -->
                        <li class="list-group-item">
                            <a href="#">Payment</a>
                        </li>
                        <!-- End Visit doctor  -->
                        <!-- only logged in users should see channeling history  -->
                        <!--                        <li class="list-group-item">
                                                    <a href="#">Channeling history</a>
                                                </li>-->
                    </ul>

                </div>
                <!-- End recent Posts -->

            </div>
            <!-- End Side Column -->
            <!-- Main Column -->
            <div class="col-md-9">
                <!-- Main Content -->
                <h2>ADMIN PANEL </h2>
                <center>
                    <img alt="e-channeling" src="{{ asset('/assets/img/services/echanneling_banner.jpg') }}">
                </center>

                <br>
                <p>Our E-Channeling service allows you to channel your doctor from a few easy steps from your home,workplace or anywhere where now you no longer needs to pay a visit to the hospital for channeling your doctor and waiting in the queue till your chance. </p>

                <!-- End Main Content -->
                <p>Please  <a style="color: #00cc00" href="{{ url('/auth/login') }}">login </a>to view your channeling history. Not registered yet? <a  style="color:#0033ff" href="{{ url('/auth/register') }}">Register </a> here.</p>

            </div>
            <!-- End Main Column -->
        </div>

    </div>



@endsection
