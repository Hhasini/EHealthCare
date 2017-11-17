@extends('app')

@section('page_styles')
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
@endsection

<?php

$id = $_GET['id'];
$resultList = DB::table('patient_schedules')->where('id', '=' ,$id )->get();
foreach ($resultList as $result) {
    $schedule_id = $result->scheduleId;
    $visit_id = $result->bookingID;
}

$checkupList = DB::table('medical_checkups')->get();
$addedCheckupList = DB::table('recommend_checkups')->where('id', '=' ,$visit_id )->get();
foreach ($addedCheckupList as $result) {
    $v_id= $result->visit_id;
    $cId = $result->checkup_id;
}

$cpLists = DB::table('medical_checkups')->where('checkup_id', '=',$cId)->get();
foreach ($cpLists as $cpList) {
    $cName= $cpList->checkup_name;
}

$dcVisitLists = DB::table('doctor_visits')->where('id', '=',$v_id)->get();
foreach ($dcVisitLists as $dcVisitList) {
    $pid= $dcVisitList->patient_id;
}

$patientLists = DB::table('patients')->where('id', '=',$pid)->get();
foreach ($patientLists as $patientList) {
    $pName= $patientList->name;
}

$rcLists = DB::table('checkup_shedules')->where('id', '=',$schedule_id)->get();
foreach ($rcLists as $rcList) {
    $rid= $rcList->resourceId;
    $tid = $rcList->timeSlot;
}

$resources = DB::table('resources')->where('id', '=',$rid)->get();
foreach ($resources as $resource) {
    $labName= $resource->name;
}

$timeSlots = DB::table('time_slots')->where('id', '=',$tid)->get();
foreach ($timeSlots as $timeSlot) {
    $time= $timeSlot->start . "-" . $timeSlot->end;
}

?>

@section('content')

    <div class="container">
        <div class="box box-default" style="min-height: 300px; padding: 5px;">
            <div class="box-header with-border">

                <br>
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif



                <br>

                <a class="btn btn-small btn-success pull-right" href="{{ URL::to('patient_schedules/viewScheduledCheckups') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> go back</a>

                <br><br>

                <legend>Make Your Payment:</legend>

                <div class="row">
                    <div class="col-sm-5">
                        <h4>Add payment:</h4>
                        <div class="panel panel-default">
                            <div class="panel-body form-horizontal payment-form">

                                {!! Form::open(['route' => 'checkup_payments.store']) !!}

                                <input type="hidden" class="form-control" id="scheduleId" name="scheduleId" value="<?php echo $id ?>" readonly>
                                <input type="hidden" class="form-control" id="patientId" name="patientId" value="<?php echo $pid ?>" readonly>

                                <div class="form-group">
                                    <label for="date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                                    </div>
                                </div>

                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="#" data-toggle="modal" data-target="#work-flow"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span></span>Medical Checkup Price List</a>
                                    </li>
                                </ul>
                                <br/>
                                {!! Form::submit('Pay', ['class' => 'btn btn-success btn-lg btn-block' , 'role'=>'button']) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <h4 style="color: #0c0c0c">Preview:</h4>

                        <?php
                        $payment_id = 0;
                        $payment_amount = 0;
                        $payment_status = "PENDING";
                        $paymentLists = DB::table('checkup_payments')->where('patientId', '=' ,$pid )->where('scheduleId','=',$id)->get();

                        foreach ($paymentLists as $paymentList) {
                            $payment_id = $paymentList->pid;
                            $payment_amount = $paymentList->amount;
                            $payment_status = "PAID";
                        }
                        ?>

                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-6 margin-bottom-20">
                                    <h4 class="margin-bottom-10" style="color: #0c0c0c">Booking Details</h4>
                                    <ul class="menu">
                                        <li>
                                            <h4 style="font-size:small">Patient Name</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">Checkup Name</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">Venue (Laboratory)</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">Time Slot</h4>
                                        </li>
                                        @if($payment_id != 0)
                                        <li>
                                            <h4 style="font-size:small">Amount</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">Status</h4>
                                        </li>
                                        @endif
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-6 margin-bottom-20">
                                    <h4 class="margin-bottom-10" style="color: #faffe7">&nbsp;&nbsp;&nbsp;</h4>
                                    <ul class="menu">
                                        <li>
                                            <h4 style="font-size:small">{{ $pName  }}</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">{{ $cName }}</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">{{ $labName  }}</h4>
                                        </li>
                                        <li>
                                            <h4 style="font-size:small">{{$time}}</h4>
                                        </li>
                                        @if($payment_id != 0)
                                            <li>
                                                <h4 style="font-size:small">{{ $payment_amount  }}</h4>
                                            </li>
                                            <li>
                                                <h4 style="font-size:small">{{ $payment_status }}</h4>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="row">
                                @if($payment_id == 0)
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Sorry!</strong> Please add Your Payment to print payment receipt.
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div id="work-flow" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Price list for Checkup Details</h4>
                            </div>
                            <div class="modal-body" style="background-color: #A8F99F">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <div class="row">
                                            <div class="col-md-6 margin-bottom-20">
                                                <h3 class="margin-bottom-10">Checkup Name</h3>
                                                <ul class="menu">
                                                    @foreach($checkupList as $key => $list)
                                                        <li>
                                                            <a class="fa-tasks" href="#">{{ $list->checkup_name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-md-6 margin-bottom-20">
                                                <h3 class="margin-bottom-10">Price</h3>
                                                <ul class="menu">
                                                    <li>
                                                        <a  href="#">1000.00</a>
                                                    </li>
                                                    <li>
                                                        <a  href="#">1050.00</a>
                                                    </li>
                                                    <li>
                                                        <a  href="#">1200.00</a>
                                                    </li>
                                                    <li>
                                                        <a  href="#">1560.78</a>
                                                    </li>
                                                    <li>
                                                        <a  href="#">20098.00</a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Session::has('flash_message'))
                    <script>
                        $(function () {
                            $('#result-model-title').html('Message');
                            $('#result-modal').modal('show');
                        });
                    </script>
                @endif

                <div id="result-modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <div id="result-model-title">Message</div>
                                </h4>
                            </div>
                            <div class="modal-body">

                                @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('flash_message') }}
                                    </div>
                                @endif
                                        <a class="btn btn-info btn-block"
                                           href="{{ url('checkup_payments/report/'.$payment_id) }}" target="_blank">Print Your Receipt</a>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                            </div>
                        </div>

                    </div>
                </div>

                <br><br><br><br><br><br><br><br>

            </div>
        </div>
@endsection

@section('page_script2')
    <script type="text/javascript">
        var today = new Date().toISOString().slice(0, 10);
        $('#date').attr('min', today);

        function calc_total() {
            var sum = 0;
            $('.input-amount').each(function () {
                sum += parseFloat($(this).text());
            });
            $(".preview-total").text(sum);
        }

        $(document).on('click', '.input-remove-row', function () {
            var tr = $(this).closest('tr');
            tr.fadeOut(200, function () {
                tr.remove();
                calc_total()
            });
        });

        $(function () {
            $('.preview-add-button').click(function () {
                var form_data = {};
                form_data["concept"] = $('.payment-form input[name="concept"]').val();
                form_data["description"] = $('.payment-form input[name="description"]').val();
                form_data["amount"] = parseFloat($('.payment-form input[name="amount"]').val()).toFixed(2);
                form_data["status"] = $('.payment-form #status option:selected').text();
                form_data["date"] = $('.payment-form input[name="date"]').val();
                form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
                var row = $('<tr></tr>');
                $.each(form_data, function (type, value) {
                    $('<td class="input-' + type + '"></td>').html(value).appendTo(row);
                });
                $('.preview-table > tbody:last').append(row);
                calc_total();
            });
        });
    </script>
@endsection