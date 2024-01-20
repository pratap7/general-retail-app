@extends('layout.app')

@section('content')
<div class="wrapper wrapper-content">
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
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-success float-right">All</span>
                    </div>
                    <h5>Builders Added</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$buildersCount ?? 0}}</h1>
                    <a class="stat-percent font-bold text-info" href="/builders">View All</a>
                    <small>Total builders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-info float-right">All</span>
                    </div>
                    <h5>Orders</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$ordersCount ?? 0}}</h1>
                    <a class="stat-percent font-bold text-info" href="/orders">View All </a>
                    <small>Total orders</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-primary float-right">All Pending</span>
                    </div>
                    <h5>Pending Payments</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$pendingPayment ?? 0}}</h1>
                    <a href="/pending-payments" class="stat-percent font-bold text-info">View All</a>
                    <small>All Pending Payments</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <span class="label label-danger float-right">All Recieved</span>
                    </div>
                    <h5>Recieved Payments</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"> {{$recievedPayment ?? 0}}</h1>
                    <small>Total Recieved</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card bg-primary text-white shadow recent-card" id="recent-builders">
                <div class="card-body">
                    Recent Top 10 Builders<br>
                    <a class="text-white-50 small" href="/builders">View All</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card bg-success text-white shadow recent-card" id="recent-orders">
                <div class="card-body">
                    Recent Top 10 Order<br>
                    <a class="text-white-50 small" href="/orders">View All</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card bg-info text-white shadow recent-card" id="recent-reports">
                <div class="card-body">
                    Recent Dispatch Report<br>
                    <a class="text-white-50 small" href="/dispatch-ambuja">View All</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card bg-warning text-white shadow recent-card" id="recent-payments">
                <div class="card-body">
                    Recent Payment Collection<br>
                    <a class="text-white-50 small" href="/pending-payments">View All</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive" id="builder-list">
        <h5>Recent 10 Builders</h5>
        <table class="table table-striped table-bordered table-hover builder-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Party Name</th>
                    <th>Party Code</th>
                    <th>Owner Name</th>
                    <th>Email ID</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($builders as $builder)
                <tr class="gradeX">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$builder->party_name}}</td>
                    <td>{{$builder->party_code}}</td>
                    <td>{{$builder->owner_name}}</td>
                    <td>{{$builder->direct_customer_email}}</td>
                    <td class="center">{{$builder->created_at}}</td>
                    <td class="center">
                        <a class="btn btn-white btn-sm" href="{{ route('builders.edit',$builder->id)}}"><i class="fa fa-pencil"></i> Edit </a> &nbsp;
                        <a class="btn btn-white btn-sm" href="{{ route('builder.review',$builder->id)}}"><i class="fa fa-file-pdf-o"></i> Send Email </a> &nbsp;
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/builders" class="btn btn-info mb-2">More</a>
    </div>


    <div class="table-responsive" style="display:none;" id="order-list">
        <h5>Recent 10 Orders</h5>
        <table class="table table-striped table-bordered table-hover order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Builder</th>
                    <th>Party Code</th>
                    <th>Plant</th>
                    <th>Quantity</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="gradeX">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->Builder->party_name ?? "N/A"}}</td>
                    <td>{{$order->Builder->party_code ?? "N/A"}}</td>
                    <td>{{$order->Plant->plant_name ?? "N/A"}}</td>
                    <td>{{$order->quantity_type_kg ?? 0 }} MT</td>
                    <td class="center">{{$order->created_at ?? "N/A"}}</td>
                    <td class="center">
                        <a class="btn btn-white btn-sm" href="{{ route('orders.edit',$order->id)}}"><i class="fa fa-pencil"></i> Edit </a> &nbsp;
                        <a class="btn btn-white btn-sm" href="{{ route('order.review',$order->id)}}"><i class="fa fa-file-pdf-o"></i> Send Email </a> &nbsp;
                        <a class="btn btn-white btn-sm" href="{{ route('payment.detail',$order->id)}}"><i class="fa fa-money"></i> Payments</a>&nbsp;
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/orders" class="btn btn-info mb-2">More</a>
    </div>


    <div class="table-responsive" style="display:none;" id="report-list">
        <h5>Recent 10 Dispatch Reports</h5>
        <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Party Code</th>
                    <th>Party Name</th>
                    <th>Date</th>
                    <th>Quanity</th>
                    <th>Invoice No</th>
                    <th>Order No</th>
                    <th>Transport Name</th>
                </tr>
            </thead>
            <tbody>
            @forelse($reports as $report)
                <tr class="gradeX">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$report->party_code ?? "N/A"}}</td>
                    <td>{{$report->party_name ?? "N/A"}}</td>
                    <td>{{$report->del_date ?? "N/A"}}</td>
                    <td>{{$report->quantity ?? "N/A"}}</td>
                    <td>{{$report->invoice_no ?? "N/A"}}</td>
                    <td>{{$report->order_no ?? "N/A"}}</td>
                    <td>{{$report->transport_name ?? "N/A"}}</td>
                </tr>
                @empty
                <tr class="gradeX">
                    <td class="center" align="center" colspan="13">Data not found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a class="btn btn-info mb-2" href="/dispatch-ambuja"> More </a>
    </div>

    <div class="table-responsive" style="display:none;" id="payment-list">
        <h5>Recent 10 Payments</h5>
        <table class="table table-striped table-bordered table-hover dataTables-example" id="payment-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order No</th>
                    <th>Party Code</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Is Utilized</th>
                    <th>Created</th>
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
                    <td>{{($payment->utilize == 1) ? 'YES' : "NO"}}</td>
                    <td class="center">{{$payment->created_at->format('d/m/yy')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-info mb-2" href="/utilized-payments"> More </a>
    </div>
</div>

@push('custom-scripts')
<script>
$(document).ready(function(){
    $('.recent-card').hover(function(){
        $('#order-list').hide();
        $('#builder-list').hide();
        $('#report-list').hide();
        $('#payment-list').hide();
        if($(this).attr('id') == "recent-builders"){
            $('#builder-list').show();
        } else if($(this).attr('id') == "recent-orders"){
            $('#order-list').show();
        } else if($(this).attr('id') == "recent-reports"){
            $('#report-list').show();
        } else if($(this).attr('id') == "recent-payments"){
            $('#payment-list').show();
        } else {
            $('#builder-list').show();
        }
    });
});           
</script>
@endpush
@endsection