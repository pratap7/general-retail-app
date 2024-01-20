@extends('layout.app')

@section('content')
<style>
    label.col-form-label {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Template Form</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/email-templates">Email Templates</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Edit Template Form</h5>
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
                    <form method="POST" action="{{ route('email-templates.update', $template->id) }}" data-parsley-validate>
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="col-form-label">Email Subject<span style="color:red;">*</span></label>
                                <input type="text" name="subject" value="{{ $template->subject }}" id="subject" maxlength="100" placeholder="Enter Subject here" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-sm-12">
                                <label class=" col-form-label">Email Content<span style="color:red;">*</span></label>
                                <textarea name="content" placeholder="Enter Content here" class="form-control" rows="5" required>{{ $template->content }}</textarea> 
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                                    <a href="/email-templates" class="btn btn-warning">Cancel </a>
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