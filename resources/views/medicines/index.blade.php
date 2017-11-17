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
            <br>


            <h1 style="color: #0a470d">Medicines</h1>
            <a class="btn btn-small btn-info pull-right" href="{{ URL::to('medicines/create') }}"> Add new medicine</a>
            <div class="box box-default">
                <div class="box-header with-border">

                    <br> <br><br>

                    <div>
                        <table class="table table-striped table-bordered" id="myTable">



                            <thead style="background-color:  #4A9166; color: white; font-size: 110%;">

                            <tr>

                                <td style="width: 100px">ID</td>
                                <td style="width: 300px">Medicine</td>
                                <td style="width: 300px">Active Ingredients</td>
                                <td style="width: 300px">Manufacturer</td>
                                <td style="width: 200px">Unit Price</td>
                                <td style="width: 100px">Show / Edit / Delete</td>


                            </tr>

                            </thead>



                            <tbody>
                                   @foreach($medicines as $medicine)

                                    <tr>

                                        <td>{{ $medicine->medicine_id }}</td>
                                        <td>{{ $medicine->medicine_name }}</td>
                                        <td>{{ $medicine->description }}</td>
                                        <td>{{ $medicine->manufacturer }}</td>
                                        <td>{{ $medicine->price }}.00</td>



                                        <!-- we will also add show, edit, and delete buttons -->

                                        <td>



                                        <table>
                                            <tr>
                                                <td> <a class="btn btn-small btn-success" href="{{ URL::to('medicines/' . $medicine->medicine_id) }}"> Show </a></td>
                                                <td style="padding-left: 0px"> <a class="btn btn-small btn-info" href="{{ URL::to('medicines/' . $medicine->medicine_id . '/edit') }}"> Edit </a></td>
                                                <td style="padding-left: 0px">
                                                    {!! Form::model( $medicine, [ 'method' => 'DELETE', 'route' => ['medicines.destroy',$medicine->medicine_id],'onsubmit' => 'return ConfirmDelete()' ,'class'=>'delete']) !!}

                                                    <button class='btn btn-danger' type='submit' id="btnDelete" >Delete
                                                    </button>

                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        </table>












                                    </tr>




                                       @endforeach


                            </tbody>
                        </table>
<br>

                                </div>
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
        $(document).ready(function(){
            $('#myTable').dataTable();
        });
    </script>

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



@endsection




