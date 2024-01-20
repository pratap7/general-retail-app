@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create Builder Form</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/builders">Builders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Create</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Create Builder Form</h5>
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
                    <form method="POST" action="{{ route('builders.store') }}" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <h3 class="badge badge-success">Basic Details</h3>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Name of the Party<span style="color:red;">*</span></label>
                                <input type="text" name="party_name" value="{{ old('party_name') }}" id="party-name" maxlength="100" placeholder="Builder Name" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-4"><label class=" col-form-label">Postal Address<span style="color:red;">*</span> </label>
                                <input type="text" name="postal_address" value="{{ old('postal_address') }}" placeholder="Postal Address" maxlength="100" class="form-control" required /> 
                                <small class="form-text m-b-none" style="color:green;">* As per GST number.</small>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Village<span style="color:red;">*</span></label>
                                <input type="text" name="village" value="{{ old('village') }}" id="village" maxlength="100" placeholder="Enter Village" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Taluka<span style="color:red;">*</span></label>
                                <input type="text" name="taluka" value="{{ old('taluka') }}" maxlength="100" placeholder="Enter Taluka" class="form-control" required/> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">District<span style="color:red;">*</span></label>
                                <input type="text" name="district" value="{{ old('district') }}" id="district" maxlength="100" placeholder="Enter District" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">State<span style="color:red;">*</span></label>
                                <select name="state" required id="state" class="form-control">
                                    @foreach($states as $state)
                                    <option {{(old('state') == $state->state ) ? 'selected' : ''}} value="{{$state->state}}">{{$state->state}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Pincode<span style="color:red;">*</span></label>
                                <input type="text" name="pincode" value="{{ old('pincode') }}" required id="pincode" maxlength="6" placeholder="Enter pincode" class="form-control" data-parsley-type="number" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Name of Owner<span style="color:red;">*</span></label>
                                <input type="text" name="owner_name" value="{{ old('owner_name') }}" maxlength="100" placeholder="Enter owner name" class="form-control" required /> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Owner Landline Number</label>
                                <input type="text" name="owner_landline" value="{{ old('owner_landline') }}" maxlength="15" id="owner_landline" placeholder="Enter landline number" class="form-control" />
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Owner Mobile Number <span style="color:red;">*</span></label>
                                <input type="text" name="owner_mobile" value="{{ old('owner_mobile') }}" required data-parsley-type="number" maxlength="10" placeholder="Enter owner mobile" class="form-control"> 
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Contact Person Landline Number</label>
                                <input type="text" name="contact_person_landline" value="{{ old('contact_person_landline') }}" maxlength="15" id="contact_person_landline" placeholder="Contact Person landline number" class="form-control" />
                                <small style="color:green;">*For routine work</small>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Contact Person Mobile Number</label>
                                <input type="text" name="contact_person_mobile" value="{{ old('contact_person_mobile') }}" data-parsley-type="number" maxlength="10" placeholder="Enter Contact Person mobile" class="form-control"> 
                                <small style="color:green;">*For routine work</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">Category of Project <small style="color:green;">*Check if Yes</small></label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_builder" value="YES"> <i></i> Builder </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_govt_contractor" value="YES" > <i></i> Govt. Contractor </label></div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">&nbsp;</label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_contractor" value="YES" > <i></i> Contractor </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_institutional" value="YES" > <i></i> Institutional </label></div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">&nbsp;</label>
                                <div class="i-checks"><label> <input type="checkbox" name="is_industry" value="YES" > <i></i> Industory </label></div>
                                <div class="i-checks"><label> <input type="checkbox" name="is_developer" value="YES" > <i></i> Developer </label></div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Project Status<span style="color:red;">*</span><small style="color:green;">*Check if Yes</small></label>
                                <div class="">
                                    <div class="i-checks"><label> <input type="radio" name="project_status" required value="NEW"> <i></i> New</label></div>
                                    <div class="i-checks"><label> <input type="radio" checked="" value="on_going" name="project_status" required> <i></i> On going</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Total Consumption of Site</label>
                                <div class="">
                                    <input type="text" maxlength="50" value="{{ old('total_consumption') }}" class="form-control" name="total_consumption" />
                                </div>
                            </div>
        
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Monthly Consumption of Site<span style="color:red;">*</span></label>
                                <div class="">
                                    <input type="text" maxlength="50" value="51 MT" class="form-control" name="monthly_consumption" required />
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order Procured/To be placed by<span style="color:red;">*</span> <small style="color:green;"> *Check if Yes</small></label>
                                <div class="i-checks">
                                    <input type="radio" value="dealer" name="order_procured" required> Dealer &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" checked="" value="tpca" name="order_procured" required> TPCA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="direct_party" name="order_procured" required> Direct Party &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="other" name="order_procured" required> Any Other 
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <h3 class="badge badge-success">Site destinations name and quantity requirement in mt</h3>
                        <div class="row dynamic-site" id="master-site">
                            <div class="form-group col-sm-3">
                                <label class="col-form-label">Destination</label>
                                <input type="text" class="form-control" name="site_destination[]" required/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">Taluka</label>
                                <input type="text" class="form-control" name="site_taluka[]" required/>   
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">District</label>
                                <input type="text" class="form-control" name="site_district[]" required/>   
                            </div>
                            <div class="form-group col-sm-2">
                                <label class="col-form-label">Site Contact</label>
                                <input type="text" class="form-control" name="site_cntct[]" required/>
                            </div>
                            <div class="form-group col-sm-1">
                                <br><br>
                                <a href="javascript:void(0);" class="add_button" style="font-size: 22px; color: green;" title="Add field"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Name of Promoter/Indentor</label>
                                <input type="text" name="promoter_indentor" value="{{ config('global.builderData.promoterName')}}" readOnly class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Phone no of Promoter</label>
                                <input type="text" name="promoter_phone" readonly value="{{ config('global.builderData.promoterPhone')}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Email ID of Direct Customer<span style="color:red;">*</span></label>
                                <input type="email" maxlength="50" value="{{ old('direct_customer_email') }}" class="form-control" name="direct_customer_email" required />
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Email ID of TPCA Dealer</label>
                                <input type="text" value="{{config('global.builderData.tpcaDealerEmail')}}" name="tpca_dealer_email" readOnly class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Name/Code Of Sales Representative<span style="color:red;">*</span></label>
                                <input type="text" maxlength="60" value="SHIV VYAS" name="sales_rep_code" required class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Non trade <br/><small style="color:green;">*Check if Yes</small></label>                                
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="fright_debit_note" > <i></i> Fright Debit Note </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="gross_billing" > <i></i> Gross Billing For </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="tax_invoice" > <i></i> Tax Invoice </label></div>
                                    <div class="i-checks"><label> <input type="checkbox" value="YES" name="retail" > <i></i> Retail </label></div>
                                </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Credit Terms<br/><small style="color:green;">*Check if Yes</small></label>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="advance" > <i></i> Advance </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="against_delivery"> <i></i> Against Delivery </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="bg_lc"> <i></i> If thru BG/LC(then documents completed or NOT) </label></div>
                                <div class="i-checks"><label> <input type="checkbox" value="YES" name="parent_mapping"> <i></i> Parent Mapping </label></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Credit limit and Period</label>
                                <input type="text" class="form-control" maxlength="60" value="{{ old('credit_limit_period') }}" name="credit_limit_period" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="is_dealing_other_firm"> <input type="checkbox" id="is_dealing_other_firm" value="1" name="is_dealing_other_firm"> Whether the party is dealing with our company in any other firm name then details.</label>
                                <input type="text" class="form-control" value="{{ old('other_firm_details') }}" maxlength="100" placeholder="Details here" id="other_firm_details" name=other_firm_details" disabled >
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Branch head</label>
                                <input type="text" class="form-control" value="{{ old('branch_head') }}" maxlength="50" name="branch_head" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Party Code No</label>
                                <input type="text" class="form-control" value="{{ old('party_code') }}"  maxlength="50" name="party_code" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Factory Code No</label>
                                <input type="text" class="form-control" value="{{ old('factory_code') }}" maxlength="50" name="factory_code" />
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Dist. Code</label>
                                <input type="text" class="form-control" value="{{ old('dist_code') }}" maxlength="50" name="dist_code" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Dispatch and Cont. SMS No</label>
                                <input type="text" name="dispatch_cont_sms_no" value="{{config('global.builderData.dispatchCont_SMS_Number')}}" readOnly class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Freight Code</label>
                                <input type="text" class="form-control" value="{{ old('frieght_code') }}" maxlength="25" name="frieght_code" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">A/C Ahemdabad</label>
                                <input type="text" class="form-control" value="{{ old('ac_ahmdbd') }}" maxlength="25" name="ac_ahmdbd" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">GST No<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('gst_no') }}" maxlength="25" name="gst_no" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">PAN Card No<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('pancard_no') }}" maxlength="25" name="pan_no" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Brand<span style="color:red;">*</span></label>
                                <select name="cement_brand" id="cement-brand" class="form-control cement-brand" required>
                                    @foreach(config('global.cementBrand') as $ckey=>$cvalue)
                                    <option value="{{$ckey}}">{{$cvalue}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Upload PAN Card file</label>
                                <input type="file" onchange="return fileValidation('pancard_file')" data-parsley-max-file-size="2400" name="pancard_file" id="pancard_file" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Upload Letterhead file</label>
                                <input type="file" onchange="return fileValidation('letterhead_file')" id="letterhead_file" data-parsley-max-file-size="2400" name="letterhead_file" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-4">
                                <label class="col-form-label">Upload Cancel Cheque file</label>
                                <input type="file" onchange="return fileValidation('cancel_cheque_file')" id="cancel_cheque_file" data-parsley-max-file-size="2400" name="cancel_cheque_file" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Upload GST file</label>
                                <input type="file" onchange="return fileValidation('gst_file')" data-parsley-max-file-size="2400" name="gst_file" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success " value="Submit" />
                                    <a href="/builders" class="btn btn-warning ">Cancel </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#is_dealing_other_firm').on('click', function() {
            if($(this).is(':checked')){
                $('#other_firm_details').attr('disabled', false);
            } else {
                $('#other_firm_details').attr('disabled', true); 
            }
        });

        // Dynamic fields
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.dynamic-site'); //Input field wrapper
        var fieldHTML = '<div class="row dynamic-site"><div class="form-group col-sm-3"><label class="col-form-label">Destination</label><input type="text" class="form-control" name="site_destination[]" /></div><div class="form-group col-sm-2"><label class="col-form-label">Taluka</label><input type="text" class="form-control" name="site_taluka[]"/></div><div class="form-group col-sm-2"><label class="col-form-label">District</label><input type="text" class="form-control" name="site_district[]" /></div><div class="form-group col-sm-2"><label class="col-form-label">Site Contact</label><input type="text" class="form-control" name="site_cntct[]"/></div><div class="form-group col-sm-1"><br><br><a href="javascript:void(0);" class="remove_button" style="font-size: 22px; color: red;" title="Add field"><i class="fa fa-minus"></i></div></div>'; 
        var x = 1;
        
        //Once add button is clicked
        $(addButton).on('click',function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).after(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(document).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).closest('.dynamic-site').remove(); //Remove field html
            x--; //Decrement field counter
        });

    });

    function fileValidation(id){
        var fileInput = document.getElementById(id);
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if(!allowedExtensions.exec(filePath)){
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script>
@endpush
@endsection