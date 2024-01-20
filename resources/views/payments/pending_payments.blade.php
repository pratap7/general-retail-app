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
                    <h5>Pending Payments</h5>
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
                                <a href="/pending-payments" name="refresh" class="btn btn-secondary">Clear</a>
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
                                        <button class="btn btn-info btn-sm edit-button" type="button" href="javascript:void(0);" data-paymentDetail="{{$payment}}"><i class="fa fa-pencil"></i> Edit </button> &nbsp;
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
            <input type="hidden" id="builder-id" name="builder_id" value="" required />
            <input type="hidden" id="order-id" name="order_id" value="" required />
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h5>Order Detail</h5> <span class="badge badge-info" id="order-no"></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Code</label>
                            <input name="party_code" value="" type="text" id="party-code" class="form-control" readOnly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Party Name</label>
                            <input name="party_name" type="text" id="party-name" class="form-control" readOnly>
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
            dataObj = JSON.parse(data);
            $('#edit-payment-mode').val(dataObj.payment_mode);
            if(dataObj.payment_mode == 1){
                document.getElementById('edit-by-cash').style.display = "block";
                document.getElementById('edit-by-cheque').style.display = "none";
            } else {
                document.getElementById('edit-by-cash').style.display = "none";
                document.getElementById('edit-by-cheque').style.display = "block";
            }

            $('#party-code').val(dataObj.builder.party_code);
            $('#party-name').val(dataObj.builder.party_name);
            $('#payment-id').val(dataObj.id);
            $('#order-id').val(dataObj.order.id);
            $('#builder-id').val(dataObj.builder.id);
            $('#order-no').html(dataObj.order.order_no);
            $('#total-amount').val(dataObj.order.total_amount);
            $('#edit-date').val(dataObj.created_at);
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