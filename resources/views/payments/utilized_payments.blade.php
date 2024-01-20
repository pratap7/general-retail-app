@extends('layout.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Payments List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/payments">Payments</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Utilized Payments</h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div> -->
                </div>
                <div class="ibox-content">

                <div class="col-sm-12">
                    @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}  
                    </div>
                    @endif
                </div>

                    <div class="table-responsive">
                        <div class="form-group col-md-6 input-daterange" id="data_5">
                            <label class="font-normal">Date Filter</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" name="from_date" id="from_date" class="form-control-sm form-control" placeholder="From Date" readonly />
                                &nbsp;&nbsp; 
                                <input type="text" name="to_date" id="to_date" class="form-control-sm form-control" placeholder="To Date" readonly />
                                &nbsp;&nbsp;
                                <button type="button" name="filter" id="date-filter" class="btn btn-primary">Filter</button>&nbsp;
                                <a href="/utilized-payments" name="refresh" class="btn btn-secondary">Clear</a>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="payment-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order No</th>
                                    <th>Party Code</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr class="gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$payment->Order->order_no ?? "N/A"}}</td>
                                    <td>{{$payment->Builder->party_code ?? "N/A"}}</td>
                                    <td>{{config('global.paymentMode')[$payment->payment_mode]}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td class="center">{{$payment->created_at->format('yy/m/d')}}</td>
                                    <td class="center">
                                        <button class="btn btn-success btn-sm view-button" type="button" href="javascript:void(0);" data-paymentDetail="{{$payment}}"><i class="fa fa-eye"></i> View </button> &nbsp;
                                        <!-- <form action="{{ route('payments.destroy', $payment->id)}}" onsubmit="return confirm('Do you really want to delete this entry?');" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:{}" class="btn btn-white btn-sm" onclick="$(this).closest('form').submit();"><i style="color:red;" class="fa fa-trash"></i> Delete</a>
                                        </form> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    <h5>Order Detail</h5> <span class="badge badge-info" id="payment-order"></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Code</label>
                            <input name="party_name" id="party-code" type="text" class="form-control" readOnly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Name</label>
                            <input id="party-name" type="text" class="form-control" readOnly>
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
    // Datatables script [Only for listing pages]
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

        // View Payment
        $('.view-button').on('click', function(){
            var data = $(this).attr('data-paymentDetail');
            dataObj = JSON.parse(data);
            $('#view-payment-mode').val(dataObj.payment_mode);
            if(dataObj.payment_mode == 1){
                document.getElementById('view-by-cash').style.display = "block";
                document.getElementById('view-by-cheque').style.display = "none";
            } else {
                document.getElementById('view-by-cash').style.display = "none";
                document.getElementById('view-by-cheque').style.display = "block";
            }
            $('#payment-order').html(dataObj.order.order_no);
            $('#party-code').val(dataObj.builder.party_code);
            $('#party-name').val(dataObj.builder.party_name);
            $('#total-amount').val(dataObj.order.total_amount);
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
            $('#view-invoice-reference').val(dataObj.invoice_reference)
            $('#viewModal').modal('show');
        });

        // Datatable Settings
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $('#from_date').datepicker('getDate');
                var max = $('#to_date').datepicker('getDate');
                var startDate = new Date(data[5]);
                if (min == null && max == null) return true;
                if (min == null && startDate <= max) return true;
                if (max == null && startDate >= min) return true;
                if (startDate <= max && startDate >= min) return true;
                return false;
            }
        );

        $('#from_date').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $('#to_date').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        var table = $('#payment-table').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#date-filter').on('click', function(){
            if(min_date > max_date){
                $('#from_date').val('');
                $('#to_date').val('');
                alert('End date must be  greater than start date.');
                return false;
            }
            table.draw();
        });
    });           
</script>
@endpush
@endsection