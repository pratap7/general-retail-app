@extends('layout.app')

@section('content')
<style>
    th.col-form-th {
        font-weight: bold;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Display Template Details</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/email-templates">Email Template</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Template Details</h5> &nbsp;&nbsp;&nbsp;&nbsp;<a href="/email-templates" class="btn btn-success"> Templates List </a>
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
                    <table>
                        <tr>
                            <th>Subject</th>
                            <td>{{$template->subject}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$template->slug}}"</td> 
                        </tr>
                        <tr>
                            <th>Content</th>
                            <td>{{$template->content}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection