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
  <caption>{{$order->Plant->plant_name}}</caption>
  <tr>
    <th>REGION: </th>
    <th>Sr. No-	1</th> 
    <th>DATE: {{$order->created_at->format('d/m/Y')}}</th>
  </tr>
  <tr>
    <th>Party Code</th>
    <td colspan="2">{{$order->Builder->party_code}}</td>
  </tr>
  <tr>
    <th>Party Name</th>
    <td colspan="2">{{$order->Builder->party_name}}</td>
  </tr>
  <tr>
    <th rowspan="2">Site Address</th>
    
    <td rowspan="2" colspan="2">{{$order->site_address ?? "N/A"}}</td>
  </tr>
  <tr></tr>
  <tr>
    <th>&nbsp;</th>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <th></th>
    <th>PIN CODE</th>
    <td>{{$order->Builder->pincode}}</td>
  </tr>
  <tr>
    <th>Taluka: {{$order->site_taluka ?? 'N/A'}}</th>
    <td colspan="2">District: {{$order->site_district ?? 'N/A'}}</td>
  </tr>
  <tr>
    <th>Contact</th>
    <td colspan="2">{{$order->site_contact ?? 'N/A'}}</td>
  </tr>
  <!-- <tr>
    <th>Brand</th>
    <th colspan="2">{{config('global.cementBrand')[$order->cement_brand]}}</td>
  </tr> -->
  <tr>
    <th>Packaging Type</th>
    <td colspan="2">{{config('global.packingType')[$order->packing_type]}}</td>
  </tr>
  <tr>
    <th>SCHEDULED</th>
    <td colspan="2">{{$order->order_schedule ?? "N/A"}}</td>
  </tr>
  <tr>
    <th>Qty</th>
    <td colspan="2">{{$order->quantity_type_kg}} MT</td>
  </tr>
  <tr>
    <th>CATEGORY TYPE</th>
    <td colspan="2">{{strtoupper($order->cement_type)}}</td>
  </tr>
  <tr>
    <th>Rate</th>
    <td colspan="2">{{$order->bag_price}}</td>
  </tr>
  <tr>
    <th>TPC CODE</th>
    <td colspan="2">GSC571</td>
  </tr>
  <tr>
    <th>TPC NAME</th>
    <td colspan="2">SHYAM CORPORATION</td>
  </tr>
  <tr>
    <th>Payment Detail</th>
    <td colspan="2"><strong>Chk. No - </strong> {{($order->cheque_no) ? $order->cheque_no : "N/A"}} &nbsp;&nbsp;<strong>Chk. Date - </strong>{{($order->cheque_date) ? $order->cheque_date : "N/A"}}&nbsp;&nbsp; <strong> Bank - </strong>{{($order->bank) ? $order->bank : "N/A"}}&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th align="center">Order No: </th>
    <th colspan="2">{{$order->order_no ?? "N/A"}}</th>
  </tr>
</table>
</body>
</html>