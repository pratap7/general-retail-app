@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Send Message</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/builders">Builders</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Send Message</strong>
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
                    <h5>Send Message Form</h5>
                    <!-- <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                        <a class="close-link">
                            <i class="fa fa-times"></i>
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
                    <form method="POST" action="{{ route('builder.send-message') }}" data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Title<span style="color:red;">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" id="title" maxlength="50" placeholder="Enter Title" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-12">
                                <label class=" col-form-label">Message</label>
                                <textarea name="message" placeholder="Enter Message" class="form-control" required>{{ old('message') }}</textarea> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Send Message" />
                                    <a href="/builders" class="btn btn-warning">Cancel </a>
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