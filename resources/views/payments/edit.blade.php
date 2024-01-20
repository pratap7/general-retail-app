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
                                                <option {{($builder->id == $order->builder_id) ? "selected" : ''}} value="{{$builder->id}}" data-email="{{$builder->direct_customer_email}}" data-contact="{{$builder->owner_mobile}}" data-pan="{{$builder->pancard_no}}" data-gst="{{$builder->gst_no}}">{{$builder->party_name}}</option>
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
                                    <!-- <div class="form-group col-sm-4">
                                        <label class="col-form-label">Builder Email</label>
                                        <input name="builder_email" type="text" value="{{$order->Builder->direct_customer_email}}" id="builder-email" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Builder Contact</label>
                                        <input type="text" name="builder_contact" value="{{$order->Builder->owner_mobile}}" id="builder-contact" class="form-control" readOnly />
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Address</label>
                                        <input name="site_address" type="text" value="{{$order->site_address ?? 'N/A'}}" id="site-address" class="form-control" readOnly>
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
                                        <input name="taluka" type="text" id="taluka" value="{{$order->Builder->taluka}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Contact No</label>
                                        <input name="site_contact" value="9879598818" id="site_contact" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">District</label>
                                        <input name="district" type="text" value="{{$order->Builder->district}}" id="district" class="form-control" readOnly>
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
                            <!-- <div class="form-group col-sm-4">
                                <label class="col-form-label">Plant Email<span style="color:red;">*</span></label>
                                <input type="email" name="plant_email" value="{{$order->Plant->plant_email}}" id="plant-email" class="form-control" readOnly />
                            </div>  -->
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
                                <select name="quantity_type_kg" class="form-control" id="quantity-type-ambuja">
                                    @foreach(config('global.quantityTypeAmbuja') as $qt_key=>$qt_value)
                                        <option value="{{$qt_key}}">{{$qt_value}}</option>
                                        @endforeach
                                </select>
                                <select name="quantity_type_kg" id="quantity-type-hathi" class="form-control" disabled style="display:none;">
                                    @foreach(config('global.quantityTypeHathi') as $qt_key=>$qt_value)
                                        <option value="{{$qt_key}}">{{$qt_value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="form-group col-sm-4">
                                <label class="col-form-label">Total Amount <span style="color:red;">*</span></label>
                                <input name="total_amount" class="form-control" value="{{$order->total_amount}}" id="total_amount" />
                            </div> -->
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
                                <label class=" col-form-label">Amount</label>
                                <input type="text" value="{{old('amount')}}" id="amount" name="amount" class="form-control" />
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
                                <?php
                                    $order_schedules = array(
                                        'Immediate',
                                        'Daily 1',
                                        'Daily 2',
                                        'Daily 3'
                                    );
                                ?>
                                <select id="order_schedule" name="order_schedule" class="form-control">
                                    @foreach($order_schedules as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Update" />
                                    <a href="/orders" class="btn btn-info">Generate PDF </a>
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
        // var builderEmail = $('select.builder-id').find(':selected').data('email');
        // var builderContact = $('select.builder-id').find(':selected').data('contact'); 
        var builderPAN = $('select.builder-id').find(':selected').data('pan'); 
        var builderGST = $('select.builder-id').find(':selected').data('gst');
        var partyName = $('select.builder-id').find(':selected').data('party_name');
        var partyCode = $('select.builder-id').find(':selected').data('party_code');
        var siteAddress = $('select.builder-id').find(':selected').data('site_address');
        var taluka = $('select.builder-id').find(':selected').data('taluka');
        var district = $('select.builder-id').find(':selected').data('district');
        // $('#builder-email').val(builderEmail);
        // $('#builder-contact').val(builderContact);
        $('#pan-no').val(builderPAN);
        $('#gst-no').val(builderGST);
        $('#party-name').val(partyName);
        $('#party-code').val(partyCode);
        $('#site-address').val(siteAddress);
        $('#taluka').val(taluka);
        $('#district').val(district);
    });

    $('#plant-id').change(function() {
        var plantEmail = $('select.plant-id').find(':selected').data('email');
        //$('#plant-email').val(plantEmail);
    });

    $('#cement-brand').change(function(){
        if($(this).val() == 'ambuja'){
            document.getElementById('quantity-type-ambuja').disabled = false;
            document.getElementById("quantity-type-ambuja").style.display = "block";

            document.getElementById('quantity-type-hathi').disabled = true;
            document.getElementById("quantity-type-hathi").style.display = "none";
        } else {
            document.getElementById('quantity-type-ambuja').disabled = true;
            document.getElementById("quantity-type-ambuja").style.display = "none";

            document.getElementById('quantity-type-hathi').disabled = false;
            document.getElementById("quantity-type-hathi").style.display = "block";
        }
    });

    // $('#quantity_type_bag').keyup(function(){
    //     var bagCost = $('#bag-price').val();
    //     var totalBag = $(this).val();
    //     var totalCost = bagCost * totalBag;
    //     $('#total_amount').val(totalCost);
    // });
});
</script>
@endpush
@endsection