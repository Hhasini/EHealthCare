
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
                        A balanced diet, exercise and of course preventive screening hold the key to longevity. E-care offers a range of health screenings as a proactive lifestyle choice for the early detection of diseases.
                    </div>
                </div>
                <!-- End About -->
                <!-- Actions(only logged in users can see the actions) -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Actions</h3>
                    </div>

                    <ul class="list-group sidebar-nav" id="sidebar-nav">
                        <!-- Search Doctor -->

                        <li class="list-group-item ">
                            <a href="{{ url('patient_schedules/viewReports') }}">online blood report</a>
                        </li>
                        <!-- End Search Doctor -->
                        <!-- Channel doctor -->
                        <li class="list-group-item ">
                            <a href="{{ url('patient_schedules/viewScheduledCheckups') }}">View Scheduled Checkup</a>
                        </li>
                        <!-- End Channel doctor -->
                        <!-- Visit doctor -->
                        <li class="list-group-item">
                            <a href="{{ url('/checkup_shedules') }}">Lab Resource Scheduling</a>
                        </li>
                        <!-- End Visit doctor  --> 
                         
                       <li class="list-group-item">
                            <a href="{{ url('/patient_shedules') }}">Schedule Available Checkup List</a>
                        </li>
                        <li class="list-group-item ">
                            <a href="{{ url('patient_schedules/viewCompletedCheckups') }}">Completed Checkup</a>
                        </li>
                    </ul>

                </div>
                <!-- End Actions -->
            </div>
            <!-- End Side Column -->
            <!-- Main Column -->
            <div class="col-md-9">
                <!-- Main Content -->
                <h2>Medical Checkup </h2>
                <center>
                    <img alt="organ_donation" src="{{ asset('/assets/img/services/medical_checkup_banner.jpg') }}">
                </center>
                
                    <br>
                    <p>Health check-ups at e-care provide advanced health scans and offers individualized and comprehensive physical examinations. Preventive health-care is of great importance, yet most people do not consider regular health check-ups as a priority. Medical advice is usually sought after a condition that has progressed. A far more responsible approach is to schedule regular health checks to avoid serious ailments and bring peace of mind for you and your family.</p>
                        
                    <!-- End Main Content -->
                    <p>Please  <a style="color: #00cc00" href="{{ url('/auth/login') }}">login </a>to use the service. Not registered yet? <a  style="color:#0033ff" href="{{ url('/auth/register') }}">Register </a> here.</p>
                
            </div>
            <!-- End Main Column -->
        </div>

    </div>



@endsection

