@extends('layouts.app')
@section('setting')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Setting</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Add Setting </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('setting.index')}}" class="btn btn-info btn-sm pull-right">Setting List</a>
                    <h3 class="panel-title">Add Setting</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('setting.store')}}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-lg-2">Software Title</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class=" form-control" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Admin Image</label>
                                <div class="col-lg-9">
                                    <input type="file" name="admin" class=" form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Logo Image</label>
                                <div class="col-lg-9">
                                    <input type="file" name="logo" class=" form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add Setting</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
