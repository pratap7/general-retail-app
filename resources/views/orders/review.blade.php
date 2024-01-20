@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Review Order</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Orders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Review</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
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
                    <h5>Review Order</h5>
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
                    <form method="POST" action="">
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <h5>Builder Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Choose Builder<span style="color:red;">*</span></label>
                                        <select name="builder_id" id="builder-id" class="form-control builder-id" disabled>
                                            <option value="{{$order->Builder->id}}">{{$order->Builder->party_name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Name</label>
                                        <input name="party_name" type="text" value="{{$order->Builder->party_name}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Code</label>
                                        <input name="party_code" type="text" value="{{$order->Builder->party_code}}" id="party-code" class="form-control" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Address</label>
                                        <input name="site_address" type="text" value="{{$order->site_address ?? 'N/A'}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">GST No</label>
                                        <input name="gst_no" class="form-control" value="{{$order->Builder->gst_no}}" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">PAN No</label>
                                        <input name="pan_no" type="text" class="form-control" value="{{$order->Builder->pancard_no ?? 'N/A'}}" readOnly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Taluka</label>
                                        <input name="taluka" type="text" value="{{$order->site_taluka ?? 'N/A'}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Site Contact No</label>
                                        <input name="site_contact" value="{{$order->site_contact ?? 'N/A'}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">District</label>
                                        <input name="district" type="text" value="{{$order->site_district ?? 'N/A'}}" class="form-control" readOnly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Brand<span style="color:red;">*</span></label>
                                <input type="text" name="cement_brand" value="{{config('global.cementBrand')[$order->cement_brand]}}" class="form-control cement-brand" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cement Type<span style="color:red;">*</span></label>
                                <input name="cement_type" type="text" class="form-control cement-type" value="{{config('global.cementType')[$order->cement_type]}}" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Plant Name<span style="color:red;">*</span> </label>
                                <input name="plant_id" type="text" value="{{$order->Plant->plant_name}}" class="form-control plant-id" readOnly />
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
                                <input type="text" name="packing_type" value="{{config('global.packingType')[$order->packing_type]}}" class="form-control" readOnly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Price (Including All Tax) <span style="color:red;">*</span></label>
                                <input type="text" name="bag_price" value="{{ $order->bag_price}}" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">MT of Cement<span style="color:red;">*</span></label>
                                <div class="input-group m-b">
                                    <input type="text" name="quantity_type_kg" value="{{$order->quantity_type_kg ?? 'N/A'}}" class="form-control" id="quantity-type-ambuja" readOnly />
                                    <div class="input-group-append">
                                        <span class="input-group-addon">MT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Delivery Address</label>
                                <input type="text" value="{{$order->delivery_address}}" id="delivery_address" name="delivery_address" class="form-control" readOnly />
                            </div>
                        </div>
                        <div class="row">  
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Payment Detail</label>
                                <input type="text" value="{{$order->payment_detail}}" name="payment_detail" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Cheque No</label>
                                <input type="text" value="{{$order->cheque_no}}" name="cheque_no" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Cheque Date</label>
                                <input type="text" value="{{$order->cheque_date}}" name="cheque_date" class="form-control" readOnly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Bank</label>
                                <input type="text" value="{{$order->bank}}" name="bank" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Order No</label>
                                <input type="text" value="{{$order->order_no}}" name="order_no" class="form-control" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class=" col-form-label">Schedule Order</label>
                                <input type="text" value="{{$order->order_schedule}}" id="order_schedule" name="order_schedule" class="form-control" readOnly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Billing Address</label>
                                <input type="text" value="{{$order->Builder->postal_address ?? 'N/A'}}" id="billing_address" name="billing_address" class="form-control" readonly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Rate Per Mt</label>
                                <input type="text" value="{{$order->rate_per_mt ?? 'N/A'}}" id="rate_per_mt" name="rate_per_mt" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <a href="{{route('orders.edit', $order->id)}}" class="btn btn-success">Edit Order</a>
                                    <a href="{{route('generate-pdf',$order->id)}}" target="_blank" class="btn btn-info">Preview PDF </a>
                                    <button type="button" data-toggle="modal" data-target="#sendEmail" class="btn btn-warning">Send Email </button>
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


<div class="modal fade" id="sendEmail" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Send Email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('order.sendEmail')}}" data-parsley-validate>
            @csrf
            <input type="hidden" name="order_id" value="{{$order->id}}" required />
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
@endsection