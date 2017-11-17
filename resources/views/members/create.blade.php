
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

                                    <?php
                                    use Illuminate\Support\Facades\DB as DB;
                                    use App\Http\Controllers\MemberController;

                                        $member_id=MemberController::generateMemberID();


                                    ?>
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


            <h2 style="color: #0a470d;">Member Registration</h2>
            <br>
            <div class="box box-default">
                <div class="box-header with-border">
                    <table>
                        <tr>
                            <td style="width: 30%">
                                <div style="padding-left: 50px">

                                {!! Form::open(['route' => 'members.store']) !!}

                                {{--<div class="form-group">
                                    {!! Form::label('member_id', 'Member ID:', ['class' => 'control-label']) !!}
                                    {!! Form::text('member_id', $member_id, ['class' => 'form-control' , 'style' => 'width:50%;','readonly'=>'true']) !!}
                                </div>--}}
                                    <div class="form-group">
                                        {!! Form::hidden('member_id', $member_id) !!}
                                    </div>

                                    {{--<div class="form-group">
                                        <label class="col-md-4 control-label">Member ID</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" readonly="true" name="member_id" value="{{ $member_id }}">
                                        </div>
                                    </div>--}}


                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <div style="width: 90%">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" control-label">E-Mail Address</label>
                                        <div style="width: 90%">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" control-label">NIC</label>
                                        <div style="width: 90%">
                                            <input type="text" class="form-control" name="nic">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                                        <div style="width: 90%">
                                            {!! Form::textarea('address', null, ['class' => 'form-control','style' => 'height:120px;']) !!}
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class=" control-label">Phone</label>
                                        <div style="width: 90%">
                                            <input type="text" class="form-control" name="phone">
                                        </div>
                                    </div>

                                    {{--<div class="form-group">
                                        <label class="col-md-4 control-label">Address</label>
                                        <div class="col-md-6" style="height: 5%" >
                                            <input type="textarea" class="form-control" name="address">
                                        </div>
                                    </div>--}}








                                    <div class="form-group">
                                        <label class=" control-label">Password</label>
                                        <div style="width: 90%">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class=" control-label">Confirm Password</label>
                                        <div style="width: 90%">
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>




                                {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}
                                </div>
                            </td>
                            <td valign="top" style="width: 20%">
                                <div style="padding-top: 100px;padding-left: 90px"><img src="{{ URL::asset('images/member.png')}}" class="user-image" alt="User Image" ></div>
                            </td>
                        </tr>
                    </table>


                    <br><br>


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




