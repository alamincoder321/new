@extends('layouts.app')
@section('setting')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Company Details</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Add Company Details </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('company.index')}}" class="btn btn-info btn-sm pull-right">Company List</a>
                    <h3 class="panel-title">Add Company Details</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('company.store')}}" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-lg-2">Company Title</label>
                                <div class="col-lg-9">
                                    <input type="text" name="title" class=" form-control" value="{{old('title')}}">
                                    @if ($errors->has('title'))
                                    <span class="text-danger">{{$errors->first('title')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Company Address</label>
                                <div class="col-lg-9">
                                    <textarea name="address" class="form-control">{{old('address')}}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="text-danger">{{$errors->first('address')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Company Phone Number</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Company Logo</label>
                                <div class="col-lg-9">
                                    <input type="file" name="company_logo" class="form-control" value="{{old('company_logo')}}">
                                    @if ($errors->has('company_logo'))
                                    <span class="text-danger">{{$errors->first('company_logo')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add Company details</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
