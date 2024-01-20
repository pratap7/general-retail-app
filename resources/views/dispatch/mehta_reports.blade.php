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
                <strong>Mehta</strong>
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
                    <h5>Dispatch Mehta</h5>
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
                        <input type="hidden" name="type" value="mehta" />
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Type<span style="color:red;">*</span></label>
                                <input id="type" class="form-control" value="THE MEHTA GROUP" readOnly />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Quantity</label>
                                <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Brand</label>
                                <input name="brand" value="{{old('brand')}}" id="brand" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Price</label>
                                <input name="price" value="{{old('price')}}" id="price" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Company</label>
                                <input type="text" name="company" id="company"  value="{{old('company')}}" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Order No</label>
                                <input type="text" name="order_no" id="order_no" value="{{old('order_no')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Party Name</label>
                                <select name="party_name" id="party-name" class="form-control">
                                    <option value="">Select Party Name</option>
                                    @foreach($builders as $builder)
                                    <option data-party_code="{{$builder->party_code ?? 'N/A'}}" value="{{$builder->party_name ?? ''}}">{{$builder->party_name ?? 'N/A'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Truck No</label>
                                <input type="text" name="truck_no" value="{{old('truck_no')}}" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Location</label>
                                <input type="text" name="location" value="{{old('location')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Party Code</label>
                                <input type="text" name="party_code" value="{{old('party_code') ?? 'N/A'}}" id="party-code" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Invoice Amount</label>
                                <input type="text" name="invoice_amount" id="invoice_amount" value="{{old('invoice_amount')}}" class="form-control" maxlength="10" title="Please enter valid amount." pattern="[0-9]+" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Invoice No</label>
                                <input type="text" name="invoice_no" id="invoice_no" value="{{old('invoice_no')}}" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Transport Name</label>
                                <input type="text" name="transport_name" id="transport_name" value="{{old('transport_name')}}" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label">Tax Retail Invoice</label>
                                <input type="text" name="tax_retail_inv" id="tax_retail_inv" value="{{old('tax_retail_inv')}}" class="form-control" />
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
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Company</th>
                                    <th>Order No</th>
                                    <th>Party Code</th>
                                    <th>Party Name</th>
                                    <th>Invoice Amount</th>
                                    <th>Invoice No</th>
                                    <th>Transporter</th>
                                    <th>Tax Retail Invoice </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($all_reports as $report)
                                <tr class="gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$report->created_at->format('d/m/yy') ?? "N/A"}}</td>
                                    <td>{{$report->quantity ?? "N/A"}}</td>
                                    <td>{{$report->brand ?? "N/A"}}</td>
                                    <td>{{$report->price ?? 'N/A'}}</td>
                                    <td>{{$report->company ?? "N/A"}}</td>
                                    <td>{{$report->order_no ?? "N/A"}}</td>
                                    <td>{{$report->party_code ?? "N/A"}}</td>
                                    <td>{{$report->party_name ?? "N/A"}}</td>
                                    <td>{{$report->invoice_amount ?? "N/A"}}</td>
                                    <td>{{$report->invoice_no ?? "N/A"}}</td>
                                    <td>{{$report->transport_name ?? "N/A"}}</td>
                                    <td>{{$report->tax_retail_inv ?? "N/A"}}</td>
                                    <td class="center">
                                        <button class="btn btn-info btn-sm edit-button" type="button" href="javascript:void(0);" data-reportDetail="{{$report}}"><i class="fa fa-pencil"></i> Edit </button>
                                        <a href="{{route('dispatch.send-message',$report->id)}}" type="button" class="btn btn-success btn-sm send-sms"><i class="fa fa-message"></i> Send SMS</a>
                                        <form action="{{route('dispatch-delete', $report->id)}}" onsubmit="return confirm('Do you really want to delete this entry?');" method="post">
                                            @csrf
                                            <a href="javascript:{}" class="btn btn-white btn-sm" onclick="$(this).closest('form').submit();"><i style="color:red;" class="fa fa-trash"></i> Delete</a>
                                        </form> &nbsp;
                                       
                                    </td>
                                </tr>
                                @empty
                                <tr class="gradeX">
                                    <td class="center" align="center" colspan="13">Data not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a class="btn btn-info edit-button" type="button" href="{{route('dispatch.tmg.pdf')}}" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate PDF </a> &nbsp;
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
                <input type="hidden" name="type" value="mehta" />
                <input type="hidden" name="report_id" id="report-id" />
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Type<span style="color:red;">*</span></label>
                        <input id="type" class="form-control" value="THE MEHTA GROUP" readOnly />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Quantity</label>
                        <input type="text" name="quantity" id="edit-quantity" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Brand</label>
                        <input name="brand" id="edit-brand" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Price</label>
                        <input name="price" id="edit-price" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Company</label>
                        <input type="text" name="company" id="edit-company" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Order No</label>
                        <input type="text" name="order_no" id="edit-order_no" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Party Code</label>
                        <input type="text" name="party_code" id="edit-party_code" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Truck No</label>
                        <input type="text" name="truck_no" id="edit-truck_no" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Location</label>
                        <input type="text" name="location" id="edit-location" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Party Name</label>
                        <select name="party_name" id="edit-party_name" class="form-control">
                            @foreach($builders as $builder)
                            <option data-party_code="{{$builder->party_code ?? 'N/A'}}" value="{{$builder->party_name ?? ''}}">{{$builder->party_name ?? 'N/A'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Invoice Amount</label>
                        <input type="text" name="invoice_amount" maxlength="10" title="Please enter valid amount." pattern="[0-9]+" id="edit-invoice_amount" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Invoice No</label>
                        <input type="text" name="invoice_no" id="edit-invoice_no" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Transport Name</label>
                        <input type="text" name="transport_name" id="edit-transport_name" class="form-control" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="col-form-label">Tax Retail Invoice</label>
                        <input type="text" name="tax_retail_inv" id="edit-tax_retail_inv" class="form-control" />
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

@push('custom-scripts')
<script>
    $(document).ready(function(){

        // Change Builder name and code
        $('#party-name').on('change', function() {
            var partyCode = $(this).find(':selected').data('party_code');
            $('#party-code').val(partyCode);
        });
        $('#edit-party_name').on('change', function() {
            var partyCode = $(this).find(':selected').data('party_code');
            $('#edit-party_code').val(partyCode);
        });

        $('.edit-button').on('click', function(){
            var data = $(this).attr('data-reportDetail');
            dataObj = JSON.parse(data);
            $("#report-id").val(dataObj.id);
            $("#edit-quantity").val(dataObj.quantity);
            $("#edit-brand").val(dataObj.brand);
            $("#edit-price").val(dataObj.price);
            $("#edit-company").val(dataObj.company);
            $("#edit-order_no").val(dataObj.order_no);
            $("#edit-party_code").val(dataObj.party_code);
            $("#edit-truck_no").val(dataObj.truck_no);
            $("#edit-location").val(dataObj.location);
            $("#edit-party_name").val(dataObj.party_name);
            $("#edit-invoice_amount").val(dataObj.invoice_amount);
            $("#edit-invoice_no").val(dataObj.invoice_no);
            $("#edit-transport_name").val(dataObj.transport_name);
            $('#edit-tax_retail_inv').val(dataObj.tax_retail_inv);
            $('#myModal').modal('show');
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