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
  <tr>
    <th>Ambuja Cement Ltd.</th>
    <td>B P I S</td>
    <td>DATE {{date("d.m.Y")}}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>Bank:</th>
    <td>DHDFC/1</td>
    <td>&nbsp;</td>
    <td>LOCATION: ACL CUSTOMER COLLECTION</td>
  </tr>
  <tr>
    <th>ACCOUNT NO:</th>
    <th>00600310005682</th>
    <td>&nbsp;</td>
    <td>SUBLEDGER SESSION</td>
  </tr>
</table>

<table style="width:100%">
  <caption>CUSTOMER PAYMENT</caption>
  <tr>
    <th>&nbsp;</th>
    <th>GROUP</th>
    <th>&nbsp;</th>
    <th>ABD2</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>ABD-{{date('dmY')}}</th>
    <th>&nbsp;</th>
    <th colspan="2">POSTING: {{date('d-m-Y')}}</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th>Inv.ref.</th>
    <th>P (1)</th>
    <th>Bank key (12)</th>
    <th>P (1)</th>
    <th>Inv.ref.(6)</th>
    <th>Check(6)</th>
    <th>Customer(10)</th>
    <th>Line item(10)</th>
    <th>BusA(4)</th>
    <th>Bank key(15)</th>
    <th>Amount(14)</th>
    <th>REMARKS (IF ANY) </th>
    <th>From Party </th>
    <th>From Party </th> 
  </tr>
  <tr>
    <th>Sr.No.</th>
    <th>Instrument Date</th>
    <th>Inst.type (C=Cheque, R=RTGS) </th>
    <th>Bank Name & Branch</th>
    <th>Instrument Type</th>
    <th>Instrument Date</th>
    <th>Cheque / DD Number</th>
    <th>Customer Code </th>
    <th>Invoice Reference for Payment</th>
    <th>Business Area </th>
    <th>Bank Name & Branch </th>
    <th>Amount</th>
    <th>Remarks</th>
    <th>Remarks</th>
    <th>Remarks </th> 
  </tr>
  @foreach($payments as $payment)
  <tr>
    @php
      $bank_branch = (!empty($payment->bank_name)) ? $payment->bank_name : "N/A";
      $bank_branch = ($bank_branch != "N/A" && !empty($payment->branch_name)) ? $bank_branch . ", ". $payment->branch_name : $bank_branch;
      if($payment->payment_mode == 2){
        $payment_mode = "RTGS";
      }
      if($payment->payment_mode == 3){
        $payment_mode = "CHK";
      }
    @endphp
    <td>{{$loop->iteration}}</td>
    <td>{{$payment->created_at->format('d.m.Y')}}</td>
    <td>{{$payment_mode ?? 'N/A'}}</td>
    <td>{{$bank_branch}}</td>
    <td>1</td>
    <td>{{$payment->created_at->format('d.m.Y')}}</td>
    <td>{{($payment->payment_mode != 3) ? $payment->cheque_rtgs_no : 'N/A'}} </td>
    <td>{{$payment->Builder->party_code ?? "N/A"}} </td>
    <td>{{($payment->invoice_reference) ? $payment->invoice_reference : "N/A"}}</td>
    <td>ND17</td>
    <td>{{$bank_branch}}</td>
    <td>{{$payment->amount}}</td>
    <td>{{($payment->remarks) ? $payment->remarks : "N/A"}}</td>
    <td>{{($payment->party_remarks) ? $payment->party_remarks : "N/A"}} </td>
    <td>N/A </td> 
  </tr>
  @endforeach
</table>
</body>
</html>