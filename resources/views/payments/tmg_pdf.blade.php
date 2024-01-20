<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
th {
  text-align: left;
}
/* header img {
  width: 100%;
} */
</style>
</head>
<body>
<header style="font-size: 20px; font-family: arial; margin-left: 30px;margin-top: 15px;"> 
  <!-- <img src="img/letter_head.jpg"> -->
</header>
<table style="width:100%">
  <caption>SHYAM CORPOATION GSC571</caption>
  <tr>
    <th colspan="7" style="text-align: center;">PAYMENT SUMMERY -25-02-2020	</th>
  </tr>
  <tr>
    <th colspan="7">SAURASHTRA CEMENT LTD</th>
  </tr>
  <tr>
    <th>Sr No</th>
    <th>CH/RTGS NO</th>
    <th>Amount</th>
    <th>Code</th>
    <th>Name</th>
    <th>Bank Name</th>
    <th>Remarks</th>
  </tr>
  @php $totalAmount = 0; @endphp
  @foreach($payments as $payment)
  <?php
    $totalAmount += $payment->amount;
    if(!empty($payment->payment_mode == 2)) {
      $cheque_rtgs_no = "RTGS - ". $payment->cheque_rtgs_no;
    } else if($payment->payment_mode == 3){
      $cheque_rtgs_no = "Cheque - ". $payment->cheque_rtgs_no;
    } else {
      $cheque_rtgs_no = 'N/A';
    }
  ?>
  <tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$cheque_rtgs_no ?? "N/A"}}</td>
    <td>{{$payment->amount ?? "N/A"}}</td>
    <td>{{$order->Builder->party_code ?? "N/A"}}</td>
    <td>{{$payment->branch_name ?? "N/A"}}</td>
    <td>{{$payment->bank_name ?? "N/A"}}</td>
    <td>{{$payment->remarks ?? "N/A"}}</td>
  </tr>
  @endforeach
  <tr>
    <th>Party Payment</th>
    <th>Total</th>
    <th>{{$totalAmount}}</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>