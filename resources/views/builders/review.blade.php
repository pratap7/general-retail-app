@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Review Builder Form</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/builders">Builders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Review</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" id="wrapper-content">
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{Session::get('warning')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-error alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{Session::get('error')}}
    </div>
@endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Review Builder Form</h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div> -->
                </div>
                <div class="ibox-content">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                    <form action="">
                        <h3 class="badge badge-success">Basic Details</h3>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Name of the Party<span style="color:red;">*</span></label>
                                <input type="text" name="party_name" value="{{ $builder->party_name }}" id="party-name" maxlength="100" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4"><label class=" col-form-label">Postal Address<span style="color:red;">*</span> </label>
                                <input type="text" name="postal_address" value="{{ $builder->postal_address }}" maxlength="100" class="form-control" readOnly /> 
                                <small class="form-text m-b-none" style="color:green;">* As per GST number.</small>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Village<span style="color:red;">*</span></label>
                                <input type="text" name="village" value="{{ $builder->village }}" id="village" maxlength="100" class="form-control" readOnly/>
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Taluka<span style="color:red;">*</span></label>
                                <input type="text" name="taluka" value="{{ $builder->taluka }}" maxlength="100" class="form-control" readOnly/> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">District<span style="color:red;">*</span></label>
                                <input type="text" name="district" value="{{ $builder->district }}" id="district" maxlength="100" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">State<span style="color:red;">*</span></label>
                                <select name="state" readOnly class="form-control">
                                    @foreach($states as $state)
                                    <option {{($state->state == $builder->state) ? "selected" : '' }} value="{{$state->state}}">{{$state->state}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Pincode<span style="color:red;">*</span></label>
                                <input type="text" name="pincode" value="{{ $builder->pincode }}" readOnly id="pincode" maxlength="6" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Name of Owner<span style="color:red;">*</span></label>
                                <input type="text" name="owner_name" value="{{ $builder->owner_name }}" maxlength="100" class="form-control" readOnly /> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Owner Landline Number</label>
                                <input type="text" name="owner_landline" value="{{ $builder->owner_landline }}" maxlength="20" id="owner_landline" class="form-control" readOnly />
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Owner Mobile Number <span style="color:red;">*</span></label>
                                <input type="text" name="owner_mobile" value="{{ $builder->owner_mobile }}" readOnly maxlength="10" class="form-control"> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Contact Person Landline Number</label>
                                <input type="text" name="contact_person_landline" value="{{ $builder->contact_person_landline }}" maxlength="20" id="contact_person_landline" class="form-control" readOnly />
                                <small style="color:green;">*For routine work</small>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Contact Person Mobile Number </label>
                                <input type="text" name="contact_person_mobile" value="{{ $builder->contact_person_mobile }}" maxlength="10" readOnly class="form-control"> 
                                <small style="color:green;">*For routine work</small>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-3">
                                <label class="col-form-label">Category of Project <small style="color:green;">*Check if Yes</small></label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_builder" value="YES" {{($category_of_project['is_builder'] == 'YES') ? "checked": ''}}> <i></i> Builder </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_govt_contractor" value="YES" {{($category_of_project['is_govt_contractor'] == 'YES') ? "checked": ''}} > <i></i> Govt. Contractor </label></div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">&nbsp;</label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_contractor" value="YES" {{($category_of_project['is_contractor'] == 'YES') ? "checked": ''}}> <i></i> Contractor </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_institutional" value="YES" {{($category_of_project['is_institutional'] == 'YES') ? "checked": ''}} > <i></i> Institutional </label></div>
                            </div>
                            <div class="form-group col-sm-2">
                            <label class="col-form-label">&nbsp;</label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_industry" value="YES" {{($category_of_project['is_industry'] == 'YES') ? "checked": ''}}> <i></i> Industory </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_developer" value="YES" {{($category_of_project['is_developer'] == 'YES') ? "checked": ''}} > <i></i> Developer </label></div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Project Status<span style="color:red;"> *</span> <small style="color:green;">*Check if Yes</small></label>
                                <div class="">
                                    <div class="i-checks">
                                        <label> 
                                            <input type="radio" name="project_status" required value="NEW" {{($builder->project_status == 'NEW') ? "checked" : ''}}> <i></i> New &nbsp; &nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="on_going" name="project_status" required {{($builder->project_status == 'on_going') ? "checked" : ''}}> <i></i> On going
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Total Consumption of Site</label>
                                <div class="">
                                    <input type="text" maxlength="50" value="{{ $builder->total_consumption }}" class="form-control" name="total_consumption" readOnly />
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Monthly Consumption of Site<span style="color:red;">*</span></label>
                                <div class="">
                                    <input type="text" maxlength="50" value="{{$builder->monthly_consumption}}" class="form-control" name="monthly_consumption" readOnly />
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order Procured/To be placed by<span style="color:red;">*</span> <br/><small style="color:green;">*Check if Yes</small></label>
                                <div class="i-checks">
                                    <input type="radio" value="dealer" name="order_procured" readOnly {{($builder->order_procured == 'dealer') ? "checked" : ''}}> Dealer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="tpca" name="order_procured" readOnly {{($builder->order_procured == 'tpca') ? "checked" : ''}}> TPCA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="direct_party" name="order_procured" readOnly {{($builder->order_procured == 'direct_party') ? "checked" : ''}}> Direct Party &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="other" name="order_procured" readOnly {{($builder->order_procured == 'order_procured') ? "checked" : ''}}> Any Other 
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <h3 class="badge badge-success">Site destinations name and quantity requirement in mt</h3>
                        @foreach($site_destinations as $key=>$site_destination)
                        <div class="row dynamic-site">
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">Destination</label>
                                <input type="text" class="form-control" value="{{$site_destination['destination'] ?? 'N/A'}}" readonly />
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">Taluka</label>
                                <input type="text" class="form-control" value="{{$site_destination['taluka'] ?? 'N/A'}}" readOnly />
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">District</label>
                                <input type="text" class="form-control" value="{{$site_destination['district'] ?? 'N/A'}}" readOnly />
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">Site Contact</label>
                                <input type="text" class="form-control" value="{{$site_destination['contact'] ?? 'N/A'}}" readOnly />
                            </div>
                        </div>
                        @endforeach
                        <div class="hr-line-dashed"></div>
                        
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Name of Promoter/Indentor</label>
                                <input type="text" name="promoter_indentor" value="{{config('global.builderData.promoterName')}}" readOnly class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Phone no of Promoter</label>
                                <input type="text" name="promoter_phone" readonly value="{{ config('global.builderData.promoterPhone')}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Email ID of Direct Customer<span style="color:red;">*</span></label>
                                <input type="email" maxlength="50" value="{{ $builder->direct_customer_email }}" class="form-control" name="direct_customer_email" readOnly />
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Email ID of TPCA Dealer</label>
                                <input type="text" value="{{config('global.builderData.tpcaDealerEmail')}}" name="tpca_dealer_email" readOnly class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Name/Code Of Sales Representative<span style="color:red;">*</span></label>
                                <input type="text" maxlength="60" value="{{ $builder->sales_rep_code }}" name="sales_rep_code" readOnly class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Non trade <br/><small style="color:green;">*Check if Yes</small></label>                                
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="fright_debit_note" {{($non_trade['fright_debit_note'] == 'YES') ? "checked": ''}}> <i></i> Fright Debit Note </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="gross_billing" {{($non_trade['gross_billing'] == 'YES') ? "checked": ''}}> <i></i> Gross Billing For </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="tax_invoice" {{($non_trade['tax_invoice'] == 'YES') ? "checked": ''}}> <i></i> Tax Invoice </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="retail" {{($non_trade['retail'] == 'YES') ? "checked": ''}}> <i></i> Retail </label></div>
                                </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Credit Terms<br/><small style="color:green;">*Check if Yes</small></label>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="advance" {{($credit_terms['advance'] == 'YES') ? "checked": ''}} > <i></i> Advance </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="against_delivery" {{($credit_terms['against_delivery'] == 'YES') ? "checked": ''}}> <i></i> Against Delivery </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="bg_lc" {{($credit_terms['bg_lc'] == 'YES') ? "checked": ''}}> <i></i> If thru BG/LC(then documents completed or NOT) </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="parent_mapping" {{($credit_terms['parent_mapping'] == 'YES') ? "checked": ''}}> <i></i> Parent Mapping </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Credit limit and Period</label>
                                <input type="text" class="form-control" maxlength="60" value="{{ $builder->credit_limit_period }}" name="credit_limit_period" readOnly />
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="is_dealing_other_firm"> <input type="checkbox" id="is_dealing_other_firm" value="1" name="is_dealing_other_firm" {{($builder->is_dealing_other_firm == 1) ? "checked": ''}}> Whether the party is dealing with our company in any other firm name then details.</label>
                                <input type="text" class="form-control" value="{{ $builder->other_firm_details }}" maxlength="100" readonly id="other_firm_details" name=other_firm_details" {{($builder->is_dealing_other_firm == 0) ? "disabled": ''}} >
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Branch head</label>
                                <input type="text" class="form-control" value="{{ $builder->branch_head }}" maxlength="50" name="branch_head" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Party Code No</label>
                                <input type="text" class="form-control" value="{{ $builder->party_code }}"  maxlength="50" name="party_code" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Factory Code No</label>
                                <input type="text" class="form-control" value="{{ $builder->factory_code }}" maxlength="50" name="factory_code" readonly />
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Dist. Code</label>
                                <input type="text" class="form-control" value="{{ $builder->dist_code }}" maxlength="50" name="dist_code" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Dispatch and Cont. SMS No</label>
                                <input type="text" name="dispatch_cont_sms_no" value="{{config('global.builderData.dispatchCont_SMS_Number')}}" readOnly class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Freight Code</label>
                                <input type="text" class="form-control" value="{{ $builder->frieght_code }}" maxlength="25" name="frieght_code" readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">A/C Ahemdabad</label>
                                <input type="text" class="form-control" value="{{ $builder->ac_ahmdbd }}" maxlength="25" name="ac_ahmdbd" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">GST No<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ $builder->gst_no }}" maxlength="25" name="gst_no" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">PAN Card No<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ $builder->pancard_no }}" maxlength="25" name="pan_no" readOnly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Brand<span style="color:red;">*</span></label>
                                <input type="text" name="cement_brand" class="form-control" value="{{config('global.cementBrand')[$builder->cement_brand]}}" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">View PAN Card file</label></br>
                                @php 
                                $default_img = "/public/img/NoImage.png";
                                $pancard_file = (!empty($builder->pancard_file)) ? "/public/uploads/".$builder->pancard_file : $default_img;
                                $letterhead_file = (!empty($builder->letterhead_file)) ? "/public/uploads/".$builder->letterhead_file : $default_img;
                                $gst_file = (!empty($builder->gst_file)) ? "/public/uploads/".$builder->gst_file : $default_img;
                                $cancel_cheque_file = (!empty($builder->cancel_cheque_file)) ? "/public/uploads/".$builder->cancel_cheque_file : $default_img;
                                @endphp
                                <img width="100" src="{{$pancard_file}}" class="file-status">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Letterhead file</label></br>
                                <img src="{{$letterhead_file}}" class="file-status" width="100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cancel Cheque file</label></br>
                                <img src="{{$cancel_cheque_file}}" class="file-status" width="100">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">GST file</label></br>
                                <img src="{{$gst_file}}" class="file-status" width="100">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a href="{{route('builders.edit', $builder->id)}}" class="btn btn-success">Edit Builder</a>
                                    <a href="{{route('generate-builder-pdf',$builder->id)}}" target="_blank" class="btn btn-info">Preview PDF </a>
                                    <button type="button" data-toggle="modal" data-target="#sendEmail" class="btn btn-warning">Send Email </button>
                                    <a href="/builders" class="btn btn-warning">Cancel </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="sendEmail" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Send Email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('builder.sendEmail')}}" data-parsley-validate>
            @csrf
            <input type="hidden" name="builder_id" value="{{$builder->id}}" required />
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="col-form-label">Receiver Email 1<span style="color:red;">*</span></label>
                    <input name="receiver_1" type="email" id="receiver-1" class="form-control payment-mode" required />
                </div>
            </div>
            <div class="row">  
                <div class="form-group col-sm-12">
                    <label class="col-form-label">Receiver Email 2</label>
                    <input name="receiver_2" type="email" id="receiver-2" class="form-control" />
                </div>
            </div>
            <div class="row">  
                <div class="form-group col-sm-12">
                    <label class="col-form-label">Receiver Email 3</label>
                    <input name="receiver_3" type="email" id="receiver-3" class="form-control" />
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <input type="submit" name="submit" class="btn btn-success" value="Send Email" />
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@push('custom-scripts')
<script>
    $(document).ready(function(){
        $(".file-status").click(function(ev) {
            if($(this).attr('href') == '#'){
                alert('File does not exists!');
                ev.preventDefault();
                return false;
            }
            return true;
            
        });
    });
</script>
@endpush
@endsection