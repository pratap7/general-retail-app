@extends('layout.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Builders List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/builders">Builder</a>
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
                    <h5>All Builders</h5> | <a href="/builders/create" class="badge badge-success">+ New Builder</a>
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
                                        <form action="{{ route('builders.destroy', $builder->id)}}" onsubmit="return confirm('Do you really want to delete this entry?');" method="post">
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