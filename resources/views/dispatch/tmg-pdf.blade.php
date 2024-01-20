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
<table width="100%">
  <thead>
      <tr>
          <th>#</th>
          <th>Date</th>
          <th>Quantity</th>
          <th>Brand</th>
          <th>Price</th>
          <th>Company</th>
          <th>Order No</th>
          <th>Party Code</th>
          <th>Party Name</th>
          <th>Invoice Amount</th>
          <th>Invoice No</th>
          <th>Transporter</th>
          <th>Tax Retail Invoice </th>
      </tr>
  </thead>
  <tbody>
  @forelse($all_reports as $report)
      <tr class="gradeX">
          <td>{{$loop->iteration}}</td>
          <td>{{$report->created_at->format('d/m/yy') ?? "N/A"}}</td>
          <td>{{$report->quantity ?? "N/A"}}</td>
          <td>{{$report->brand ?? "N/A"}}</td>
          <td>{{$report->price ?? 'N/A'}}</td>
          <td>{{$report->company ?? "N/A"}}</td>
          <td>{{$report->order_no ?? "N/A"}}</td>
          <td>{{$report->party_code ?? "N/A"}}</td>
          <td>{{$report->party_name ?? "N/A"}}</td>
          <td>{{$report->invoice_amount ?? "N/A"}}</td>
          <td>{{$report->invoice_no ?? "N/A"}}</td>
          <td>{{$report->transport_name ?? "N/A"}}</td>
          <td>{{$report->tax_retail_inv ?? "N/A"}}</td>
      </tr>
      @empty
      <tr class="gradeX">
          <td class="center" align="center" colspan="13">Data not found</td>
      </tr>
      @endforelse
  </tbody>
</table>
</body>
</html>