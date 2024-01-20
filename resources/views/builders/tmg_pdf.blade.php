<!DOCTYPE html>
<html>
<head>
<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 15px;
  }

  header img {
    width: 100%;
  }
</style>
</head>
<body>

<header style="font-size: 20px; font-family: arial; margin-left: 30px;margin-top: 15px;"> 
  <img src="img/letter_head.jpg">
</header>
  <h2>The Mehta Group</h2>
  <table style="width:100%">
    <tr>
      <th>The Mehta Group</th>
      <th colspan="2" align="center">Branch Name</th>
      <th>Ahmedabad</th>
      <th>&nbsp;</th>
      <th colspan="3" align="center">Form S.No of the branch</th>
      <th colspan="4" align="center">AHMEDABAD REGION </th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="13" align="center">PARTY ACCOUNT OPENING FORM</th>
    </tr>
    <tr>
      <th rowspan="2">&nbsp;</th>
      <th rowspan="2">GST NO</th>
      <td rowspan="2" align="center" colspan="3">{{($builder->gst_no) ? $builder->gst_no : "N/A"}}</td>
      <th rowspan="2">PAN NO </th>
      <td rowspan="2" align="center">{{($builder->pancard_no) ? $builder->pancard_no : "N/A"}}</td>
      <th align="center" colspan="3">Date</th>
      <td colspan="3" align="center">{{$builder->created_at->format('d-M-Y')}}</td>
    </tr>
    <tr>
      <th align="center" colspan="4">Name of Company</th>
      <td align="center">SCL</td>
      <td >GSCL</td>
    </tr>
    <tr>
      <th>Name of Party</th>
      <td align="center" colspan="12">{{$builder->party_name}}</td>
    </tr>
    <tr>
      <th>Postal Address: (AS PER GST NUMBER)</th>
      <th align="center" colspan="12">{{$builder->postal_address}} </th>
    </tr>
    <tr>
      <th>Village: </th>
      <td>{{($builder->village) ? $builder->village : 'N/A'}} </td>
      <th>Taluka: </th>
      <td align="center" colspan="4">{{($builder->taluka) ? $builder->taluka : "N/A"}} </td>
      <th>Dist.: </th>
      <td align="center"> {{($builder->district) ? $builder->district : "N/A"}}</td>
      <th colspan="3" align="center">PIN NO </th>
      <td>{{($builder->pincode) ? $builder->pincode : "N/A"}} </td>
    </tr>
	   <tr>
      <th>Name of Owner and contact No. </th>
      <td colspan="2" align="center">{{($builder->owner_name) ? $builder->owner_name : "N/A"}} </td>
      <td align="center" colspan="3">Telephone(O) :(Mobile)(Land line) </td>
      <td colspan="2" align="center" >{{($builder->owner_landline) ? $builder->owner_landline : "N/A"}} </td>
      <td align="center" colspan="4"> Telephone(O) :(Mobile)</td>
	    <td>{{($builder->owner_mobile) ? $builder->owner_mobile : "N/A"}}</td>
    </tr>
	  <tr>
      <th>Contact Person :(For Routine Work) </th>
      <td colspan="2" align="center">&nbsp;</td>
      <td align="center" colspan="3">Telephone (O):(Mobile) (Land line) </td>
      <td colspan="2" align="center">{{$builder->contact_person_landline}}</td>
      <td align="center" colspan="4"> Telephone (O):(Mobile) (Land line)</td>
	    <th>{{$builder->contact_person_mobile}}</th>
    </tr>
	<tr>
      <th>Site Address Details: (AS PER LETTER HEAD)</th>
      <?php
        $site_destinations = unserialize($builder->site_destinations);
        $site_address = $site_destinations[0]['destination'] ?? "N/A";
      ?>
      <th align="center" colspan="12">{{$site_address ?? "N/A"}}</th>
    </tr>
	
	<tr>
      <th>Category of Project (Tick Mark in the respective column) </th>
      <td align="center">Builder</td>
      <td align="center"> {{($category_of_project['is_builder'] == 'YES') ? "YES": 'NO'}}</td>
      <td  colspan="1" align="center">Govt Contractor</td>
      <td align="center">{{($category_of_project['is_govt_contractor'] == 'YES') ? "YES": 'NO'}}</td>
      <td align="center">Contarctor</td>
      <td align="center">{{($category_of_project['is_contractor'] == 'YES') ? "YES": 'NO'}}</td>
      <td align="center">Institutional</td>
      <td align="center">{{($category_of_project['is_institutional'] == 'YES') ? "YES": 'NO'}}</td>
      <td align="center">Industry</td>
      <td align="center">{{($category_of_project['is_industry'] == 'YES') ? "YES": 'NO'}}</td>
      <td align="center">Devloper</td>
      <td align="center">{{($category_of_project['is_developer'] == 'YES') ? "YES": 'NO'}}</td>

    </tr>
	<tr>
      <th>Project Status -New or on going :(Tick Mark)</th>
      <td colspan="1" align="center">New</td>
      <td colspan="5" align="center">{{($builder->project_status == 'NEW') ? "YES" : 'NO'}}</td>
      <td colspan="1" align="center">On Going </td>
      <td colspan="5" align="center">{{($builder->project_status == 'on_going') ? "YES" : 'NO'}}</td>
    </tr>
	<tr>
      <th>Total Consumption Of Site / Multiple sites-  Hereon (mt.) :(For Full Project)</th>
      <th align="center" colspan="12">{{($builder->total_consumption) ? $builder->total_consumption : "N/A" }}</th>
    </tr>
	<tr>
      <th>Monthly Consumption of Site / Multiple sites -(mt.) :</th>
      <th align="center" colspan="12">{{($builder->monthly_consumption) ? $builder->monthly_consumption : "N/A"}}</th>
    </tr>
	<tr>
      <th >Site destinations name and Qty requirement in mt</th>
      <td colspan="1" align="center">Destination 1 name</td>
      <td colspan="2" align="center" >Qty Requiremnet in </td>
      <td colspan="1" align="center" >Destination 2 name</td>
      <td colspan="2" align="center" >Qty Requiremnet in Mt</td>
      <td colspan="2" align="center" >Destination 3 name	</td>
      <td colspan="2" align="center" >Qty Requiremnet in Mt</td>
      <td colspan="1" align="center" >Destination 4 name</td>
      <td colspan="1" align="center" >Qty 4</td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td colspan="1" align="center">{{(isset($site_destinations[1]['destination'])) ? $site_destinations[1]['destination'] : 'N/A'}}</td>
      <td colspan="2" align="center">{{(isset($site_destinations[1]['qty'])) ? $site_destinations[1]['qty'] : 'N/A'}} </td>
      <td colspan="1" align="center">{{(isset($site_destinations[2]['destination'])) ? $site_destinations[2]['destination'] : 'N/A'}}</td>
      <td colspan="2" align="center">{{(isset($site_destinations[2]['qty'])) ? $site_destinations[2]['qty'] : 'N/A'}}</td>
      <td colspan="2" align="center">{{(isset($site_destinations[3]['destination'])) ? $site_destinations[3]['destination'] : 'N/A'}}	</td>
      <td colspan="2" align="center">{{(isset($site_destinations[3]['qty'])) ? $site_destinations[3]['qty'] : 'N/A'}}</td>
      <td colspan="1" align="center">{{(isset($site_destinations[4]['destination'])) ? $site_destinations[4]['destination'] : 'N/A'}}</td>
      <td colspan="1" align="center">{{(isset($site_destinations[4]['qty'])) ? $site_destinations[4]['qty'] : 'N/A'}}</td>
    </tr>

	<tr>
      <th>Order Procured/To be placed by(Tick Mark)</th>
      <td colspan="1" align="center">Dealer</td>
      <td colspan="1" align="center">{{($builder->order_procured == 'dealer') ? "YES" : 'NO'}}</td>
	  <td colspan="1" align="center" >TPCA </td>
	  <td colspan="1" align="center" >{{($builder->order_procured == 'tpca') ? "YES" : 'NO'}} </td>
	  <td colspan="1" align="center" >Direct party</td>
	   <td align="center" colspan="2">{{($builder->order_procured == 'direct_party') ? "YES" : 'NO'}}</td>
	   <td align="center">&nbsp;</td>
	  <td colspan="1" align="center" >Any Other</td>
	  <td colspan="1" align="center">{{($builder->order_procured == 'order_procured') ? "YES" : 'NO'}}</td>
	  <td colspan="1" align="center" >&nbsp;</td>
	  <td colspan="1" align="center" >&nbsp;</td>
    </tr>
	<tr>
      <th>Name of Promoter / Indentor :</th>
      <td colspan="4" align="center">{{ config('global.builderData.promoterName')}}</td>
      <td colspan="4" align="center">Phone No</td>
	  <td colspan="4" align="center" >{{ config('global.builderData.promoterPhone')}}</td>
    </tr>
	<tr>
      <th>Email ID of Direct Customer</th>
      <td colspan="4" align="center"><a href="">{{$builder->direct_customer_email}}</a></td>
      <td colspan="4" align="center">Of TPCA/Dealer</td>
	  <td colspan="4" align="center"> <a href="">{{config('global.builderData.tpcaDealerEmail')}}</a></td>
    </tr>
	<tr>
      <th>Name/Code of Sales Representatives :</th>
      <th colspan="12" align="center">{{$builder->sales_rep_code}}</th>
    </tr>
	<tr>
      <th>Non trade (Tick Mark)</th>
      <td colspan="1" align="center">Fright Debit Note</td>
      <td colspan="2" align="center">GROSS BILLING</td>
	  <td colspan="1" align="center"> FOR</td>
	  <td colspan="3" align="center">{{($non_trade['fright_debit_note'] == 'YES') ? "YES" : 'NO'}}</td>
	  <td colspan="2" align="center"> Tax Invoice</td>
	  <td colspan="1" align="center"> {{($non_trade['tax_invoice'] == 'YES') ? "YES" : 'NO'}}</td>
	  <td colspan="1" align="center"> Retail</td>
	  <td colspan="1" align="center"> {{($non_trade['retail'] == 'YES') ? "YES" : 'NO'}}</td>
    </tr>
	<tr>
      <th>Credit Terms(Tick Mark and in BG/LC Details)</th>
      <td colspan="1" align="center">Advance 	</td>
      <td colspan="0" align="center">{{($credit_terms['advance'] == 'YES') ? "YES": 'NO'}}	</td>
      <td colspan="2" align="center"> Agaisnt delivery</td>
      <td colspan="3" align="center">{{($credit_terms['against_delivery'] == 'YES') ? "YES": 'NO'}}</td>
      <td colspan="2" align="center"> If thru BG/LC(Then documents completed or not)</td>
      <td colspan="1" align="center"> {{($credit_terms['bg_lc'] == 'YES') ? "YES": 'NO'}}</td>
      <td colspan="1" align="center"> Parent Mapping </td>
      <td colspan="1" align="center"> {{($credit_terms['parent_mapping'] == 'YES') ? "YES": 'NO'}}</td>
    </tr>
	<tr>
      <th>Credit Limit and Period:(If applicable)</th>
      <th colspan="12" align="center">{{$builder->credit_limit_period}}</th>
    </tr>
	<tr>
      <th>Whether the Party is dealing with our company in any other firm name then details </th>
      <th colspan="2" align="center">{{($builder->is_dealing_other_firm == 0) ? "NO" : "YES"}}</th>
      <td colspan="10">{{(!empty($builder->other_firm_details)) ? $builder->other_firm_details : "N/A"}}</td>
    </tr>
	<tr>
      <th>(Branch Head</th>
      <th colspan="12" align="center">{{$builder->branch_head}}</th>
    </tr>
	<tr>
      <th>Party Code No.:</th>
      <td colspan="1" align="center">{{$builder->party_code}}</td>
      <td colspan="2" align="center"> Dist. Code:	</td>
	  <td colspan="1" align="center">{{$builder->dist_code}}</td>
	  <td colspan="1" align="center">Dispatch & Cont.SMS NO:</td>
	  <td colspan="3" align="center"> If thru BG/LC(Then documents completed or not)</td>
	  <td colspan="1" align="center"> {{config('global.builderData.dispatchCont_SMS_Number')}}</td>
	    <td colspan="1" align="center">&nbsp;</td>
	    <td colspan="1" align="center">&nbsp;</td>
		  <td colspan="1" align="center">&nbsp;</td>
    </tr>
	<tr>
      <th>Factory Code No.:</th>
      <td colspan="1" align="center">{{$builder->factory_code}}</td>
      <td colspan="2" align="center"> Freight Code:	</td>
	  <td colspan="1" align="center"> {{$builder->frieght_code}}</td>
	  <td colspan="1" align="center">&nbsp;</td>
	  <td colspan="3" align="center"> &nbsp;</td>
	  <td colspan="1" align="center"> &nbsp;</td>
	    <td colspan="1" align="center">&nbsp;</td>
	    <td colspan="1" align="center">&nbsp;</td>
		  <td colspan="1" align="center">&nbsp;</td>
    </tr>
	<tr>
      <th>A/C. Ahmedabad :</th>
      <td colspan="11" align="center">{{$builder->ac_ahmdbd}}</td>
	  <td colspan="1" align="center">&nbsp;</td>
    </tr>
  </table>

</body>
</html>