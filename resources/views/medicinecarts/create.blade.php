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
            <a class="btn btn-small btn-info" href="{{ route('medicinecarts.index') }}">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>back</a>
            <br>
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

        <?php
                $status=false;
                $crt_id=null;
                $crts=DB::table('medicine_carts')->get();
                foreach($crts as $crt)
                {
                    $crt_id=$crt->id;
                }
                if($crt_id!=null)
                {
                    $status=true;
                }
            ?>

            @if($status===true)
                <div class="box box-default" style="width: 1000px;padding-left: 50px;">
                    <div class="box-header with-border">
                        <h3 style="color: #0a470d">Order Summary</h3>
                        <br>

                        <?php

                        $carts=DB::table('medicine_carts')->get();
                        $total=\App\Http\Controllers\MedicineCartController::calcTotal();
                        ?>
                        <table class="table table-striped table-bordered" style="width: 500px" >
                            <thead>
                            <tr>
                                <td><b>Medicine</b></td>
                                <td><b>Amount</b></td>
                                <td><b>Price</b></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                                <tr>
                                    <?php
                                    $result=DB::table('medicines')->where('medicine_id',$cart->medicine_id)->get();
                                    foreach($result as $res )
                                    {
                                        $name=$res->medicine_name;
                                    }
                                    ?>
                                    <td>{{$name}}</td>
                                    <td>x {{$cart->amount}}</td>
                                    <td align="right" >{{$cart->price}}.00</td>
                                </tr>

                            @endforeach
                            <tr><td><b>Total Price</b></td>
                                <td></td>
                                <td align="right" ><b>{{$total}}.00</b></td></tr>
                            </tbody>
                        </table>
                        <br>
                        <h3 style="color: #0a470d">Payment Details</h3>
                        <br>
                        <div>
                            {!! Form::open(['route' => 'medicinecarts.storeDetails']) !!}

                            <div class="form-group">
                                {!! Form::label('pname', 'Patient Name', ['class' => 'control-label']) !!}
                                {!! Form::text('pname', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('sold', 'Sold To', ['class' => 'control-label']) !!}
                                {!! Form::text('sold', null, ['class' => 'form-control', 'style' => 'width:50%;']) !!}
                            </div>


                            <div class="form-group">
                                {!! Form::label('doctor', 'Referenced Dr.', ['class' => 'control-label']) !!}
                                <?php $results = DB::table('doctors')->get(); ?>
                                <select class="form-control " name="doctor" style="width: 50%">
                                    <?php

                                    foreach ($results as $result) {

                                        $name=$result->name;


                                        echo "<option value = '$name' >$name</option >";



                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="form-group">
                                <label class="control-label">Amount </label>

                                <input type="text" style="width: 50%" class="form-control" {{--readonly="true"--}}  name="amount" value="{{ $total }}">

                            </div>


                            {!! Form::submit('Add Payment', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <br>





















                    </div></div>

            @endif

                @if($status===false)
                <div class="box box-default" style="width: 1000px;padding-left: 50px;">
                    <div class="box-header with-border">
                        <h3 style="color: #0a470d">Payment Summary</h3>
                        <br>


                        <?php


                        $pays=DB::table('pharmacy_payments')
                                ->get();

                        $pay_id=null;
                        foreach($pays as $pay)
                        {
                            $pay_id=$pay->id;
                        }

                        $lastpays=DB::table('pharmacy_payments')
                                ->where('id',$pay_id)
                                ->get();

                        foreach($lastpays as $lst)
                        {  $payment_id=$lst->id;
                            $patient_name=$lst->patient_name;
                            $sold=$lst->sold_to;
                            $doc=$lst->doctor_name;
                            $amt=$lst->amount;
                            $pay_day=$lst->payment_date;

                        }
                        $pur_meds=DB::table('purchase_medicines')
                                ->where('payment_id',$pay_id)
                                ->get();

                        $pur_tot=\App\Http\Controllers\MedicineCartController::calcTotalPurchase($pay_id);

                        ?>
                        <table><tr><td>
                                    <table class="table" style="width: 500px">
                                        <tr style="background-color: #33FFD1  "  >
                                            <td><b>Payment ID </b></td>
                                            <td>{{$payment_id}}</td>
                                        </tr>
                                        <tr style="background-color: #FFFFFF">
                                            <td><b>Patient Name </b></td>
                                            <td>{{$patient_name}}</td>
                                        </tr>
                                        <tr style="background-color: #33FFD1  ">
                                            <td><b>Sold To </b></td>
                                            <td>{{$sold}}</td>
                                        </tr>
                                        <tr style="background-color: #FFFFFF">
                                            <td><b>Referenced Dr </b></td>
                                            <td>{{$doc}}</td>
                                        </tr>
                                        <tr style="background-color: #33FFD1  ">
                                            <td><b>Amount </b></td>
                                            <td>{{$amt}}.00</td>
                                        </tr>
                                        <tr style="background-color: #FFFFFF">
                                            <td><b>Payment Date </b></td>
                                            <td>{{$pay_day}}</td>
                                        </tr>
                                    </table>

                                </td>
                            <td valign="top" style="padding-left: 120px">
                                <a class="btn btn-small pull-right" style="background-color: #1b1cff;color: white;" href="{{ url('medicinecarts/pharmacyInvoice/'.$payment_id) }}"  >Print Invoice</a>

                            </td>
                            </tr></table>



                        <br>
                        <h4 style="color: #0a470d">Medicines Issued</h4>
                        <table class="table table-striped table-bordered" style="width: 500px" >
                            <thead style="background-color: #328557  ;color: #FFFFFF  ">
                            <tr>
                                <td><b>Medicine</b></td>
                                <td><b>Amount</b></td>
                                <td><b>Price</b></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pur_meds as $pur_med)
                                <tr>
                                    <?php
                                    $result=DB::table('medicines')->where('medicine_id',$pur_med->medicine_id)->get();
                                    foreach($result as $res )
                                    {
                                        $name=$res->medicine_name;
                                    }
                                    ?>
                                    <td>{{$name}}</td>
                                    <td>x {{$pur_med->amount}}</td>
                                    <td align="right" >{{$pur_med->price}}.00</td>
                                </tr>

                            @endforeach
                            <tr><td><b>Total Price</b></td>
                                <td></td>
                                <td align="right" ><b>{{$pur_tot}}.00</b></td></tr>


                            </tbody>
                        </table>
























                    </div></div>

                @endif



            </div></div>
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




