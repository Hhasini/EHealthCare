<!doctype html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Medical History Report</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .table
        {
            font-family: Calibri;

        }

    </style>

    <?php
    use Illuminate\Support\Facades\DB;
    $doctor=DB::table('doctors')
            ->where('doctor_id',\Auth::user()->user_id)
            ->get();
    foreach($doctor as $key=>$doc)
    {
        $doc_name=$doc->name;
        $doc_spec=$doc->specialty;
        $doc_mail=$doc->email;

    }
    ?>
</head>
<body>
{{--show medical history--}}
<blockquote>
    <table>
        <tr>
            <td width="500px">
                <h2 style="color: #0000cc; font-family: Calibri;">Medical History Report </h2>
            </td>
            <td >
                <h2 style="color: #0000cc; font-family: Calibri;padding-left: 300px "><?php echo date("Y-m-d");?> </h2>
            </td>
        </tr>
    </table>
    <hr style=" background-color: #0000cc"/>
</blockquote>

<h4 style="padding-left: 40px; font-family: Calibri;">Patient Details</h4>
<table class=" table table-bordered" style="padding-left: 40px">

    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Patient ID</td>
        <td colspan="2">: {{$patient->id}}</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Patient Name</td>
        <td colspan="2">: {{$patient->name}}</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">NIC</td>
        <td colspan="2">: {{$patient->nic}}</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Address</td>
        <td colspan="2">: {{$patient->address}}</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Email</td>
        <td colspan="2">: {{$patient->email}}</td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Phone</td>
        <td colspan="2">: {{$patient->phone}}</td>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Sex</td>
        <td colspan="2">: {{$patient->sex}}</td>
        <td>&nbsp;</td>
    </tr>

</table>

<h4 style="padding-left: 40px; font-family: Calibri;">Diagnosed By :</h4>

<table class=" table table-bordered" style="padding-left: 40px">

    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">Dr.{{$doc_name}}</td>

        <td>&nbsp;</td>
    </tr>

    <tr>
        <td width="20">&nbsp;</td>
        <td width="144">{{$doc_spec}}</td>

        <td>&nbsp;</td>
    </tr>



</table>
<div class="page-break"></div>
<h4 style="padding-left: 40px ;font-family: Calibri;">Medical History</h4>


    <?php

    $visits=DB::table('doctor_visits')
            ->whereDoctor_idAndPatient_id(\Auth::user()->user_id,$patient->id)

            ->orderBy('visit_date', 'desc')
            ->get();
    ?>
    @foreach($visits as $key=>$visit)

        <table class=" table table-bordered" style="padding-left: 40px; ">
        <tr>
            <td width='20'>&nbsp;</td>
            <td  width='144'><b>{{$visit->visit_date}}</b></td>
            <td>&nbsp;</td>
        </tr>
            <br>

        <tr>
            <td width='20'>&nbsp;</td>
            <td valign='top' style='padding-left: 50px' width='200'>History </td>
            <td width='450'>: {{$visit->family_history}}</td>
            <td>&nbsp;</td>
        </tr>


        <tr>
            <td width='20'>&nbsp;</td>
            <td valign='top'  style='padding-left: 50px' width='200'>Diagnosis Details </td>
            <td width='450'>: {{$visit->diagnosis_notes}}</td>
            <td>&nbsp;</td>
        </tr>


        <tr>
            <td width='20'>&nbsp;</td>
            <td valign='top'  style='padding-left: 50px' width='200'>Prescription </td>
            <td width='450'>: {{$visit->prescription}}</td>
        </tr>






        <?php
        $hasChkup=\App\Http\Controllers\DoctorVisitController::hasCheckup($visit->id);
        $checkup_ids = array();
        $checkup_names = array();

        if($hasChkup==true)
        {
            $recommendations = DB::table('recommend_checkups')->where('visit_id',$visit->id)->get();



            foreach ($recommendations as $rec) {
                array_push($checkup_ids, $rec->checkup_id);
            }
            for($i=count($checkup_ids);$i>0;$i--)
            {
                $med = DB::table('medical_checkups')->where('checkup_id',$checkup_ids[$i-1])->get();

                foreach ($med as $m) {
                    array_push( $checkup_names, $m->checkup_name);
                }
            }
        }
        ?>

        <tr>
            <td width='20'>&nbsp;</td>
            <td valign='top'  style='padding-left: 50px' width='200'>Recommended Checkups  </td>
            <td style="width: 50px">:
            @for($i=count($checkup_names);$i>0;$i--)

                  {{$checkup_names[$i-1]}}<br>

            @endfor
            </td>
        </tr>


        </table>

        <div class="page-break"></div>
    @endforeach








<p>&nbsp;</p>

</body>
</html>