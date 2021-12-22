@extends('layouts.app')
@section('supplier')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Supplier Edit</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Edit Supplier PayDue </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('supdue')}}" class="btn btn-info btn-sm pull-right">Supplier paydue List</a>
                    <h3 class="panel-title">Edit Supplier PayDue</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('supedit.update', $supedit->id)}}" novalidate="novalidate">
                            @csrf
                            <input type="hidden" name="supplier_id" value="{{$supedit->supplier_id}}">
                            <div class="form-group">
                                <label class="control-label col-lg-2">Pay Supplier Due</label>
                                <div class="col-lg-9">
                                    <input type="text" name="pay_due" class=" form-control" value="{{$supedit->pay_due}}">
                                    @if ($errors->has('pay_due'))
                                    <span class="text-danger">{{$errors->first('pay_due')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Pay Date</label>
                                <div class="col-lg-9">
                                    <input type="date" class="form-control" name="pay_date" value="{{$supedit->pay_date}}">
                                    @if ($errors->has('pay_date'))
                                    <span class="text-danger">{{$errors->first('pay_date')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Edit Supplier PayDue</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
