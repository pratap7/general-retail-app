@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Modify Order Form</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Orders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Modify</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Modify Order Form</h5>
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
                    <form method="POST" action="{{ route('orders.update', $order->id) }}"  data-parsley-validate>
                        @method('PATCH')
                        @csrf
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <h5>Builder Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Choose Builder<span style="color:red;">*</span></label>
                                        <select name="builder_id" id="builder-id" class="form-control builder-id" disabled>
                                            @foreach($builders as $builder)
                                                @php 
                                                    $site_destinations = json_encode(unserialize($builder->site_destinations));
                                                @endphp
                                                <option {{($builder->id == $order->builder_id) ? "selected" : ''}} value="{{$builder->id}}" data-email="{{$builder->direct_customer_email}}" data-contact="{{$builder->owner_mobile}}" data-pan="{{$builder->pancard_no}}" data-gst="{{$builder->gst_no}}" data-site_destinations="{{$site_destinations}}">{{$builder->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Name</label>
                                        <input name="party_name" type="text" value="{{$order->Builder->party_name}}" id="party-name" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Code</label>
                                        <input name="party_code" type="text" value="{{$order->Builder->party_code}}" id="party-code" class="form-control" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Address</label>
                                        <select name="site_address" id="site-address" class="form-control" readOnly>
                                            @forelse($currentSiteDestinations as $ct)
                                                @php 
                                                $selected = "";
                                                if($ct['destination'] == $order->site_address){
                                                   $selected = "selected";
                                                   $site_contact = $ct['contact'] ?? "N/A";
                                                   $site_taluka = $ct['taluka'] ?? "N/A";
                                                   $site_district = $ct['district'] ?? "N/A";
                                                }
                                                @endphp
                                                <option {{$selected ?? ""}} value="{{$ct['destination']}}" data-taluka="{{$ct['taluka'] ?? 'N/A'}}" data-district="{{$ct['district'] ?? 'N/A' }}" data-contact="{{$ct['contact'] ?? ''}}">{{$ct['destination']}}</option>
                                            @empty
                                                <option value="">Please Select</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">GST No</label>
                                        <input name="gst_no" id="gst-no" class="form-control" value="{{$order->Builder->gst_no}}" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">PAN No</label>
                                        <input name="pan_no" type="text" id="pan-no" class="form-control" value="{{$order->Builder->pancard_no}}" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Taluka</label>
                                        <input name="taluka" type="text" id="site_taluka" value="{{$site_taluka ?? 'N/A'}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Contact No</label>
                                        <input name="site_contact" value="{{$site_contact ?? 'N/A'}}" id="site_contact" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">District</label>
                                        <input name="district" type="text" value="{{$site_district ?? 'N/A'}}" id="site_district" class="form-control" readOnly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Brand<span style="color:red;">*</span></label>
                                <select name="cement_brand" id="cement-brand" class="form-control cement-brand" required>
                                    @foreach(config('global.cementBrand') as $ckey=>$cvalue)
                                    <option {{($ckey == $order->cement_brand) ? "selected" : ''}} value="{{$ckey}}">{{$cvalue}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Type<span style="color:red;">*</span></label>
                                <select name="cement_type" id="cement-type" class="form-control cement-type" required>
                                    @foreach(config('global.cementType') as $ckey=>$cvalue)
                                    <option {{($ckey == $order->cement_type) ? "selected" : ''}} value="{{$ckey}}">{{$cvalue}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Plant Name<span style="color:red;">*</span> </label>
                                <select name="plant_id" id="plant-id" class="form-control plant-id" required>
                                    <option value="">Select Plant</option>
                                    @foreach($plants as $plant)
                                    <option {{($plant->id == $order->plant_id) ? "selected" : ''}} value="{{$plant->id}}" data-email="{{$plant->plant_email}}">{{$plant->plant_name}}</option>
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
                                        <option {{($pt_key == $order->packing_type) ? "selected" : ''}} value="{{$pt_key}}">{{$pt_value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-4">
                                <label class="col-form-label">Price (Including All Tax) <span style="color:red;">*</span></label>
                                <input type="text" name="bag_price" value="{{ $order->bag_price}}" id="bag-price" maxlength="10" placeholder="Enter Bag Price" data-parsley-type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">MT of Cement<span style="color:red;">*</span></label>
                                <div class="input-group m-b">
                                    <input type="text" name="quantity_type_kg" value="{{$order->quantity_type_kg}}" class="form-control" id="quantity-type-ambuja" />
                                    <div class="input-group-append">
                                        <span class="input-group-addon">MT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Delivery Address</label>
                                <select name="delivery_address" id="delivery_address" class="form-control site-address">
                                    @foreach($currentSiteDestinations as $ct)
                                        @php 
                                        $selected = "";
                                        if($ct['destination'] == $order->delivery_address){
                                            $selected = "selected";
                                        }
                                        @endphp
                                        <option {{$selected ?? ""}} value="{{$ct['destination']}}">{{$ct['destination']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Payment Detail</label>
                                <input type="text" value="{{$order->payment_detail}}" name="payment_detail" id="payment_detail" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cheque No</label>
                                <input type="text" value="{{$order->cheque_no}}" id="cheque_no" name="cheque_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Cheque Date</label>
                                <input type="date" value="{{$order->cheque_date}}" onkeydown="return false" id="cheque_date" name="cheque_date" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Bank</label>
                                <input type="text" value="{{$order->bank}}" id="bank" name="bank" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order No </label>
                                <input type="text" value="{{$order->order_no}}" id="order_no" name="order_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Schedule Order</label>
                                <input type="text" id="order_schedule" value="{{$order->order_schedule ?? 'N/A'}}" name="order_schedule" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Billing Address</label>
                                <input type="text" value="{{$order->Builder->postal_address ?? 'N/A' }}" id="billing_address" name="billing_address" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Rate Per Mt</label>
                                <input type="text" value="{{$order->rate_per_mt}}" id="rate_per_mt" name="rate_per_mt" class="form-control" />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Update" />
                                    <a href="{{ route('order.review',$order->id)}}" class="btn btn-info">Review</a>
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
        var taluka = $('select.builder-id').find(':selected').data('taluka');
        var district = $('select.builder-id').find(':selected').data('district');
        $('#pan-no').val(builderPAN);
        $('#gst-no').val(builderGST);
        $('#party-name').val(partyName);
        $('#party-code').val(partyCode);
        $('#taluka').val(taluka);
        $('#district').val(district);
    });

    $('#plant-id').change(function() {
        var plantEmail = $('select.plant-id').find(':selected').data('email');
    });

    $(document).on('change','#site-address', function(){
        var siteContact = $('#site-address').find(':selected').data('contact')
        siteContact = (siteContact == null || siteContact == 'undefined' || siteContact == "") ? "N/A" : siteContact;
        $('#site_contact').val(siteContact);
        siteTaluka = $('#site-address').find(':selected').data('taluka');
        siteTaluka = (siteTaluka == null || siteTaluka == 'undefined' || siteTaluka == "") ? "N/A" : siteTaluka;
        siteDistrict = $('#site-address').find(':selected').data('district');
        siteDistrict = (siteDistrict == null || siteDistrict == 'undefined' || siteDistrict == "") ? "N/A" : siteDistrict;
        $('#site_taluka').val(siteTaluka);
        $('#site_district').val(siteDistrict);
    });
});
</script>
@endpush
@endsection