@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dispatch Reports</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Dispatch</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Ambuja</strong>
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
                    <h5>Dispatch Ambuja</h5>
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
                    <form method="POST" action="{{ route('dispatch.save') }}" data-parsley-validate>
                        @csrf
                        <input type="hidden" name="type" value="ambuja" />
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Type<span style="color:red;">*</span></label>
                                <input id="type" class="form-control" value="AMBUJA CEMENTS LTD" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Sd Name</label>
                                <select name="party_name" id="party-name" class="form-control">
                                    <option value="">Select Party name</option>
                                    @foreach($builders as $builder)
                                    <option data-party_code="{{$builder->party_code ?? 'N/A'}}" value="{{$builder->party_name ?? ''}}">{{$builder->party_name ?? 'N/A'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Sd Code</label>
                                <input name="party_code" value="{{old('party_code')}}" id="party-code" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">RD-RL-SH</label>
                                <input name="truck_no" value="{{old('truck_no')}}" id="truck_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">City</label>
                                <input type="text" name="location" value="{{old('location')}}" id="location" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Reff Doc No</label>
                                <input type="text" name="ref_doc_no" value="{{old('ref_doc_no')}}" id="ref_doc_no" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">GRO Price</label>
                                <input type="text" maxlength="10" title="Please enter valid amount." name="invoice_amount" value="{{old('invoice_amount')}}" pattern="[0-9]+" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Delivery Date</label>
                                <input type="date" name="del_date" value="{{old('del_date')}}" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Quantity</label>
                                <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Invoice No</label>
                                <input name="invoice_no" value="{{old('invoice_no')}}" id="invoice_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">S Plan No</label>
                                <input type="text" name="s_plan_no" value="{{old('s_plan_no')}}" id="s_plan_no" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Transport Name</label>
                                <input type="text" name="transport_name" value="{{old('transport_name')}}" id="transport_name" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order No</label>
                                <input type="text" name="order_no" value="{{old('order_no')}}" id="order_no" class="form-control" />
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
                                    <th>SD Code</th>
                                    <th>SD Name</th>
                                    <th>City</th>
                                    <th>Reff.Doc No</th>
                                    <th>GRO Price</th>
                                    <th>Del Date</th>
                                    <th>Quanity</th>
                                    <th>Invoice No</th>
                                    <th>S Plan No</th>
                                    <th>Transport Name</th>
                                    <th>Order No</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($all_reports as $report)
                                <tr class="gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$report->party_code ?? "N/A"}}</td>
                                    <td>{{$report->party_name ?? "N/A"}}</td>
                                    <td>{{$report->location ?? 'N/A'}}</td>
                                    <td>{{$report->ref_doc_no ?? "N/A"}}</td>
                                    <td>{{$report->invoice_amount ?? "N/A"}}</td>
                                    <td>{{$report->del_date ?? "N/A"}}</td>
                                    <td>{{$report->quantity ?? "N/A"}}</td>
                                    <td>{{$report->invoice_no ?? "N/A"}}</td>
                                    <td>{{$report->s_plan_no ?? "N/A"}}</td>
                                    <td>{{$report->transport_name ?? "N/A"}}</td>
                                    <td>{{$report->order_no ?? "N/A"}}</td>
                                    <td class="center">
                                        <button class="btn btn-info btn-sm edit-button" type="button" href="javascript:void(0);" data-reportDetail="{{$report}}"><i class="fa fa-pencil"></i> Edit </button> &nbsp;
                                        <a href="{{route('dispatch.send-message',$report->id)}}" type="button" class="btn btn-success btn-sm send-sms"><i class="fa fa-message"></i> Send SMS</a>
                                        <form action="{{route('dispatch-delete', $report->id)}}" onsubmit="return confirm('Do you really want to delete this entry?');" method="post">
                                            @csrf
                                            <a href="javascript:{}" class="btn btn-white btn-sm" onclick="$(this).closest('form').submit();"><i style="color:red;" class="fa fa-trash"></i> Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="gradeX">
                                    <td class="center" align="center" colspan="13">Data not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a class="btn btn-info edit-button" type="button" href="{{route('dispatch.ambuja.pdf')}}" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate PDF </a> &nbsp;
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
          <h4 class="modal-title">Edit Report</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('dispatch.update') }}" data-parsley-validate>
                @csrf
                <input type="hidden" name="type" value="ambuja" />
                <input type="hidden" id="report-id" name="report_id" />
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Type<span style="color:red;">*</span></label>
                        <input class="form-control" value="AMBUJA CEMENTS LTD" readOnly />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Sd Name</label>
                        <select name="party_name" id="edit-party_name" class="form-control">
                            <option value="">Select Party name</option>
                            @foreach($builders as $builder)
                            <option data-party_code="{{$builder->party_code ?? 'N/A'}}" value="{{$builder->party_name ?? ''}}">{{$builder->party_name ?? 'N/A'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Sd Code</label>
                        <input name="party_code" id="edit-party_code" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">RD-RL-SH</label>
                        <input name="truck_no" id="edit-truck_no" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">City</label>
                        <input type="text" name="location" id="edit-location" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Reff Doc No</label>
                        <input type="text" name="ref_doc_no" id="edit-ref_doc_no" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">GRO Price</label>
                        <input type="text" name="invoice_amount" id="edit-invoice_amount" maxlength="10" title="Please enter valid amount." pattern="[0-9]+" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Delivery Date</label>
                        <input type="date" name="del_date" id="edit-del-date" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Quantity</label>
                        <input type="text" name="quantity" id="edit-quantity" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Invoice No</label>
                        <input name="invoice_no" id="edit-invoice_no" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">S Plan No</label>
                        <input type="text" name="s_plan_no" id="edit-s_plan_no" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Transport Name</label>
                        <input type="text" name="transport_name" id="edit-transport_name" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Order No</label>
                        <input type="text" name="order_no" id="edit-order_no" class="form-control" />
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
          <h4 class="modal-title">View Report</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Type<span style="color:red;">*</span></label>
                    <input class="form-control" value="AMBUJA CEMENTS LTD" readOnly />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Sd Code</label>
                    <input name="party_code" value="{{old('party_code')}}" id="view-party_code" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Sd Name</label>
                    <input name="party_name" value="{{old('party_name')}}" id="view-party_name" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">RD-RL-SH</label>
                    <input name="truck_no" value="{{old('truck_no')}}" id="view-truck_no" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">City</label>
                    <input type="text" name="location" id="view-location" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Reff Doc No</label>
                    <input type="text" name="ref_doc_no" id="view-ref_doc_no" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">GRO Price</label>
                    <input type="text" name="invoice_amount" id="view-invoice_amount" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Del Date</label>
                    <input type="date" name="del_date" id="view-del-date" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Quantity</label>
                    <input type="text" name="quantity" id="view-quantity" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Invoice No</label>
                    <input name="invoice_no" id="view-invoice_no" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">S Plan No</label>
                    <input type="text" name="s_plan_no" id="view-s_plan_no" class="form-control" />
                </div>
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Transport Name</label>
                    <input type="text" name="transport_name" id="view-transport_name" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="col-form-label">Order No</label>
                    <input type="text" name="order_no" id="view-order_no" class="form-control" />
                </div>
            </div>
            <div class="hr-line-dashed"></div>
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

        $('#party-name').change(function() {
            var partyCode = $(this).find(':selected').data('party_code');
            $('#party-code').val(partyCode);
        });

        $('#edit-party_name').change(function() {
            var partyCode = $(this).find(':selected').data('party_code');
            $('#edit-party_code').val(partyCode);
        });

        $('.edit-button').on('click', function(){
            var data = $(this).attr('data-reportDetail');
            dataObj = JSON.parse(data);
            $("#report-id").val(dataObj.id);
            $("#edit-party_code").val(dataObj.party_code);
            $("#edit-party_name").val(dataObj.party_name);
            $("#edit-ref_doc_no").val(dataObj.ref_doc_no);
            $("#edit-invoice_amount").val(dataObj.invoice_amount);
            $("#edit-del-date").val(dataObj.del_date);
            $("#edit-quantity").val(dataObj.quantity);
            $("#edit-invoice_no").val(dataObj.invoice_no);
            $("#edit-s_plan_no").val(dataObj.s_plan_no);
            $("#edit-transport_name").val(dataObj.transport_name);
            $('#edit-truck_no').val(dataObj.truck_no);
            $('#edit-order_no').val(dataObj.order_no);
            $('#edit-location').val(dataObj.location);
            $('#myModal').modal('show');
        });

        // To View Payment
        $('.view-button').on('click', function(){
            var data = $(this).attr('data-reportDetail');
            dataObj = JSON.parse(data);
            $('#view-date').val(dataObj.created_at);
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
            $('#view-invoice-reference').val(dataObj.invoice_reference);
            $('#view-order_no').val(dataObj.order_no);
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