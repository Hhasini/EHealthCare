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



            <h1 style="color: #0a470d">Patients</h1>
            <br> <br>
            <div class="box box-default">
                <div class="box-header with-border">


                    <table class="table table-striped table-bordered" id="myTable">



                        <thead style="background-color:  #4A9166; color: white; font-size: 110%;">

                        <tr>

                            <td style="width: 10%">ID</td>
                            <td style="width: 25%">Patient Name</td>
                            <td style="width: 25%">NIC</td>
                            <td style="width: 25%">Address</td>

                            <td style="width: 25%">Phone</td>
                            <td style="width: 10%">Sex</td>
                            <td style="width: 10%">Show</td>


                        </tr>

                        </thead>

                        <tfoot>
                        <tr>

                            <td style="width: 5%">Patient ID</td>
                            <td style="width: 20%">Patient Name</td>
                            <td style="width: 20%">NIC</td>
                            <td style="width: 20%">Address</td>

                            <td style="width: 20%">Phone</td>
                            <td style="width: 10%">Sex</td>
                            <td style="width: 10%">Show</td>


                        </tr>
                        </tfoot>

                        <tbody>



                            <?php

                            use Illuminate\Support\Facades\DB as DB;
                            use App\Http\Controllers\Auth;

                                    $patients=array();
                                $pa_id=null;


                            $pids=DB::table('doctor_visits')
                                    ->select('patient_id')
                                    ->where('doctor_id', \Auth::user()->user_id)
                                    ->groupBy('patient_id')
                                    ->get();

                            foreach($pids as $key => $pid){
                                $id=$pid->patient_id;
                                $patients=DB::table('patients')
                                        ->where('id', $id)
                                        ->get();
                                foreach($patients as $keys => $patient){
                                    $pa_id=$patient->id;
                                    $url="patientlist/[ $pa_id]";
                                    echo"<tr>
                                <td>$patient->id</td>
                                <td>$patient->name</td>
                                <td>$patient->nic</td>
                                <td>$patient->address</td>

                                <td>$patient->phone</td>
                                <td>$patient->sex</td>
                                <td> <a class='btn btn-small btn-success' href='".url('patientlist/'.$pa_id)."'>Show</a> </td></tr>
                                ";





                                }

                            }













                            ?>


                        </tbody>
                    </table>
                    <br><br><br><br>
                </div>
            </div>





        </div>





    </div>
    <br>
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



