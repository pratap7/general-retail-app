@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Payment List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Payments</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
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
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{Session::get('error')}}
    </div>
@endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Payment Detail</h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
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
                    <form method="POST" action="{{ route('payment.save') }}" data-parsley-validate>
                        @csrf
                        <input type="hidden" name="builder_id" value="{{$order->Builder->id}}" />
                        <input type="hidden" name="order_id" value="{{$order->id}}" />
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <h5>Order Detail 
                                    @if(empty($utilizeStatus))
                                    <button disabled class="btn btn-success pull-right">Utilize Payment</button>
                                    @else
                                    <a href="{{route('payment.utilize',$order->id)}}" class="btn btn-success pull-right">Utilize Payment</a>
                                    @endif
                                    </h5> <span class="badge badge-info">{{$order->order_no}}</span>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Party Name</label>
                                        <input name="party_name" value="{{$order->Builder->party_name}}" type="text" id="party-name" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Party Code</label>
                                        <input name="party_name" value="{{$order->Builder->party_code}}" type="text" id="party-name" class="form-control" readOnly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Payment Mode<span style="color:red;">*</span></label>
                                <select name="payment_mode" id="payment-mode" class="form-control payment-mode" required>
                                    @foreach(config('global.paymentMode') as $ckey=>$cvalue)
                                    <option value="{{$ckey}}">{{$cvalue}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Date<span style="color:red;">*</span></label>
                                <input name="date" value="{{date('d/m/Y')}}" id="date" class="form-control" readOnly />
                            </div>
                        </div>

                        <div class="card bg-light text-dark" id="by-cash">
                            <div class="card-header">
                                <h5>By Cash</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <div class="form-group col-sm-12">
                                        <label class="col-form-label">Amount in Rs</label>
                                        <input type="text" maxlength="7" name="cash_amount" value="{{old('cash_amount')}}" placeholder="Please enter amount." id="cash_amount" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light text-dark mt-2" id="by-cheque" style="display: none;">
                            <div class="card-header">
                                <h5 id="cheque-rtgs">By Cheque</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">  
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label cheque-rtgs-no" >Cheque No</label>
                                        <input type="text" name="cheque_rtgs_no" value="{{old('cheque_rtgs_no')}}" id="cheque-rtgs-no" placeholder="Enter Cheque/RTGS No" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Amount in Rs</label>
                                        <input type="text" name="cheque_amount" id="cheque-amount" value="{{old('cheque_amount')}}" placeholder="Please enter rs." class="form-control" />
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Account No</label>
                                        <input type="text" name="account_no" value="{{old('account_no')}}"  placeholder="Please enter account no." class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Bank Name</label>
                                        <input type="text" name="bank_name" value="{{old('bank_name')}}" placeholder="Please enter bank name." class="form-control" />
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">IFSC code</label>
                                        <input type="text" name="ifsc_code" value="{{old('ifsc_code')}}" placeholder="Please enter IFSC code." class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Branch Name</label>
                                        <input type="text" name="branch_name" value="{{old('branch_name')}}" placeholder="Please enter branch name." class="form-control" />
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label">Account Holder Name</label>
                                        <input type="text" name="account_holder" value="{{old('account_holder')}}" placeholder="Please enter Account Holder Name." class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Remarks<span style="color:red;">*</span></label>
                                <input name="remarks" value="{{old('remarks')}}" id="remarks" class="form-control" required />
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Remarks(From Party)</label>
                                <input type="text" name="party_remarks" id="party-remarks" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label class="col-form-label">Invoice Reference for Payment</label>
                                <input type="text" name="invoice_reference" value="{{old('invoice_reference')}}" placeholder="Please enter Invoice Reference for Payment." class="form-control" />
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bank Name</th>
                                    <th>ACC No</th>
                                    <th>Payment Mode</th>
                                    <th>Cheque/RTGS No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Utilized</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($payments as $payment)
                                <tr class="gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{($payment->bank_name) ? $payment->bank_name : "N/A"}}</td>
                                    <td>{{($payment->account_no) ? $payment->account_no : "N/A"}}</td>
                                    <td>{{config('global.paymentMode')[$payment->payment_mode]}}</td>
                                    <td>{{($payment->cheque_rtgs_no) ? $payment->cheque_rtgs_no : 'N/A'}}</td>
                                    <td>{{$payment->created_at->format('d/m/yy')}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{($payment->utilize == 1) ? 'YES' : "NO"}}</td>
                                    <td class="center">
                                        @if($payment->utilize == 0)
                                            <button class="btn btn-info btn-sm edit-button" type="button" href="javascript:void(0);" data-paymentDetail="{{$payment}}" data-createdAt="{{$payment->created_at->format('d/m/yy')}}"><i class="fa fa-pencil"></i> Edit </button> &nbsp;
                                        @else
                                        <button class="btn btn-success btn-sm view-button" type="button" href="javascript:void(0);" data-paymentDetail="{{$payment}}" data-createdAt="{{$payment->created_at->format('d/m/yy')}}"><i class="fa fa-eye"></i> View </button> &nbsp;
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="gradeX">
                                    <td class="center" align="center" colspan="7">Data not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a class="btn btn-info btn-sm edit-button" type="button" href="{{route('payment-generate-pdf',$order->id)}}" target="_blank"><i class="fa fa-file-pdf-o"></i> Review PDF </a> &nbsp;
                        <button type="button" data-toggle="modal" data-target="#sendEmail" class="btn btn-success btn-sm edit-button" href="javascript:void(0);"><i class="fa fa-envelope-square"></i> Send Email </button> &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Payment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('payment.update') }}">
            @csrf
            <input type="hidden" name="payment_id" id="payment-id" value="" required />
            <input type="hidden" name="builder_id" value="{{$order->Builder->id}}" required />
            <input type="hidden" name="order_id" value="{{$order->id}}" required />
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h5>Order Detail</h5> <span class="badge badge-info">{{$order->order_no}}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Code</label>
                            <input name="party_name" value="{{$order->Builder->party_code}}" type="text" id="party-code" class="form-control" readOnly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Name</label>
                            <input name="party_name" value="{{$order->Builder->party_name}}" type="text" id="party-name" class="form-control" readOnly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Payment Mode<span style="color:red;">*</span></label>
                    <select name="payment_mode" id="edit-payment-mode" class="form-control payment-mode" required>
                        @foreach(config('global.paymentMode') as $ckey=>$cvalue)
                        <option value="{{$ckey}}">{{$cvalue}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Date<span style="color:red;">*</span></label>
                    <input name="date" value="" id="edit-date" class="form-control" readOnly />
                </div>
            </div>

            <div class="card bg-light text-dark" id="edit-by-cash">
                <div class="card-header">
                    <h5>By Cash</h5>
                </div>
                <div class="card-body">
                    <div class="row">  
                        <div class="form-group col-sm-12">
                            <label class="col-form-label">Amount in Rs</label>
                            <input type="text" maxlength="7" name="cash_amount" value="" placeholder="Please enter amount." id="edit-cash-amount" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light text-dark mt-2" id="edit-by-cheque" style="display: none;">
                <div class="card-header">
                    <h5 id="edit-cheque-rtgs">By Cheque</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label edit-cheque-rtgs-no">RTGS No</label>
                            <input type="text" name="cheque_rtgs_no" id="edit-cheque-rtgs-no" placeholder="Enter Cheque/RTGS No" class="form-control" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Amount in Rs</label>
                            <input type="text" name="cheque_amount" id="edit-cheque-amount" placeholder="Please enter rs." class="form-control" />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Account No</label>
                            <input type="text" name="account_no" id="edit-account-no" placeholder="Please enter account no." class="form-control" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Bank Name</label>
                            <input type="text" name="bank_name" id="edit-bank-name" placeholder="Please enter bank name." class="form-control" />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">IFSC code</label>
                            <input type="text" name="ifsc_code" value="" id="edit-ifsc-code" placeholder="Please enter IFSC code." class="form-control" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Branch Name</label>
                            <input type="text" name="branch_name" value="" id="edit-branch-name" placeholder="Please enter branch name." class="form-control" />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Account Holder Name</label>
                            <input type="text" name="account_holder" value="" id="edit-account-holder" placeholder="Please enter Account Holder Name." class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Remarks<span style="color:red;">*</span></label>
                    <input name="remarks" id="edit-remarks" class="form-control" required />
                </div>
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Remarks(From Party)</label>
                    <input type="text" name="party_remarks" id="edit-party-remarks" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Invoice Reference for Payment</label>
                    <input type="text" name="invoice_reference" id="edit-invoice-reference" placeholder="Please enter Invoice Reference for Payment." class="form-control" />
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <input type="submit" name="submit" class="btn btn-success" value="Update" />
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

<div class="modal fade" id="sendEmail" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Send Email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('payments.sendEmail')}}" data-parsley-validate>
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




<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Payment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="" action="">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h5>Order Detail</h5> <span class="badge badge-info">{{$order->order_no}}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Code</label>
                            <input name="party_name" value="{{$order->Builder->party_code}}" type="text" class="form-control" readOnly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Name</label>
                            <input name="party_name" value="{{$order->Builder->party_name}}" type="text" id="party-name" class="form-control" readOnly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Payment Mode</label>
                    <select name="payment_mode" id="view-payment-mode" class="form-control payment-mode" readOnly>
                        @foreach(config('global.paymentMode') as $ckey=>$cvalue)
                        <option value="{{$ckey}}">{{$cvalue}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Date</label>
                    <input name="date" id="view-date" class="form-control" readOnly />
                </div>
            </div>

            <div class="card bg-light text-dark" id="view-by-cash">
                <div class="card-header">
                    <h5>By Cash</h5>
                </div>
                <div class="card-body">
                    <div class="row">  
                        <div class="form-group col-sm-12">
                            <label class="col-form-label">Amount in Rs</label>
                            <input type="text" maxlength="7" name="cash_amount" id="view-cash-amount" class="form-control" readOnly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light text-dark mt-2" id="view-by-cheque" style="display: none;">
                <div class="card-header">
                    <h5 id="edit-cheque-rtgs">By Cheque</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label edit-cheque-rtgs-no">RTGS No</label>
                            <input type="text" name="cheque_rtgs_no" id="view-cheque-rtgs-no" class="form-control" readOnly />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Amount in Rs</label>
                            <input type="text" name="cheque_amount" id="view-cheque-amount" class="form-control" readOnly />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Account No</label>
                            <input type="text" name="account_no" id="view-account-no" class="form-control" readOnly />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Bank Name</label>
                            <input type="text" name="bank_name" id="view-bank-name" class="form-control" readOnly />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">IFSC code</label>
                            <input type="text" name="ifsc_code" value="" id="view-ifsc-code" class="form-control" readOnly />
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Branch Name</label>
                            <input type="text" name="branch_name" value="" id="view-branch-name" class="form-control" readOnly />
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Account Holder Name</label>
                            <input type="text" name="account_holder" value="" id="view-account-holder" class="form-control" readOnly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Remarks</label>
                    <input name="remarks" id="view-remarks" class="form-control" readOnly />
                </div>
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Remarks(From Party)</label>
                    <input type="text" name="party_remarks" id="view-party-remarks" class="form-control" readOnly />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="col-form-label">Invoice Reference for Payment</label>
                    <input type="text" name="invoice_reference" id="view-invoice-reference" class="form-control" readOnly />
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
        $('#payment-mode').change(function(){
            if($(this).val() == 1){
                document.getElementById('by-cash').style.display = "block";
                document.getElementById('by-cheque').style.display = "none";
            } else {
                var cardTitle = "By Cheque";
                var chequeRTGS = "Cheque No";
                if($(this).val() == 2){
                    cardTitle = "By RTGS";
                    chequeRTGS = "RTGS No";
                }
                $('#cheque-rtgs').html(cardTitle);
                $('.cheque-rtgs-no').html(chequeRTGS);
                document.getElementById('by-cash').style.display = "none";
                document.getElementById('by-cheque').style.display = "block";
            }
        });

        $('#edit-payment-mode').change(function(){
            if($(this).val() == 1){
                document.getElementById('edit-by-cash').style.display = "block";
                document.getElementById('edit-by-cheque').style.display = "none";
            } else {
                var cardTitle = "By Cheque";
                var chequeRTGS = "Cheque No";
                if($(this).val() == 2){
                    cardTitle = "By RTGS";
                    chequeRTGS = "RTGS No";
                }
                $('#edit-cheque-rtgs').html(cardTitle);
                $('.edit-cheque-rtgs-no').html(chequeRTGS);
                document.getElementById('edit-by-cash').style.display = "none";
                document.getElementById('edit-by-cheque').style.display = "block";
            }
        });

        $('.edit-button').on('click', function(){
            var data = $(this).attr('data-paymentDetail');
            var create_date = $(this).attr('data-createdAt');
            dataObj = JSON.parse(data);
            $('#edit-payment-mode').val(dataObj.payment_mode);
            if(dataObj.payment_mode == 1){
                document.getElementById('edit-by-cash').style.display = "block";
                document.getElementById('edit-by-cheque').style.display = "none";
            } else {
                document.getElementById('edit-by-cash').style.display = "none";
                document.getElementById('edit-by-cheque').style.display = "block";
            }

            $('#payment-id').val(dataObj.id);
            $('#edit-date').val(create_date);
            $('#edit-cash-amount').val(dataObj.amount);
            $('#edit-cheque-rtgs-no').val(dataObj.cheque_rtgs_no);
            $('#edit-cheque-amount').val(dataObj.amount);
            $('#edit-account-no').val(dataObj.account_no);
            $('#edit-bank-name').val(dataObj.bank_name);
            $('#edit-ifsc-code').val(dataObj.ifsc_code);
            $('#edit-branch-name').val(dataObj.branch_name);
            $('#edit-remarks').val(dataObj.remarks);
            $('#edit-party-remarks').val(dataObj.party_remarks);
            $("#edit-account-holder").val(dataObj.account_holder);
            $('#edit-invoice-reference').val(dataObj.invoice_reference)
            $('#myModal').modal('show');
        });


        // To View Payment
        $('.view-button').on('click', function(){
            var data = $(this).attr('data-paymentDetail');
            var create_date = $(this).attr('data-createdAt');
            dataObj = JSON.parse(data);
            $('#view-payment-mode').val(dataObj.payment_mode);
            if(dataObj.payment_mode == 1){
                document.getElementById('view-by-cash').style.display = "block";
                document.getElementById('view-by-cheque').style.display = "none";
            } else {
                document.getElementById('view-by-cash').style.display = "none";
                document.getElementById('view-by-cheque').style.display = "block";
            }

            $('#view-date').val(create_date);
            $('#view-cash-amount').val(dataObj.amount);
            $('#view-cheque-rtgs-no').val(dataObj.cheque_rtgs_no);
            $('#view-cheque-amount').val(dataObj.amount);
            $('#view-account-no').val(dataObj.account_no);
            $('#view-bank-name').val(dataObj.bank_name);
            $('#view-ifsc-code').val(dataObj.ifsc_code);
            $('#view-branch-name').val(dataObj.branch_name);
            $('#view-remarks').val(dataObj.remarks);
            $('#view-party-remarks').val(dataObj.party_remarks);
            $("#view-account-holder").val(dataObj.account_holder);
            $('#view-invoice-reference').val(dataObj.invoice_reference)
            $('#viewModal').modal('show');
        });
    });

    //Datatables script [Only for listing pages]
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},
                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });
    });           
</script>
@endpush
@endsection