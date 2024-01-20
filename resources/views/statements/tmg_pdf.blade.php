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
  <!-- <img src="http://shyamcorp.code-lab.in/public/img/letter_head.jpg"> -->
  <center><strong>GUJARAT SIDHEE CEMENT LTD.</strong></center>
  <center><p>4th floor, Pelican Building,Guj.Chambers of Commerce Compount,Ashram Road,A'bad-9.Ph.+91-79-26580135/26580137<br>Customer Ledger <?php if($dateFilter != false && !empty($dateFilter)){
    $date_filter = explode('-',$dateFilter);
    $from_date = date_create($date_filter[0]);
    $to_date = date_create($date_filter[1]);
    $start_date = date_format($from_date,"d/m/y");
    $end_date = date_format($to_date,"d/m/y");
    echo "from {$start_date} To {$end_date}";
} else {
  echo "to" . date('d/m/y'); 
}
?>
</p></center>
  <p>CUSTOMER : GSC571-SHYAM CORPORATION,9 CHANKYA BUNGALOW NR LAAD SOCIETY,NR JUDGES BUNGLOW BODAKDEV,AHMEDABAD,AHMEDABAD,GUJARAT.TR CANVAS:GNTPD-CGNG DIRECT PART S129</p>
</header>
<table style="width:100%">
  <thead>
        <tr>
            <th>#</th>
            <th>DOC No</th>
            <th>DOC Date</th>
            <th>TAX INV</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
            <th>Quantity</th>
            <th>Particulars</th>
        </tr>
    </thead>
    <tbody>
    @php 
      $debitTotal = $creditTotal = $balance = $index = 0;
    @endphp
    @foreach($payments as $payment)
        @php 
          $debit = $credit = 0;$doc_date = $payment->created_at->format('yy-m-d');
          $invoice_no = $payment->invoice_reference;
          $quantity = $payment->Order->quantity_type_kg;
          if($payment->dispatch_id != 0){
            $debit = $payment->dispatch->invoice_amount;
            $doc_date = $payment->dispatch->del_date;
            $invoice_no = $payment->dispatch->invoice_no;
            $quantity = $payment->dispatch->quantity;
          }

          if($payment->utilize == 0 && $payment->dispatch_id == 0){
              continue;
          }

          if($payment->utilize == 1 && $payment->dispatch_id == 0){
              $credit = $payment->amount;
          }
          $particulars = "N/A";
          if($payment->payment_mode != 1){
              if($payment->payment_mode == 2){
                  $particulars = $payment->cheque_rtgs_no . "/". $payment->bank_name;
              } else {
                  $particulars = "CH " . $payment->cheque_rtgs_no . "/". $payment->bank_name;
              }
          }
          $debitTotal += $debit;
          $creditTotal += $credit;
          //Calculate Balance
          if($debitTotal > $creditTotal){
              $balance = $debitTotal - $creditTotal . " DR";
          } else {
              $balance =  $creditTotal - $debitTotal . " CR";
          }
          $index++;
        @endphp
        <tr class="gradeX">
          <td>{{$index}}</td>
          <td>{{$payment->Order->order_no ?? "N/A"}}</td>
          <td>{{$doc_date ?? 'N/A'}}</td>
          <td>{{$invoice_no ?? "N/A"}}</td>
          <td>{{$debit ?? 0}}</td>
          <td>{{$credit ?? 0}}</td>
          <td>{{$balance}}</td>
          <td>{{$quantity }} MT</td>
          <td>{{$particulars ?? "N/A"}}</td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align:center;" colspan="4">Total</th>
          <th>{{$debitTotal}}</th>
          <th>{{$creditTotal}}</th>
          <td colspan="3"></td>
        </tr>
    </tbody>
</table>
<p>
  This is to inform that above balance is as per our Books of Accounts.
We shall feel obliged if you confirm the above balance and return the second copy duly signed & Stamped at the place provided.However in
case of any discrepancy please provide the details of your account to enable us to reconcile the same.
If we do not hear from you within 7 days of the receipt of this statement by you,we shall treat the balance shown above as correct
Please always quote your customer No.in all your coorespondence.
For GUJARAT SIDHEE CEMENT LTD.
(This is a computer generated statement and do not required signature)(S03089)
</p>
</body>
</html>