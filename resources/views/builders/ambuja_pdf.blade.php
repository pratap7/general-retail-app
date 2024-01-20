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
        DATE: {{$builder->created_at->format("d/m/Y")}}<br/>
        To, <br/>
        The Manager, <br/>
        AMBUJA CEMENTS LTD <br/>
        AHMEDABAD<br>    
      </address>
    </header>

    <h4 style="margin-left: 30px;"> Sub: Account opening details of {{ucwords($builder->party_name)}}.</h4>

    <div style="margin-left: 30px; font-size: 18px;">
        <p>
        Respected Sir,<br><br>
        As per our talk please find below details for opening our new code with Ambuja Cements Ltd.,
        </p>
        <p>
          <table>
            <tr>
              <th align="left">Billing Address(AS PER GST): </th>
              <td>{{$builder->postal_address}}</td>
            </tr>
            <tr>
              <?php
                $site_destinations = unserialize($builder->site_destinations);
                $site_address = $site_destinations[0]['destination'] ?? "N/A";
              ?>
              <th align="left">Site Address:</th>
              <td>{{$site_address}}</td>
            </tr>
            <tr>
              <th align="left">Contact Person Name & No.</th>
              <td>{{$builder->owner_name . " - ". $builder->owner_mobile}}</td>
            </tr>
            <tr>
              <th align="left">GST NUMBER:</th>
              <td>{{$builder->gst_no}}</td>
            </tr>
            <tr>
              <th align="left">PAN NUMBER:</th>
              <td>{{$builder->pancard_no}}</td>
            </tr>
          </table>
        </p>

        <p>INVOICE REQUIRED- TAX INVOICE.</p>

        <p>Thanking you,<p>
      </div>
  </body>
</html>