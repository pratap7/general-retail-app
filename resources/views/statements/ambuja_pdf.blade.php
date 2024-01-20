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
}  */
body {
  font-family: "Lucida Console", Courier, monospace;
}
</style>
</head>
<body text="blue">
<header style="font-size: 16px; font-family: arial; margin-left: 30px;margin-top: 15px;"> 
  <!-- <img src="http://shyamcorp.code-lab.in/public/img/letter_head.jpg"> -->
  
  
  <table cellpadding="2" border="0" cellspacing="0" align="right" cellpadding="0" style="border:none !important;">
    <tr>
      <td style="border:none">Date:</td>
      <td style="border:none">{{date('Y-m-d')}}</td>
    </tr>
    <tr>
      <td style="border:none">Time:</td>
      <td style="border:none">{{date("h:i:s")}}</td>
    </tr>
    <tr>
      <td style="border:none">Page:</td>
      <td style="border:none">1</td>
    </tr>
  </table>

  <table cellpadding="2" border="0" cellspacing="0" cellpadding="0" style="border:none !important;">
    <tr>
      <td style="border:none">Customer No:</td>
      <td style="border:none">{{$builder->party_code ?? "N/A"}}</td>
    </tr>
    <tr>
      <td style="border:none">Name:</td>
      <td style="border:none">{{$builder->owner_name ?? "N/A"}}</td>
    </tr>
    <tr>
      <td style="border:none">Address:</td>
      <?php
        $site_destinations = unserialize($builder->site_destinations);
        $site_address = $site_destinations[0]['destination'] ?? "N/A";
      ?>
      <td style="border:none">{{$builder->postal_address ?? "N/A"}}</td>
    </tr>
    <tr>
      <td style="border:none">&nbsp;</td>
      <td style="border:none">Pin: {{$builder->pincode ?? "N/A"}},Contact No:{{$builder->owner_mobile ?? "N/A"}}</td>
    </tr>
    <tr>
      <td style="border:none">Security Deposit:(INR) </td>
      <td style="border:none"> 0.00</td>
    </tr>
    <tr>
      <td style="border:none">Opening Balance:(INR)</td>
      <td style="border:none">{{$openingBalance}}</td>
    </tr>
  </table>
  <hr>
<p><?php 
if($dateFilter != false && !empty($dateFilter)){
    $date_filter = explode('-',$dateFilter);
    $from_date = date_create($date_filter[0]);
    $to_date = date_create($date_filter[1]);
    $start_date = date_format($from_date,"d F-yy");
    $end_date = date_format($to_date,"d F-yy");
    echo "Opening balance for the month of {$start_date} to {$end_date} :(INR) {$openingBalance}";
} else {
  echo "Opening balance for the month of " . date('d F-yy') . " :(INR) {$openingBalance}"; 
}
?>
</p>
</header>

<table style="width:100%">
  <tr>
    <th>DOC NO</th>
    <th>DOC DATE</th>
    <th>INVOICE NO</th>
    <th>Destination</th>
    <th>Material</th>
    <th>Quantity(MT)</th>
    <th>Debit(INR)</th>
    <th>Credit(INR)</th>
  </tr>
  <tbody>
  @php 
    $debitTotal = $creditTotal = 0;
  @endphp
    @foreach($payments as $payment)
        @php
        $doc_date = $payment->created_at->format('yy-m-d');
        if($payment->dispatch_id != 0){
          $doc_date = $payment->dispatch->del_date;
        }
        if($dateFilter != false && !empty($dateFilter)){
          $date_filter = explode('-',$dateFilter);
          $from_date = date_create($date_filter[0]);
          $to_date = date_create($date_filter[1]);
          $start_date = date_format($from_date,"yy-m-d");
          $end_date = date_format($to_date,"yy-m-d");

          if($doc_date < $start_date || $doc_date > $end_date){
            continue;
          }          
        }

          if($payment->utilize == 0 && $payment->dispatch_id == 0){
              continue;
          }
            $debit = $credit = 0;
            $invoice_no = $payment->invoice_reference;
            $location = $payment->Order->site_address;
            $quantity = $payment->Order->quantity_type_kg;
            if($payment->dispatch_id != 0){
                $debit = $payment->dispatch->invoice_amount;
                $doc_date = $payment->dispatch->del_date;
                $invoice_no = $payment->dispatch->invoice_no;
                $location = $payment->dispatch->location;
                $quantity = $payment->dispatch->quantity;
            }

            if($payment->utilize == 1 && $payment->dispatch_id == 0){
                $credit = $payment->amount;
            }
            $debitTotal += $debit;
            $creditTotal += $credit;
        @endphp
        <tr class="gradeX">
          <td>{{$payment->Order->order_no ?? "N/A"}}</td>
          <td>{{$doc_date ?? 'N/A'}}</td>
          <td>{{$invoice_no ?? "N/A"}}</td>
          <td>{{$location ?? "N/A"}}</td>
          <td>{{config('global.cementType')[$payment->Order->cement_type]}}</td>
          <td>{{$quantity}} MT</td>
          <td>{{$debit ?? 0}}</td>
          <td>{{$credit ?? 0}}</td>
        </tr>
        @endforeach
  <tr>
    <td colspan="8">
    <?php
    $totalDiff = $debitTotal - $creditTotal. "DR";
    if($debitTotal < $creditTotal){
      $totalDiff =  $creditTotal - $debitTotal . "CR";
    }
    ?>
      closing balance for the month of {{date('d F-yy')}} :(INR) {{$totalDiff}}
    </td>
  </tr>
</table>
<p>Note: In order to further improve upon our impeccable Corporate Governance record, ACL Board has instituted an ethical View Reporting Policy. In case you come across
  any unethical behaviour of our employees, kindly contact us by sending an E-mail at acl@ethicalview.com or making an online report at https://integrity.lafargeholcim.com
  or by calling on National Toll Free Phone Number: 1800 209 1005 or by sending Fax on : 022 664 59796
  or by post to PO Box No. 25, Pune # 411001. Information so received will be kept strictly confidential.</p>
  <hr>
  <table style="width:100%">
    <tr>
      <th>Opening Balance</th>
      <th colspan="2">Invoice/Other Adjustments</th>
      <th>Collection</th>
      <th>Credit Note</th>
      <th>Payment</th>
      <th>Closing Balance</th>
    </tr>
    <tr>
      <th>Amount</th>
      <th>Quantity</th>
      <th>Amount</th>
      <th>Amount</th>
      <th>Amount</th>
      <th>Amount</th>
      <th>Amount</th>
    </tr>
    <tr>
      <th>{{$openingBalance}}</th> 
      <th>0.000</th>
      <th>0.00</th>
      <th>{{$openingBalance}}</th>
      <th>0.00</th>
      <th>0.00</th>
      <th>{{$closingBalance}}</th>
    </tr>
    <tr>
      <td colspan="7">
        RV - INVOICE, HE- RTGS COLLECTION, HO - CHEQUE COLLECTION, HB - DD COLLECTION, DG - CREDIT NOTES , ZP - PAYMENTS, SA - MANUAL ENTRY, DA -CLEARING ENTRY / MANUAL ENTRY , Z1 - CANCEL INV-VAT CT - AR-INV.SERVICE (INTRA STATE), NC - AR-INV.SERVICE IT - AR-Inv.VAT, ZD - REVERSE DOCUMENT-AR)
      </td>
    </tr>
  </table>
</body>
</html>