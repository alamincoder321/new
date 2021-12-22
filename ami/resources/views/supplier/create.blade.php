@extends('layouts.app')
@section('supplier')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Supplier</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Add Supplier </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('supplier.index')}}" class="btn btn-info btn-sm pull-right">Supplier List</a>
                    <h3 class="panel-title">Add Supplier</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('supplier.store')}}" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-lg-2">Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class=" form-control" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Address</label>
                                <div class="col-lg-9">
                                    <textarea name="address" class="form-control">{{old('address')}}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="text-danger">{{$errors->first('address')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Contact One</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone1" class=" form-control" value="{{old('phone1')}}">
                                    @if ($errors->has('phone1'))
                                    <span class="text-danger">{{$errors->first('phone1')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Contact Two</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone2" class=" form-control" value="{{old('phone2')}}">
                                    @if ($errors->has('phone2'))
                                    <span class="text-danger">{{$errors->first('phone2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add Supplier</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
