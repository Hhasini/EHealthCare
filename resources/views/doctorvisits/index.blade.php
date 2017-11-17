@extends('app')

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


    {{--@section('page_script2')
            <!--script type="text/javascript"
            src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>


    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>
@endsection--}}

