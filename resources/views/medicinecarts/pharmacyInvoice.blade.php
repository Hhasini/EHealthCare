<!doctype html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Medicine Invoice</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .table
        {
            font-family: "Courier New", Courier, monospace;



        }
        .text
        {
            font-family: "verdana", "sans-serif";
        }

    </style>


</head>
<body>
{{--show medical history--}}
<blockquote>
    <div align="center" class="text"><h2>E-CARE HOSPITALS PVT LTD</h2></div>
    <div align="center" class="text"><h2>Pharmacy Invoice</h2></div>

    <hr style=" background-color: #0000cc"/>
</blockquote>




<div class="box box-default" style="width: 1000px;padding-left: 50px;">
    <div class="box-header with-border">

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
        <div style="padding-left: 100px">
            <div>
                <table class="table table-bordered table-striped" >
                    <tr  >
                        <td style="width: 300px"><b>Payment ID </b></td>
                        <td>: {{$payment_id}}</td>

                    </tr>
                    <tr >
                        <td style="width: 300px"><b>Payment Date </b></td>
                        <td>: {{$pay_day}}</td>
                    </tr>
                    <tr >
                        <td style="width: 300px"><b>Patient Name </b></td>
                        <td>: {{$patient_name}}</td>

                    </tr>
                    <tr >
                        <td style="width: 300px"><b>Sold To </b></td>
                        <td>: {{$sold}}</td>
                    </tr>

                    <tr >
                        <td style="width: 300px"><b>Referenced Doctor </b></td>
                        <td>: {{$doc}}</td>
                    </tr>


                </table>





                <br>

                <table class="table table-striped table-bordered" style="width: 700px" >
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
            </div>
        </div>


























    </div></div>





<p>&nbsp;</p>

</body>
</html>