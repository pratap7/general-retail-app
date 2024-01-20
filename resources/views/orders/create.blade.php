@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Book Order Form</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Orders</a>
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
                    <h5>Book Order Form</h5>
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
                    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <h5>Builder Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Choose Builder<span style="color:red;">*</span></label>
                                        <select name="builder_id" id="builder-id" class="form-control builder-id" required>
                                            <option value="" selected>Select Builder</option>
                                            @foreach($builders as $builder)
                                                @php 
                                                    $site_destinations = json_encode(unserialize($builder->site_destinations));
                                                @endphp
                                                <option value="{{$builder->id}}" data-email="{{$builder->direct_customer_email}}" data-contact="{{$builder->owner_mobile}}" data-pan="{{$builder->pancard_no}}" data-gst="{{$builder->gst_no}}" data-party_name="{{$builder->party_name}}" data-party_code="{{$builder->party_code}}" data-taluka="{{$builder->taluka}}" data-district="{{$builder->district}}" data-address="{{$builder->postal_address}}" data-site_destinations="{{$site_destinations}}">{{$builder->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Name</label>
                                        <input name="party_name" type="text" id="party-name" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Code</label>
                                        <input name="party_code" type="text" id="party-code" class="form-control" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Address</label>
                                        <select name="site_address" id="site-address" class="form-control site-address">
                                        <option>Please select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">GST No</label>
                                        <input name="gst_no" id="gst-no" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">PAN No</label>
                                        <input name="pan_no" type="text" id="pan-no" class="form-control" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Taluka</label>
                                        <input name="taluka" type="text" id="site_taluka" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Contact No</label>
                                        <input name="site_contact" value="N/A" id="site_contact" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">District</label>
                                        <input name="district" type="text" id="site_district" class="form-control" readOnly>
                                    </div>
                                </div>
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
                                <label class="col-form-label">Cement Type<span style="color:red;">*</span></label>
                                <select name="cement_type" id="cement-type" class="form-control cement-type" required>
                                    @foreach(config('global.cementType') as $ckey=>$cvalue)
                                    <option value="{{$ckey}}">{{$cvalue}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Plant Name<span style="color:red;">*</span> </label>
                                <select name="plant_id" id="plant-id" class="form-control plant-id" required>
                                    <option value="">Select Plant</option>
                                    @foreach($plants as $plant)
                                    <option value="{{$plant->id}}" data-email="{{$plant->plant_email}}">{{$plant->plant_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">TPC Code</label>
                                <input type="text" value="GSC571" id="tpc-code" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">TPC Name</label>
                                <input type="text" value="SHYAM CORPORATION" id="tpc-name" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Packing Type<span style="color:red;">*</span></label>
                                <select type="text" name="packing_type" class="form-control" required> 
                                    @foreach(config('global.packingType') as $pt_key=>$pt_value)
                                        <option value="{{$pt_key}}">{{$pt_value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Price (Including All Tax) <span style="color:red;">*</span></label>
                                <input type="text" name="bag_price" value="{{ old('bag_price') }}" id="bag-price" maxlength="10" placeholder="Enter Bag Price" data-parsley-type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">MT of Cement<span style="color:red;">*</span></label>
                                <div class="input-group m-b">
                                    <input type="text" name="quantity_type_kg" class="form-control" id="quantity-type-ambuja" required />
                                    <div class="input-group-append">
                                        <span class="input-group-addon">MT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Delivery Address</label>
                                <select name="delivery_address" id="delivery_address" class="form-control site-address">
                                    <option>Please select</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Payment Detail</label>
                                <input type="text" value="{{old('payment_detail')}}" name="payment_detail" id="payment_detail" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cheque No</label>
                                <input type="text" value="{{old('cheque_no')}}" id="cheque_no" name="cheque_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Cheque Date</label>
                                <input type="date" value="{{old('cheque_date')}}" onkeydown="return false" id="cheque_date" name="cheque_date" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Bank</label>
                                <input type="text" value="{{old('bank')}}" id="bank" name="bank" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order No</label>
                                <input type="text" value="{{old('order_no')}}" id="order_no" name="order_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Schedule Order</label>
                                <input type="text" id="order_schedule" value="{{old('order_schedule')}}" name="order_schedule" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Billing Address</label>
                                <input type="text" value="{{old('billing_address')}}" id="billing_address" name="billing_address" class="form-control" readonly/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Rate Per Mt</label>
                                <input type="text" value="{{old('rate_per_mt')}}" id="rate_per_mt" name="rate_per_mt" class="form-control" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                                    <a href="/orders" class="btn btn-warning">Cancel </a>
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
$(document).ready(function() {
    $('#builder-id').change(function() {
        var builderPAN = $('select.builder-id').find(':selected').data('pan'); 
        var builderGST = $('select.builder-id').find(':selected').data('gst');
        var partyName = $('select.builder-id').find(':selected').data('party_name');
        var partyCode = $('select.builder-id').find(':selected').data('party_code');
        var siteAddresses = $('select.builder-id').find(':selected').data('site_destinations');
        var taluka = $('select.builder-id').find(':selected').data('taluka');
        var district = $('select.builder-id').find(':selected').data('district');
        var billingAddress = $('select.builder-id').find(':selected').attr('data-address');
        $('#pan-no').val(builderPAN);
        $('#gst-no').val(builderGST);
        $('#party-name').val(partyName);
        $('#party-code').val(partyCode);
        $('#billing_address').val(billingAddress);

        // Generate dropdown for site destinations
        var site_destinations = "";
        var site_contact = site_taluka = site_district = "";
        siteAddresses.forEach(function(item, index, array) {
            if(index == 0){
                site_contact = (item.contact == null || item.contact == 'undefined' || item.contact == "") ? "N/A" : item.contact;
                site_taluka = (item.taluka == null || item.taluka == 'undefined' || item.taluka == "") ? "N/A" : item.taluka;
                site_district = (item.district == null || item.district == 'undefined' || item.district == "") ? "N/A" : item.district;
            }
            site_destinations += "<option data-contact='"+item.contact+"' data-taluka='"+item.taluka+"' data-district='"+item.district+"' value='"+ item.destination +"'>" + item.destination + "</option>";
        });
        $(".site-address").html(site_destinations);
        document.getElementById("site_contact").value = site_contact;
        $('#site_taluka').val(site_taluka);
        $('#site_district').val(site_district);
    });

    $(document).on('change','#site-address', function(){
        var siteContact = $('#site-address').find(':selected').data('contact');
        siteContact = (siteContact == null || siteContact == 'undefined' || siteContact == "") ? "N/A" : siteContact;
        siteTaluka = $('#site-address').find(':selected').data('taluka');
        siteTaluka = (siteTaluka == null || siteTaluka == 'undefined' || siteTaluka == "") ? "N/A" : siteTaluka;
        siteDistrict = $('#site-address').find(':selected').data('district');
        siteDistrict = (siteDistrict == null || siteDistrict == 'undefined' || siteDistrict == "") ? "N/A" : siteDistrict;
        $('#site_contact').val(siteContact);
        $('#site_taluka').val(siteTaluka);
        $('#site_district').val(siteDistrict);
    });

    $('#plant-id').change(function() {
        var plantEmail = $('select.plant-id').find(':selected').data('email');
    });

});
</script>
@endpush
@endsection