<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Full Blood Count</title>
</head>
<body>
<blockquote>
    <h2>The Complete Blood Count Sample Report</h2>
</blockquote>
<hr />
<table width="500">
    <tr>
        <td height="39">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="96">&nbsp;</td>
        <td width="144">Enter date</td>
        <td colspan="2">: {{$enterDate}}</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Patient Name</td>
        <td colspan="2">: {{$pid}}</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Patient NIC Number</td>
        <td colspan="2">: {{$pNic}}</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Sex</td>
        <td colspan="2">: {{$pSex}}</td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td height="43">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>White Blood Cell (WBC)</td>
        <td colspan="2">: {{$wbc}} K/mcL</td>
        <td>4.8-10.8</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Red Blood Cell (RBC)</td>
        <td colspan="2">: {{$rbc}} M/mcL</td>
        <td>4.7-6.1</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Hemoglobin (HB/Hgb)</td>
        <td colspan="2">: {{$hgb}} g/dL</td>
        <td>14.0-18.0</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Platelet count</td>
        <td colspan="2">: {{$platelet}} K/mcL</td>
        <td>150-450</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Neutrophil (Neut)</td>
        <td colspan="2">: {{$neut}} %</td>
        <td>33-73</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Lymphocyte (Lymph)</td>
        <td colspan="2">: {{$lymph}} %</td>
        <td>13-52
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Monocyte (Mono)</td>
        <td colspan="2">: {{$mono}} %</td>
        <td>0-10</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Eosinophil (Eos)</td>
        <td colspan="2">: {{$eos}} %</td>
        <td>0-5</td>
    </tr>

    <tr>
        <td height="210" colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">{{$today}}</td>
        <td width="50">&nbsp;</td>
        <td width="50">&nbsp;</td>
        <td>E Health Care System</td>
    </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>