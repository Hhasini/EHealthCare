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
            <a class="btn btn-small btn-info" href="{{ route('medicines.index') }}">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>
            <br><br>

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


            <h2 style="color: #0a470d">Add new medicine</h2>
            <br> <br>
            <div class="box box-default">
                <div class="box-header with-border">
                    <div>
                        {!! Form::open(['route' => 'medicines.store']) !!}

                        <div class="form-group">
                            {!! Form::label('medicine_name', 'Medicine Name', ['class' => 'control-label']) !!}
                            {!! Form::text('medicine_name', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Active Ingredients', ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control' , 'style' => 'width:50%;','size' => '20x5']) !!}
                         </div>


                        <div class="form-group">
                            {!! Form::label('manufacturer', 'Manufacturer', ['class' => 'control-label']) !!}
                            {!! Form::text('manufacturer', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Unit Price', ['class' => 'control-label']) !!}
                            {!! Form::text('price', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                        </div>






                        {!! Form::submit('Add Medicine', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                    </div>
                    <br>




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




