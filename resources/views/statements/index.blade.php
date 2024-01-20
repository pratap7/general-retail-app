@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Statement Reports</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Statement</a>
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
                    <h5>Statement Reports</h5>
                </div>
                <div class="ibox-content">
                    <form method="get" id="filter-form" action="">
                        <div class="card bg-light text-dark">
                            <div class="card-header">
                                <h5>Builder Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Choose Builder<span style="color:red;">*</span></label>
                                        <select name="builder" id="builder-id" class="form-control builder-id" required>
                                            <option value="" selected>Select Builder</option>
                                            @foreach($builders as $builder)
                                            @php
                                            $selected = "";
                                            If($builder->id == request()->get('builder')){
                                                $selected = "selected";
                                                $party_code = $builder->party_code;
                                                $builderData = $builder;
                                                $brand = request()->get('brand');
                                            }
                                            @endphp
                                                <option {{$selected}} value="{{$builder->id}}" data-contact="{{$builder->owner_mobile}}" data-name="{{$builder->owner_name}}" data-builder="{{$builder}}" data-party_code="{{$builder->party_code}}">{{$builder->party_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">Party Code</label>
                                        <input type="text" id="party-code" value="{{$party_code ?? ''}}" class="form-control" readOnly>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">
                                            Cement Brand
                                        </label><br>
                                        <div class="form-check abc-radio abc-radio-info form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio1" value="ambuja" name="brand" {{(request()->get('brand') != 'mehta' ) ? "checked" : "" }} required />
                                            <label class="form-check-label" for="inlineRadio1"> Ambuja Group </label>
                                        </div>
                                        <div class="form-check abc-radio abc-radio-info form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio2" value="mehta" name="brand" {{(request()->get('brand') == 'mehta') ? "checked" : "" }} /> 
                                            <label class="form-check-label" for="inlineRadio2"> Mehta Group </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                            <div class="pull-right mt-4">
                                                <button type="submit" class="btn btn-success">Get Data</button>
                                                @if(isset($payments) && !empty($payments))
                                                    <a type="button" data-date_filter="" href="statements-pdf/{{$builderData->id}}/{{$brand}}" class="btn btn-info" id="generate-pdf">Generate PDF</a>
                                                @endif
                                                <a href="/orders" class="btn btn-warning">Cancel </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="hr-line-dashed"></div>
                    </form>

                    <div class="table-responsive">
                        <div class="form-group col-md-6 input-daterange" id="data_5">
                            <label class="font-normal">Date Filter</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" name="from_date" id="from_date" class="form-control-sm form-control" placeholder="From Date" readonly />
                                &nbsp;&nbsp; 
                                <input type="text" name="to_date" id="to_date" class="form-control-sm form-control" placeholder="To Date" readonly />
                                &nbsp;&nbsp;
                                <button type="button" name="filter" id="date-filter" class="btn btn-primary">Filter</button>&nbsp;
                                <button type="button" onclick="document.getElementById('filter-form').submit();" name="refresh" class="btn btn-secondary">Clear</button>
                            </div>
                        </div>
                        @php 
                            $debitTotal = $creditTotal = $balance = 0;$index = 0;
                        @endphp
                        @if(request()->has('brand'))
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="payment-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DOC No</th>
                                    <th>DOC Date</th>
                                    <th>Invoice No</th>
                                    @if(request()->get('brand') == "ambuja")
                                    <th>Destination</th>
                                    <th>Material</th>          
                                    <th>Quantity(MT)</th>
                                    <th>Debit (INR)</th>
                                    <th>Credit (INR)</th>
                                    @else 
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>Quantity</th>
                                    <th>Particulars</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                @php
                                    if($payment->utilize == 0 && $payment->dispatch_id == 0){
                                        continue;
                                    }
                                    $entryType = "CR";
                                    $doc_date = $payment->created_at->format('yy-m-d');
                                    $invoice_no = $payment->invoice_reference;
                                    $debit = $credit = 0;
                                    $location = $payment->Order->site_address;
                                    $quantity = $payment->Order->quantity_type_kg;
                                    if($payment->dispatch_id != 0){
                                        $debit = $payment->dispatch->invoice_amount ?? 0;
                                        $doc_date = $payment->dispatch->del_date ?? 'N/A';
                                        $invoice_no = $payment->dispatch->invoice_no;
                                        $location = $payment->dispatch->location;
                                        $quantity = $payment->dispatch->quantity;
                                        $entryType = "DR";
                                    }
                                    
                                    if($payment->utilize == 1 && $payment->dispatch_id == 0){
                                        $credit = $payment->amount;
                                    }
                                    $debitTotal += $debit;
                                    $creditTotal += $credit;

                                    $particulars = "N/A";
                                    if($payment->payment_mode != 1){
                                        if($payment->payment_mode == 2){
                                            $particulars = $payment->cheque_rtgs_no . "/". $payment->bank_name;
                                        } else {
                                            $particulars = "CH " . $payment->cheque_rtgs_no . "/". $payment->bank_name;
                                        }
                                    }

                                    //Calculate Balance
                                    if($debitTotal > $creditTotal){
                                        $balance = $debitTotal - $creditTotal . " DR";
                                    } else {
                                        $balance =  $creditTotal - $debitTotal . " CR";
                                    }
                                    $index++;
                                @endphp
                                <tr class="gradeX">
                                    <td>{{$index}}</td>
                                    <td>{{$payment->Order->order_no ?? "N/A"}}</td>
                                    <td>{{$doc_date}}</td>
                                    <td>{{$invoice_no ?? "N/A"}}</td>
                                    @if(request()->get('brand') == "ambuja")
                                    <td>{{$location ?? "N/A"}}</td>
                                    <td>{{config('global.cementType')[$payment->Order->cement_type]}}</td>
                                    <td>{{$quantity ?? 0}} MT</td>
                                    <td>{{$debit ?? 0}}</td>
                                    <td>{{$credit ?? 0}}</td>
                                    @else
                                    <td>{{$debit ?? 0}}</td>
                                    <td>{{$credit ?? 0}}</td>
                                    <td>{{$balance }}</td>
                                    <td>{{$quantity ?? 0}} MT</td>
                                    <td>{{$particulars ?? "N/A"}}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @if(request()->get('brand') == "ambuja")
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th style="text-align:center;">Total</th>
                                    <th>{{$debitTotal}}</th>
                                    <th>{{$creditTotal}}</th>
                                </tr>
                                @else 
                                <tr>
                                    <th>&nbsp;</th> 
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th style="text-align:center;">Total</th>
                                    <th>{{$debitTotal}}</th>
                                    <th>{{$creditTotal}}</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @endif
                                </tfoot>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#builder-id').change(function() {
        var partyCode = $('select#builder-id').find(':selected').data('party_code');
        $('#party-code').val(partyCode);
        var data = $(this).attr('data-builder');
        dataObj = JSON.parse(data);
        $('#customer-mobile').html(dataObj.owner_mobile);
    });
});    

// Datatables script [Only for listing pages]
$(document).ready(function(){
    $('#payment-table').DataTable({
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

    // Date Filter
    // Datatable Settings
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#from_date').datepicker('getDate');
            var max = $('#to_date').datepicker('getDate');
            max.setHours(23, 0, 0);
            var startDate = new Date(data[2]);
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
        var min_date = $('#from_date').val();
        var max_date = $('#to_date').val();
        if(min_date > max_date){
            $('#from_date').val('');
            $('#to_date').val('');
            alert('End date must be  greater than start date.');
            return false;
        }
        if(min_date != "" && max_date != ""){
            var date_filter = btoa(min_date + "-" + max_date);
            $('#generate-pdf').data("date_filter", date_filter);
        }
        table.draw();
    });


    // Generate PDF Link
    $('#generate-pdf').on('click',function(e){
        e.preventDefault();
        var date_filter = $(this).data('date_filter');
        if(date_filter != ""){
            var _href = $(this).attr("href"); 
            $(this).attr("href", _href + '?date_filter='+date_filter);
        }
        window.location.href = $(this).attr('href');
    });
});      
</script>
@endpush
@endsection