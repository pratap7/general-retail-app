<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Ambuja PDF</title>
    <style>
      /* header img {
          width: 100%;
      } */
    </style>
  </head>
  <body>

    <header style="font-size: 20px; font-family: arial; margin-left: 30px;margin-top: 15px;"> 
    <!-- <img src="img/letter_head.jpg"> -->
      <address class="return-address">
        DATE: {{$order->created_at->format("d/m/Y")}}<br/>
        To, <br/>
        AMBUJA CEMENTS LTD <br/>
        AHMEDABAD<br>    
      </address>
    </header>

    <h4 style="margin-left: 30px;"> SUB: DIRECT PARTY ORDER ({{$order->Builder->party_name ?? "N/A"}})</h4>

    <div style="margin-left: 30px; font-size: 18px;">
        <p>
          Dear Sir,<br><br>
            With Reference to above subjects we are please to place our order with following terms & Conditions, 
            <br>For supply of Cement.
        </p>
        <p>
          <table>
            <tr>
              <th align="left">Product:</th>
              <td>{{config('global.cementType')[$order->cement_type]}} &nbsp; {{config('global.packingType')[$order->packing_type]}}</td>
            </tr>
            <tr>
              <th align="left">Party Code:</th>
              <td>{{$order->Builder->party_code ?? "N/A"}}</td>
            </tr>
            <tr>
              <th align="left">Quantity:</th>
              <td>{{$order->quantity_type_kg}} MT</td>
            </tr>
            <tr>
              <th align="left">RATE:</th>
              <td>{{$order->bag_price}}</td>
            </tr>
            <tr>
              <th align="left">Billing Address(*As per GST): </th>
              <td>{{$order->Builder->postal_address ?? "N/A"}}</td>
            </tr>
            <tr>
              <th align="left">Delivery Address:</th>
              <td>{{$order->delivery_address ?? "N/A"}}</td>
            </tr>
            <tr>
              <th align="left">Contact No.</th>
              <td>{{$order->site_contact ?? "N/A"}}</td>
            </tr>
            <tr>
              <th align="left">Delivery Schedule:</th>
              <td>{{$order->order_schedule ?? "N/A"}}</td>     
            </tr>
            <tr>
              <th align="left">Payment Terms:</th>
              <td>{{($order->payment_detail) ? $order->payment_detail : "N/A" }}</td>
            </tr>
            <tr>
              <th align="left">Canvasser name:</th>
              <td>SHYAM CORPORATION</td>
            </tr>
          </table>
        </p>

        <p>Self Declaration</p>
        <p>We here by certify that we end consumer of cement and intend to Procure and use cement for
construction work of our own Project. We under Take that we do not intend to resale or transfer the
cement to any other party.</p>
        <p>We also agree and confirm that any Quantity which remains unadjusted after the agreed validity period
will either be adjusted in Next Supply with new rates or the credit-balance will be returned to us.</p>

        <p>Thanking you,<p>
        <p>For,</p>
      </div>
  </body>
</html>