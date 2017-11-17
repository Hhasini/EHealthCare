<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
</head>
<body>
<blockquote>
    <h2>Fasting Blood Report </h2>
</blockquote>
<hr />
<table width="602" >
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
        <td>Fasting Blood Sugar Amount</td>
        <td colspan="2">: {{$fbs}} mg</td>
        <td>4.8-10.8 mg</td>
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