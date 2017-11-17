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

                <br>
            <h2 style="color: #0a470d">Recommend Medical Checkups</h2>
            <br>
            <div class="box box-default">
                <div class="box-header with-border" style="padding-left: 50px">


                        <?php


                        $recommendations = DB::table('recommend_checkups')->where('visit_id',$visit->id)->get();


                        $checkup_ids = array();
                        foreach ($recommendations as $rec) {
                            array_push($checkup_ids, $rec->checkup_id);
                        }

                        $checkups = DB::table('medical_checkups')->select('checkup_name','checkup_id')->get();
                        $checkups_assigned=array();
                        foreach ($checkups as $chk) {
                            if (in_array($chk->checkup_id, $checkup_ids)) {
                                $checkups_assigned[$chk->checkup_id] = "checked";
                            } else {
                                $checkups_assigned[$chk->checkup_id] = "";
                            }
                        }
                        ?>

                            {!! Form::model( $visit, [
                                                                    'method' => 'PATCH',
                                                                    'route' => ['recommendcheckups.update',$visit->id]
                                                                ]) !!}



                            @foreach ($checkups as $chk)
                                <input tabindex="1" type="checkbox" name="checkups[]" id="{{$chk->checkup_id}}"
                                       value="{{$chk->checkup_id}}" <?php echo strcmp($checkups_assigned[$chk->checkup_id], "checked") == 0 ? 'checked="checked"' : ''; ?>/> {{$chk->checkup_name}}
                                <br/>
                            @endforeach

                            <br>
                            <br>

                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                            <br>


                                <form class="delete" action="{{ route('recommendcheckups.destroy', $visit->id) }}" method="POST" id="FoodList-del-frm">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <a title="" data-original-title="" class="btn btn-large btn-danger"
                                       data-toggle="confirmation"><i class='glyphicon glyphicon-trash'></i> Delete All Checkups </a>
                                </form>










                    <br><br><br><br>

                </div>
            </div>





        </div>





    </div>
    <br><br><br><br>
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

    <script src="{{ URL::asset('bootstrap/js/bootstrap-confirmation.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap-tooltip.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {


            $('[data-toggle="confirmation"]').confirmation({
                btnOkLabel: "Yes", btnCancelLabel: "No",
                onConfirm: function (event) {
                    $('#FoodList-del-frm').submit();
                }
            });
        });
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

