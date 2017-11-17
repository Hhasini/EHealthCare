<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
</head>
<body>
<blockquote>
  <h2>Payment Invoice : {{$id}}</h2>
</blockquote>
<hr />
<table width="602" >
  <tr>
    <td height="39">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="96">&nbsp;</td>
    <td width="144">Patient Name</td>
    <td colspan="2">: {{$name}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Test Type</td>
    <td colspan="2">: {{$desc}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="43">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Amount</td>
    <td colspan="2">: Rs. {{$amount}}/=</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Payment Date</td>
    <td colspan="2">: {{$date}}</td>
  </tr>
  <tr>
    <td height="210" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">{{$today}}</td>
    <td width="160">&nbsp;</td>
    <td width="182">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>