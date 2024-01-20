@extends('layout.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Orders List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/orders">Order</a>
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
                    <h5>All Orders</h5> | <a href="/orders/create" class="badge badge-success">+ New Order</a>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div> -->
                </div>
                <div class="ibox-content">

                <div class="col-sm-12">
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
                </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Builder</th>
                                    <th>Party Code</th>
                                    <th>Plant</th>
                                    <th>Quantity</th>
                                    <th>Order No</th>
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
                                    <td>{{$order->order_no ?? 'N/A'}}</td>
                                    <td class="center">{{$order->created_at->format('d/m/yy') ?? "N/A"}}</td>
                                    <td class="center">
                                        <a class="btn btn-white btn-sm" href="{{ route('orders.edit',$order->id)}}"><i class="fa fa-pencil"></i> Edit </a> &nbsp;
                                        <a class="btn btn-white btn-sm" href="{{ route('order.review',$order->id)}}"><i class="fa fa-file-pdf-o"></i> Send Email </a> &nbsp;
                                        <a class="btn btn-white btn-sm" href="{{ route('payment.detail',$order->id)}}"><i class="fa fa-money"></i> Payments</a>&nbsp;
                                        <form action="{{ route('orders.destroy', $order->id)}}" onsubmit="return confirm('Do you really want to delete this entry?');" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:{}" class="btn btn-white btn-sm" onclick="$(this).closest('form').submit();"><i style="color:red;" class="fa fa-trash"></i> Delete</a>
                                        </form>
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
    });           
</script>
@endpush
@endsection