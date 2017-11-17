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
            <?php
                use Illuminate\Support\Facades\DB;

                $booking_id=null;
                $booking=DB::table('doctor_visits')->where('id',$visit->id)->get();
                foreach($booking as $book)
                {
                    $booking_id=$book->booking_id;
                }
            ?>
            <br>
            <a class="btn btn-small btn-info" href="{{ route('doctorvisits.show',$booking_id) }}">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>
            <br> <br>

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


            <h2 style="color: #0a470d">Update Diagnosis Details</h2>
            <br> <br>
            <div class="box box-default">
                <div class="box-header with-border" style="padding-left: 50px">
                    {!! Form::model($visit, [
                                  'method' => 'PATCH',
                                  'route' => ['diagnosisupdates.update', $visit->id]
                              ]) !!}



                    <div class="form-group">
                        {!! Form::label('family_history', 'Family History:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('family_history', null, ['class' => 'form-control' , 'style' => 'width:70%;','size' => '20x5']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('diagnosis_notes', 'Diagnosis Notes:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('diagnosis_notes', null, ['class' => 'form-control' , 'style' => 'width:70%;','size' => '20x5']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('prescription', 'Prescription:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('prescription', null, ['class' => 'form-control' , 'style' => 'width:70%;','size' => '20x5']) !!}
                    </div>









                    {!! Form::submit('Update Diagnosis Details', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                    <br> <br>
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




