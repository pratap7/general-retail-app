@extends('layout.app')

@section('content')
<style>
    th.col-form-th {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Display Builder Details</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Builders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Builder Details</h5> &nbsp;&nbsp;&nbsp;&nbsp;<a href="/builders" class="btn btn-success"> Builders List </a>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table>
                        <tr>
                            <th>Name of the Party</th>
                            <td>{{$builder->party_name}}</td>
                        </tr>
                        <tr>
                            <th>Postal Address</th>
                            <td>{{$builder->postal_address}}"</td> 
                        </tr>
                        <tr>
                            <th>Village</th>
                            <td>{{$builder->village}}</td>
                        </tr>
                        <tr>
                            <th>Taluka </th>
                            <td>{{$builder->taluka}}</td>
                        <tr>
                            <th>District</th>
                            <td>{{$builder->district}}</td>
                        </tr>
                        <tr>
                            <th>State </th>
                            <td>{{$builder->state}}"</td> 
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td>{{$builder->pincode}}</td>
                        </tr>
                        <tr>
                            <th>Name of Owner</th>
                            <td>{{$builder->owner_name}}</td> 
                        </tr>
                        <tr>
                            <th>Owner Landline Number</th>
                            <td{{$builder->owner_landline}}</td>
                        </tr> 
                            <tr>
                                <th>Owner Mobile Number </th>
                                <td>{{$builder->owner_mobile}}</td> 
                            </tr>
                            <tr>
                                <th>Contact Person Landline Number</th>
                                <td>{{$builder->contact_person_landline}}</td>
                            </tr>
                            <tr>
                                <th>Contact Person Mobile Number </th>
                                <td>{{$builder->contact_person_mobile}}</td>
                            </tr>
                            <tr>
                                <th>Category of Project</th>
                                <td>Builder - {{$builder->is_builder}}<br>
                                    Govt. Contractor - {{$builder->is_govt_contractor}}<br>
                                    Contractor  - {{$builder->is_contractor}}<br>
                                    Institutional - {{$builder->is_institutional}}<br>
                                    Industory - {{$builder->is_industry}}<br>
                                    Developer - {{$builder->is_developer}}
                                </td>
                            </tr>
                            <tr>
                                <th>Project Status</th>
                                <td>{{$builder->project_status}}</td>
                            </tr>
                            <tr>
                                <th>Total Consumption of Site</th>
                                <td>{{$builder->total_consumption}}</td>
                            </tr>
        
                            <tr>
                                <th>Monthly Consumption of Site</th>
                                <td>{{$builder->monthly_consumption}}</td>
                                </td>
                            </tr>
                        
                            <tr>
                                <th>Destination 1 </th>
                                <td>{{$builder->destination_1}}</td>
                            </tr>
                            <tr>
                                <th>Qty requirement</th>
                                <td>{{$builder->qty_1}}</td>
                            </tr>
                            <tr>
                                <th>Destination 2 </th>
                                <td>{{$builder->destination_2}}</td>
                            </tr>
                            <tr>
                                <th>Qty requirement</th>
                                <td>{{$builder->qty_2}}</td>
                            </tr>
                            <tr>
                                <th>Destination 3 </th>
                                <td>{{$builder->destination_3}}</td>
                            </tr>
                            <tr>
                                <th>Qty requirement</th>
                                <td>{{$builder->qty_3}}</td>
                            </tr>
                            <tr>
                                <th>Destination 4 </th>
                                <td>{{$builder->destination_4}}</td>
                            </tr>
                            <tr>
                                <th>Qty requirement</th>
                                <td>{{$builder->qty_4}}</td>
                            </tr>
                            <tr>
                                <th>Order Procured/To be placed by</th>
                                <td>{{$builder->order_procured}}</td>
                            </tr>
                            <tr>
                                <th>Name of Promoter/Indentor</th>

                                <td>{{$builder->promoter_indentor}}</td>
                            </tr>
                            <tr>
                                <th>Phone no of Promoter</th>
                                <td>{{$builder->promoter_phone}}</td>
                            </tr>
                            <tr>
                                <th>Email ID of Direct Customer</th>
                                <td>{{$builder->direct_customer_email}}</td>
                            </tr>
                            <tr>
                                <th>Email ID of TPCA Dealer</th>
                                <td>{{$builder->tpca_dealer_email}}</td>
                            </tr>
                            <tr>
                                <th>Name/Code Of Sales Representative</th>
                                <td>{{$builder->sales_rep_code}}</td>
                            </tr>
                            <tr>
                                <th>Non trade</th>                                
                                <td>Fright Debit Note  - {{$builder->fright_debit_note}}</br>
                                    Gross Billing For - {{$builder->gross_billing}}</br>
                                    Tax Invoice - {{$builder->tax_invoice}}</br>
                                    Retail - {{$builder->retail}}
                                </td>
                            </tr>
                            <tr>
                            <th>Credit Terms</th>
                                <td>Advance - {{$builder->advance}}</br>
                                    Against Delivery - {{$builder->against_delivery}}<br>
                                    If thru BG/LC(then documents completed or NOT) - {{$builder->bg_lc}} </br>
                                    Parent Mapping - {{$builder->parent_mapping}}
                                </td>
                            </tr>
                            <tr>
                                <th>Credit limit and Period</th>
                                <td>{{$builder->credit_limit_period}}</td>
                            </tr>
                            <tr>
                                <th>Whether the party is dealing with our company in any other firm name then details.</th>
                                <td>{{$builder->is_dealing_other_firm}}</td>
                            </tr>
                            <tr>
                                <th>Other Firm Detail</th>
                                <td>{{$builder->other_firm_details}}</td>
                            </tr>
                            <tr>
                                <th>Branch head</th>
                                <td>{{$builder->branch_head}}</td>
                            </tr>
                            <tr>
                                <th>Party Code no</th>
                                <td>{{$builder->party_code}}</td>
                            </tr>
                            <tr>
                                <th>Factory Code no </th>
                                <td>{{$builder->factory_code}}</td>
                            </tr>
                            <tr>
                                <th>Dist. Code</th>
                                <td>{{$builder->dist_code}}</td>
                            </tr>
                            <tr>
                                <th>Dispatch and Cont. SMS No </th>
                                <td>8866872848</td>
                            </tr>
                            <tr>
                                <th>Freight Code</th>
                                <td>{{$builder->frieght_code}}</td>
                            </tr>
                            <tr>
                                <th>A/C Ahemdabad </th>
                                <td>{{$builder->ac_ahmdbd}}</td>
                            </tr>
                            <tr>
                                <th>GST No </th>
                                <td>{{$builder->gst_no}}</td>
                            </tr>
                            <tr>
                                <th>PAN Card No</th>
                                <td>{{$builder->pan_no}}</td>
                            </tr>
                            <tr>
                                <th>Upload PAN Card file </th>
                                <td><img width="100" src="/uploads/{{$builder->pancard_file}}"></td>
                            </tr>
                            <tr>
                                <th>Upload Letterhead file </th>
                                <td><img width="100" src="/uploads/{{$builder->letterhead_file}}"></td>
                            </tr>
                            <tr>
                                <th>Upload Cancel Cheque file</th>
                                <td><img width="100" src="/uploads/{{$builder->cancel_cheque_file}}"></td>
                            </tr>
                            <tr>
                                <th>Upload GST file</th>
                                <td><img width="100" src="/uploads/{{$builder->gst_file}}"></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection