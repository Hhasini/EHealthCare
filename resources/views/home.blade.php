@extends('app')

        <?php
        use Illuminate\Support\Facades\DB as DB;
        use Carbon\Carbon;
        use App\Http\Requests;
        use App\ESchedule;
        use App\CancelECschedules;


        ?>

@if(\Auth::check() && \Auth::user()->user_type=="Member")

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
@else          



@section('content')
    @if(\Auth::user()->user_type=="Member")
<div class="container">
	<div class="row margin-vert-30">
                                <!-- Begin Sidebar Menu -->
                                <div class="col-md-3">
                                    <ul class="list-group sidebar-nav" id="sidebar-nav">
                                        <!-- Typography -->
                                        <li class="list-group-item list-toggle">
                                            <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">SEARCH DOCTOR</a>
                                            <ul id="collapse-typography" class="collapse">
                                                <li>
                                                    <a href="{{ url('/searchDoctor') }}">
                                                        <i class="fa fa-sort-alpha-asc"></i>Private Hospital</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <!-- End Typography -->
                                        <!-- Components -->
                                        <li class="list-group-item list-toggle">
                                            <a class="accordion-toggle" href="#collapse-components" data-toggle="collapse">Components</a>
                                            <ul id="collapse-components" class="collapse">
                                                <li>
                                                    <span class="badge">New</span>
                                                    <a href="#">
                                                        <i class="fa fa-tags"></i>Labels</a>
                                                </li>
                                                <li>
                                                    <span class="badge">New</span>
                                                    <a href="#">
                                                        <i class="fa fa-align-left"></i>Progress Bars</a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-columns"></i>Panels</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <!-- End Components -->
                                        <!-- Icons -->
                                        <li class="list-group-item list-toggle">
                                            <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-icons">Icons</a>
                                            <ul id="collapse-icons" class="collapse">
                                                <li>
                                                    <span class="badge badge-u">New</span>
                                                    <a href="#">
                                                        <i class="fa fa-chevron-circle-right"></i>Icon Styling</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <!-- End Icons -->
                                        <!-- Testimonials -->
                                        <li class="list-group-item">
                                            <a href="#">Testimonials</a>
                                        </li>
                                        <!-- End Testimonials -->
                                        <!-- Accordion and Tabs -->
                                        <li class="list-group-item">
                                            <a href="#">Accordions & Tabs</a>
                                        </li>
                                        <!-- End Accordion and Tabs -->
                                        <!-- Buttons -->
                                        <li class="list-group-item">
                                            <a href="#">Buttons</a>
                                        </li>
                                        <!-- End Buttons -->
                                        <!-- Carousels -->
                                        <li class="list-group-item">
                                            <a href="#">Carousels</a>
                                        </li>

                                        <!-- End Grid System -->
                                    </ul>

                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Channel Doctor</h3>
                                        </div>
                                        <div class="panel-body">
                                            Find a Doctor
                                            <br>
                                            <button type="button" class="btn btn-primary">CLICK HERE</button>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Medical Checkup</h3>
                                        </div>
                                        <div class="panel-body">
                                            Find a medical checkup
                                            <br>
                                            <button type="button" class="btn btn-primary">CLICK HERE</button>
                                        </div>
                                    </div>

                                </div>

                                <!-- End Sidebar Menu -->
								<div class="col-md-9">
									@yield('subcontent')
								</div>
	</div>
</div>
    @endif




@if(\Auth::user()->user_type=="Administrator")

    <?php




    $doctors = DB::table('doctors')->get();
    $rooms = DB::table('ec_rooms')->get();

    $schedules = ESchedule::orderBy('shift_start','ASC')->get();

    $cur_date = Carbon::now();

    $future = ESchedule::where('shift_start','>=',$cur_date)->orderBy('shift_start','ASC')->get();
    $past = ESchedule::where('shift_start','<=',$cur_date)->orderBy('shift_start','ASC')->get();

    $cancelSchedules=CancelECschedules::get();


    ?>

@section('content')

    <div class="container">



        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3">
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image4.jpg') }}" alt="image2">
                        <figcaption>

                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/EC_Schedule/create') }}" style="color: white">
                                    ADD E-CHANNELING SCHEDULES
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>
                <!-- End About -->
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image6.png') }}" alt="image2">
                        <figcaption>

                            <span></span>
                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/EC_Schedule') }}" style="color: white">
                                    VIEW DAILY CALENDER
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>


            </div>










            <br>

            <div class="col-md-9">



                <div class="row">
                    <br>
                    <a class="btn btn-small btn-success pull-right" href="{{ URL::to('EC_Schedule/') }}"> </i> go back</a>


                    <div class="col-md-10">
                        <h1>LIST E-CHANNELLING SCHEDULES</h1>
                        <br>

                        <!-- Nav tabs --><div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All Schedules</a></li>
                                <li role="presentation"><a href="#future" aria-controls="future" role="tab" data-toggle="tab">Future Schedules</a></li>
                                <li role="presentation"><a href="#past" aria-controls="past" role="tab" data-toggle="tab">Past Schedules</a></li>
                                <li role="presentation"><a href="#CanceledSchedules" aria-controls="past" role="tab" data-toggle="tab">Canceled Schedules</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="all">


                                    <table class="table table-striped " id="myTable" >
                                        <thead style="background-color: #27a5b4">
                                        <tr style="font-weight: 900 ;color: #eff7ff">

                                            <td>Doctor</td>
                                            <td>Room</td>
                                            <td>Shift Starts At</td>
                                            <td>Shift Ends At</td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>


                                            @foreach( $schedules as $key =>  $schedule)

                                                <?php
                                                $name = DB::table('doctors')->where('doctor_id',$schedule->doc_id)->get();


                                                foreach($name as $d){


                                                    echo "<td>";
                                                    echo $d->name;
                                                    echo "</td>";

                                                }
                                                $room = DB::table('ec_rooms')->where('room_id',$schedule->room)->get();

                                                foreach($room as $r){


                                                    echo "<td>";
                                                    echo $r->room_name;
                                                    echo "</td>";

                                                }


                                                ?>
                                                <td>{{  $schedule->shift_start }}</td>
                                                <td>{{  $schedule->shift_end }}</td>

                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>





                                </div>

                                <div role="tabpanel" class="tab-pane" id="future">



                                    <table class="table table-striped " id="myTable" >
                                        <thead style="background-color: #738668">
                                        <tr style="font-weight: 900 ;color: #eff7ff">

                                            <td>Doctor</td>
                                            <td>Room</td>
                                            <td>Shift Starts At</td>
                                            <td>Shift Ends At</td>
                                            <td> Edit Schedules</td>
                                            <td>Delete Schedules </td>
                                            <td> </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>


                                            @foreach( $future as $key =>  $future_s)

                                                <?php
                                                $name = DB::table('doctors')->where('doctor_id',$future_s->doc_id)->get();


                                                foreach($name as $d){


                                                    echo "<td>";
                                                    echo $d->name;
                                                    echo "</td>";

                                                }
                                                $room = DB::table('ec_rooms')->where('room_id',$future_s->room)->get();

                                                foreach($room as $r){


                                                    echo "<td>";
                                                    echo $r->room_name;
                                                    echo "</td>";

                                                }


                                                ?>
                                                <td>{{  $future_s->shift_start }}</td>
                                                <td>{{  $future_s->shift_end }}</td>

                                                <td>

                                                    <a class="btn btn-small btn-info"
                                                       href="{{ URL::to('EC_Schedule/' . $future_s->schedule_id . '/edit') }}">
                                                        <i class='glyphicon glyphicon-edit'> </i>  </a>
                                                </td>
                                                <td>
                                                    {!! Form::model( $future_s, [ 'method' => 'DELETE', 'route' =>
                                                     ['EC_Schedule.destroy',$future_s->schedule_id], 'id' => 'EC_Schedule-del-frm' ]) !!}


                                                    <div class="form-group">

                                                        <div class="form-group">
                                                            <input class="form-control" name="reason_to_cancel" type="text" placeholder=" Reason to Cancel"
                                                            />
                                                        </div>
                                                    </div>



                                                </td>

                                                <td>

                                                    <a title="" data-original-title="" class="btn btn-large btn-danger"
                                                       data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i> </a>

                                                    {!! Form::close() !!}

                                                </td>


                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>



                                <div role="tabpanel" class="tab-pane" id="past">

                                    <table class="table table-striped " id="myTable" >
                                        <thead style="background-color: #738668">
                                        <tr style="font-weight: 900 ;color: #eff7ff">

                                            <td>Doctor</td>
                                            <td>Room</td>
                                            <td>Shift Starts At</td>
                                            <td>Shift Ends At</td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>


                                            @foreach( $past as $key =>  $past_s)

                                                <?php
                                                $name = DB::table('doctors')->where('doctor_id',$past_s->doc_id)->get();


                                                foreach($name as $d){


                                                    echo "<td>";
                                                    echo $d->name;
                                                    echo "</td>";

                                                }
                                                $room = DB::table('ec_rooms')->where('room_id',$past_s->room)->get();

                                                foreach($room as $r){


                                                    echo "<td>";
                                                    echo $r->room_name;
                                                    echo "</td>";

                                                }


                                                ?>
                                                <td>{{  $past_s->shift_start }}</td>
                                                <td>{{  $past_s->shift_end }}</td>


                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>



                                </div>



                                <div role="tabpanel" class="tab-pane" id="CanceledSchedules">

                                    <table class="table table-striped " id="myTable" >
                                        <thead style="background-color: #738668">
                                        <tr style="font-weight: 900 ;color: #eff7ff">

                                            <td>Schedule ID</td>
                                            <td>Reason To Cancel</td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach( $cancelSchedules as $key =>  $cancel)



                                                <td>{{  $cancel->schedule_id }}</td>
                                                <td>{{  $cancel->reason_to_cancel }}</td>


                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <br><br><br>

            </div>

        </div>

    </div>


@endsection
@section('page_script2')

    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#EC_Schedule-del-frm').submit();
                }
            });
        });
    </script>
@endsection
@endif

@if(\Auth::user()->user_type=="Laboratory")
@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.css') }}">
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
@endsection

   @section('content')
    <?php


    $results = DB::table('checkup_shedules')->where('resourceId','=',1)->get();
    foreach ($results as $result) {
        $rid= $result->id;
        $tid = $result->timeSlot;
    }

    $resources = DB::table('resources')->where('id', '=',$rid)->get();
    foreach ($resources as $resource) {
        $labName= $resource->name;
    }

    $timeSlots = DB::table('time_slots')->where('id', '=',$tid)->get();
    foreach ($timeSlots as $timeSlot) {
        $time= $timeSlot->start . "-" . $timeSlot->end;
    }

    $scanLabs = DB::table('checkup_shedules')->where('resourceId','=',2)->get();
    $bloodLabs = DB::table('checkup_shedules')->where('resourceId','=',3)->get();

    ?>


    <div class="container">
        <div class="row margin-vert-30">
            <!-- Side Column -->
            <div class="col-md-3">
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image4.jpg') }}" alt="image2">
                        <figcaption>

                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('/checkup_shedules/create') }}" style="color: white">
                                    ADD LAB SCHEDULES
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>
                <!-- End About -->
                <div class=" person-details margin-bottom-30">
                    <figure>
                        <img src="{{ asset('/assets/img/theteam/image6.png') }}" alt="image2">
                        <figcaption>

                            <span></span>
                        </figcaption>
                        <ul class="list-inline person-details-icons">
                            <li>

                                <a href="{{ url('checkup_shedules/viewLabDetails') }}" style="color: white">
                                    VIEW DAILY CALENDER
                                </a>
                            </li>

                        </ul>
                    </figure>
                </div>


            </div>

            <br>

            <div class="col-md-9">

                <div class="tabs alternative">
                    <ul class="nav nav-tabs" >

                        <li class="active">
                            <a href="#sample-2b" data-toggle="tab">XRAY LAB</a>
                        </li>
                        <li>
                            <a href="#sample-2c" data-toggle="tab">CT/MRI SCAN LAB</a>
                        </li>
                        <li>
                            <a href="#sample-2d" data-toggle="tab">BLOOD TESTING LAB</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="sample-2b">
                            <div class="row">

                                <table class="table table-hover" class="table table-striped table-bordered">
                                    <thead style="background-color: #6c80b4">
                                    <tr style="font-weight: 900 ;color: #eff7ff">
                                        <td></td>
                                        <td>Time Slot</td>
                                        <td>Scheduled Date</td>
                                        <td>Number Of Patients</td>
                                    </tr>
                                    </thead>
                                    @foreach($results as $key => $result)

                                        <tbody>
                                        <tr>
                                            <td width="10%"><a href="#" class="pull-left">
                                                    <img src="{{ asset('/assets/img/theteam/image7.png') }}" width="35px">
                                                </a></td></td>

                                            <?php

                                            $timeSlots = DB::table('time_slots')->where('id', '=',$result->timeSlot)->get();
                                            foreach ($timeSlots as $timeSlot) {
                                                $time= $timeSlot->start . "-" . $timeSlot->end;

                                            } ?>

                                            <td width="20%">{{ $time }}</td>

                                            <td width="20%">
                                                {{ $result->date }}
                                            </td>

                                            <td width="20%" >
                                            <span <?php echo ($result->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $result->count }}</span>
                                            </td>

                                        </tr>
                                        </tbody>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="sample-2c">
                            <div class="row">
                                <table class="table table-hover" class="table table-striped table-bordered">
                                    <thead style="background-color: #27a5b4">
                                    <tr style="font-weight: 900 ;color: #eff7ff">
                                        <td></td>
                                        <td>Time Slot</td>
                                        <td>Scheduled Date</td>
                                        <td>Number Of Patients</td>
                                    </tr>
                                    </thead>
                                    @foreach($scanLabs as $key => $result)

                                        <tbody>
                                        <tr>
                                            <td width="10%"><a href="#" class="pull-left">
                                                    <img src="{{ asset('/assets/img/theteam/image8.png') }}" width="35px">
                                                </a></td></td>

                                            <?php

                                            $timeSlots = DB::table('time_slots')->where('id', '=',$result->timeSlot)->get();
                                            foreach ($timeSlots as $timeSlot) {
                                                $time= $timeSlot->start . "-" . $timeSlot->end;

                                            } ?>

                                            <td width="20%">{{ $time }}</td>

                                            <td width="20%">
                                                {{ $result->date }}
                                            </td>

                                            <td width="20%">
                                                <span <?php echo ($result->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $result->count }}</span>
                                            </td>

                                        </tr>
                                        </tbody>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="sample-2d">
                            <table class="table table-hover" class="table table-striped table-bordered">
                                <thead style="background-color: #b48971">
                                <tr style="font-weight: 900 ;color: #eff7ff">
                                    <td></td>
                                    <td>Time Slot</td>
                                    <td>Scheduled Date</td>
                                    <td>Number Of Patients</td>
                                </tr>
                                </thead>
                                @foreach($bloodLabs as $key => $bloodLab)

                                    <tbody>
                                    <tr>

                                        <td width="10%"><a href="#" class="pull-left">
                                                <img src="{{ asset('/assets/img/theteam/image12.png') }}" width="35px">
                                            </a></td></td>

                                        <?php

                                        $timeSlots = DB::table('time_slots')->where('id', '=',$bloodLab->timeSlot)->get();
                                        foreach ($timeSlots as $timeSlot) {
                                            $time= $timeSlot->start . "-" . $timeSlot->end;

                                        } ?>

                                        <td width="20%">{{ $time }}</td>

                                        <td width="20%">
                                            {{ $bloodLab->date }}
                                        </td>

                                        <td width="20%">
                                           <span <?php echo ($bloodLab->count == 0) ? "class='label label-danger'" : "class='label label-warning'"; ?> >
                                                {{ $bloodLab->count }}</span>
                                        </td>

                                    </tr>
                                    </tbody>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>
    @endsection
@section('page_script1')
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery_sortable/sortable.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatable_search/jquery.dataTables.min.js') }}"></script>
@endsection

@section('page_script2')
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                                .search( this.value )
                                .draw();
                    }
                } );
            } );
        } );

        $('#reset_btn').click(function(){
            $('input:text').val('');
            location.reload();
        });
    </script>
@endsection

@endif




@if(\Auth::user()->user_type=="Doctor")

@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        .text-width {
            width: 50%;
        }
    </style>

@endsection



@section('content')

    <div class="container">
        <?php
            $bookings=\App\Booking::all();
        ?>




        <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif


            <h2 style="color: #0a470d">Channeling Requests</h2>
            <br> <br>
            <div class="box box-default">
                <div class="box-header with-border">


                    <table class="table table-striped table-bordered" id="myTable">



                        <thead style="background-color:  #4A9166; color: white; font-size: 110%;">

                        <tr>

                            <td style="width: 10%">Booking ID</td>
                            <td style="width: 10%">Patient ID</td>
                            <td style="width: 25%">Patient Name</td>
                            <td style="width: 25%">Channaling Slot</td>
                            <td>Show</td>


                        </tr>

                        </thead>

                        <tfoot>
                        <tr>
                            <td style="width: 10%">Booking ID</td>
                            <td style="width: 10%">Patient ID</td>
                            <td style="width: 25%">Channaling Slot</td>
                            <td style="width: 25%">Patient Name</td>

                        </tr>
                        </tfoot>

                        <tbody>

                        @foreach($bookings as $key => $booking)

                            <?php
                            $check=null;
                            $schedule_id=$booking->schedule_id;

                            $res =DB::table('e_schedules')->where('schedule_id',$schedule_id)->get();
                            foreach($res as $key => $schedule){
                                $docid=$schedule->doc_id;
                                if(\Auth::user()->user_id==$docid)
                                {
                                    $check=true;
                                }

                            }


                            ?>

                            @if($booking->status==="Initial" && $check===true)
                                <?php
                                $pname=\App\Http\Controllers\DoctorVisitController::getPatientName($booking->patient_id);
                                $slot=\App\Http\Controllers\DoctorVisitController::getChannelingSlot($booking->schedule_id);

                                ?>

                                <tr>

                                    <td>{{ $booking->booking_id }}</td>
                                    <td>{{ $booking->patient_id }}</td>
                                    <td>{{ $pname }}</td>
                                    <td>{{ $slot }}</td>



                                    <!-- we will also add show, edit, and delete buttons -->

                                    <td>







                                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                        <a class="btn btn-small btn-success" href="{{ URL::to('doctorvisits/' . $booking->booking_id) }}">Show Channaling Request</a>
                                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->



                                    </td>


                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <br><br><br><br><br><br><br>

        </div>





    </div>
    <br><br>
@endsection



@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">


        $(function () {
            var dateNow = new Date();
            $('#start_date_picker').datetimepicker({
                useCurrent: false,
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                //defaultDate: moment(dateNow),
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $('#end_date_picker').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                viewMode: 'years',
                format: 'YYYY-MM-DD H:M:s',
                minDate: moment(dateNow)
                //daysOfWeekDisabled: [0, 6]
            });
            $("#start_date_picker").on("dp.change", function (e) {
                $('#end_date_picker').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date_picker").on("dp.change", function (e) {
                $('#start_date_picker').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable( {
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                                .appendTo( $(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                    );

                                    column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
    </script>


@endsection






@endif

@if(\Auth::user()->user_type=="Pharmacy")
@section('page_styles')

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        .text-width {
            width: 50%;
        }
    </style>

@endsection



@section('content')

    <div class="container">



        <br>

        <div class="col-md-12" style="background-color:  #eaffdf">
            <br>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif


            <h1 style="color: #0a470d">Pharmacy</h1>
            <br> <br>

            <div class="box box-default" style="width: 1000px;padding-left: 50px;">
                <div class="box-header with-border">
                    <table><tr><td style="width: 800px">
                                <h3>Add medicines to the cart </h3>
                                <br>
                                <div>
                                    {!! Form::open(['route' => 'medicinecarts.store']) !!}


                                    <div class="form-group">
                                        {!! Form::label('medicine_id', 'Medicine:', ['class' => 'control-label']) !!}
                                        <?php $results = DB::table('medicines')->get(); ?>
                                        <select class="form-control " name="medicine_id" style="width: 50%">
                                            <?php

                                            foreach ($results as $result) {
                                                $id = $result->medicine_id;
                                                $name=$result->medicine_name;
                                                $pric = $result->price;


                                                echo "<option value = '$id' >$name</option >";



                                            }
                                            ?>
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                                        {!! Form::text('amount', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                    </div>


                                    {!! Form::submit('Add to cart', ['class' => 'btn btn-primary']) !!}

                                    {!! Form::close() !!}
                                </div>
                            </td>
                            <td valign="bottom">
                                <?php
                                $id=null;
                                $status=false;
                                $carts=DB::table('medicine_carts')->get();
                                foreach($carts as $car){
                                    $id=$car->id;
                                }
                                if($id!=null)
                                {
                                    $status=true;
                                }
                                ?>
                                @if($status===true)
                                    <div>
                                        <a class="btn btn-small btn-info pull-right" href="{{ URL::to('medicinecarts/create') }}"> Confirm Order</a>
                                    </div>
                                @endif
                            </td></tr></table>


                </div>
            </div>







            <br><br>

            @if($status===true)
                <div style="padding-left: 50px;padding-right: 50px">
                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #2e6da4;color: #FFFFff">
                        <tr>
                            <td>ID</td>
                            <td>Medicine</td>
                            <td>Amount</td>
                            <td>Price</td>
                            <td>Remove</td>

                        </tr>
                        </thead>
                        <tbody>




                        @foreach($carts as $cart)
                            <tr>
                                <td>{{$cart->medicine_id}}</td>
                                <?php

                                $name=null;
                                $meds=DB::table('medicines')->where('medicine_id',$cart->medicine_id)->get();
                                foreach($meds as $med)
                                {
                                    $name=$med->medicine_name;
                                }
                                ?>
                                <td>{{$name}}</td>
                                <td>{{$cart->amount}}</td>
                                <td>{{$cart->price}}.00</td>
                                <td style="width: 100px">


                                    <script>

                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete?");
                                            if (x)
                                                return true;
                                            else
                                                return false;
                                        }

                                    </script>
                                    <table><tr>
                                            <td><a class="btn btn-small btn-info" data-toggle="modal" data-target="#myModal-{{$cart->id}}"  >Change Amount</a></td>

                                            <td style="padding-left: 5px">
                                                {!! Form::model( $cart, [ 'method' => 'DELETE', 'route' => ['medicinecarts.destroy',$cart->id],'onsubmit' => 'return ConfirmDelete()' ,'class'=>'delete']) !!}

                                                <button class='btn btn-danger' type='submit' id="btnDelete" >Delete
                                                </button>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr></table>







                                </td>
                            </tr>

                            <div class="modal fade" id="myModal-{{$cart->id}}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Change Amount</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-header with-border">
                                                {!! Form::model($cart, [
                                                              'method' => 'PATCH',
                                                              'route' => ['medicinecarts.update', $cart->id]
                                                          ]) !!}
                                                <input type="hidden" id="hdn_story_id" name="story_id" value="">

                                                <div class="form-group">
                                                    {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                                                    {!! Form::text('amount', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                                                </div>




                                                {!! Form::submit('Change Amount', ['class' => 'btn btn-primary']) !!}

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach




                        </tbody>
                    </table>
                </div>


                <!-- Modal -->



            @endif











            <br><br><br>


        </div></div>
    <br>
@endsection





@section('page_script2')
    <script src="{{ URL::asset('bootstrap/js/validator.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/validator.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>



    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#myModal').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'fetch_record.php', //Here you will fetch records
                    data :  'rowid='+ rowid, //Pass $id
                    success : function(data){
                        $('.fetched-data').html(data);//Show fetched data from database
                    }
                });
            });
        });
    </script>






@endsection





@endif


@endsection
@endif
