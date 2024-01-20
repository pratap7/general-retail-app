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
          <th>SD Code</th>
          <th>SD Name</th>
          <th>RD-RL-SH</th>
          <th>City</th>
          <th>Reff.Doc No</th>
          <th>GRO Price</th>
          <th>Del Date</th>
          <th>Quanity</th>
          <th>Invoice No</th>
          <th>S Plan No</th>
          <th>Transport Name</th>
      </tr>
  </thead>
  <tbody>
  @forelse($all_reports as $report)
      <tr class="gradeX">
          <td>{{$loop->iteration}}</td>
          <td>{{$report->party_code ?? "N/A"}}</td>
          <td>{{$report->party_name ?? "N/A"}}</td>
          <td>{{$report->truck_no ?? "N/A"}}</td>
          <td>{{$report->location ?? 'N/A'}}</td>
          <td>{{$report->ref_doc_no ?? "N/A"}}</td>
          <td>{{$report->invoice_amount ?? "N/A"}}</td>
          <td>{{$report->del_date ?? "N/A"}}</td>
          <td>{{$report->quantity ?? "N/A"}}</td>
          <td>{{$report->invoice_no ?? "N/A"}}</td>
          <td>{{$report->s_plan_no ?? "N/A"}}</td>
          <td>{{$report->transport_name ?? "N/A"}}</td>
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