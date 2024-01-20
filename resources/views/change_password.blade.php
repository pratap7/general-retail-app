@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Change Password</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Change Password</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Change Admin Password</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
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
                    <form method="POST" action="{{ route('change.password') }}" data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Current Password<span style="color:red;">*</span></label>
                                <input type="password" name="current_password" id="current_password" autocomplete="current-password" placeholder="Enter Current Password" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-12">
                                <label class=" col-form-label">New Password<span style="color:red;">*</span></label>
                                <input id="new_password" type="password" class="form-control" name="new_password" placeholder="New Password" required />
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-12">
                                <label class=" col-form-label">New Confirm Password<span style="color:red;">*</span></label>
                                <input id="new_confirm_password" type="password" placeholder="Confirm Password" class="form-control" name="new_confirm_password" data-parsley-equalto="#new_password" required />
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                                    <a href="/" class="btn btn-warning">Cancel </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection