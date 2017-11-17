<!doctype html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Prescription</title>
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
    <div align="center" class="text"><h2>Prescription</h2></div>

    <hr style=" background-color: #0000cc"/>
</blockquote>




<div class="box box-default" style="width: 1000px;padding-left: 50px;">
    <div class="box-header with-border">

        <br>


        <?php


        $visits=DB::table('doctor_visits')
                ->get();

        $visit_id=null;
        foreach($visits as $visit)
        {
            $visit_id=$visit->id;
        }

        $lastvisits=DB::table('doctor_visits')
                ->where('id',$visit_id)
                ->get();

        $pres=null;
        $patient_id=null;
        $doc_id=null;

        foreach($lastvisits as $lst)
        {  $patient_id=$lst->patient_id;
            $doc_id=$lst->doctor_id;
            $daate=$lst->visit_date;
            $pres=$lst->prescription;


        }
        $patients=DB::table('patients')
                ->where('id',$patient_id)
                ->get();

        $patient_name=null;

        foreach($patients as $patient)
        {  $patient_name=$patient->name;

        }

        $docs=DB::table('doctors')
                ->where('doctor_id',$doc_id)
                ->get();

        $doc_name=null;
            $spec=null;

        foreach($docs as $doc)
        {  $doc_name=$doc->name;
            $spec=$doc->specialty;
        }

            $arr=array();
            $arr=\App\Http\Controllers\DoctorVisitController::getPrescription($pres);

        ?>
        <div style="padding-left: 100px">
            <div>
                <table class="table table-bordered table-striped" >
                    <tr  >
                        <td style="width: 300px"><b>Patient ID </b></td>
                        <td>: {{$patient_id}}</td>

                    </tr>
                    <tr >
                        <td style="width: 300px"><b>Patient Name </b></td>
                        <td>: {{$patient_name}}</td>
                    </tr>
                    <tr >
                        <td style="width: 300px"><b>Date </b></td>
                        <td>: {{$daate}}</td>



                </table>





                <br>

                <table class="table table-bordered table-striped" >
                    <tr  >

                        <td style="width: 300px"><b>Rx </b></td>

                    </tr>
                    @for($i=0;$i<count($arr);$i++)
                        <tr  >

                            <td style="padding-left: 30px">{{$i+1}}.{{$arr[$i]}}</td>

                        </tr>
                        <br>
                    @endfor



                </table>
                <br><br>
                <table class="table table-bordered table-striped" >

                    <tr  >

                        <td style="width: 300px"><b>Dr. {{$doc_name}} </b></td>

                    <tr  >


                        <td style="width: 300px"><b>{{$spec}} </b></td>
                    </tr>

                </table>


            </div>
        </div>


    </div></div>





<p>&nbsp;</p>

</body>
</html>