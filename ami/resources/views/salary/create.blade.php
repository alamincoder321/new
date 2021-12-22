@extends('layouts.app')
@section('salary')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Salary</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Add Salary </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('salary.index')}}" class="btn btn-info btn-sm pull-right">Salary List</a>
                    <h3 class="panel-title">Add Salary</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('salary.store')}}" novalidate="novalidate">
                            @csrf
                            <input type="hidden" name="month" value="{{date('m.Y')}}">
                            <input type="hidden" name="check" value="{{date('d.m.Y')}}">
                            <div class="form-group">
                                <label class="control-label col-lg-2">Employe Name</label>
                                <div class="col-lg-9">
                                    <select name="employee_id" class="form-control">
                                        <option label="Select Employee Name"></option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('employee_id'))
                                    <span class="text-danger">{{$errors->first('employee_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Advance Salary</label>
                                <div class="col-lg-9">
                                    <input type="number" name="advance_pay" class="form-control" autocomplete="off">
                                    @if ($errors->has('advance_pay'))
                                    <span class="text-danger">{{$errors->first('advance_pay')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Advance Date</label>
                                <div class="col-lg-9">
                                    <input type="date" name="pay_date" class="form-control" autocomplete="off">
                                    @if ($errors->has('pay_date'))
                                    <span class="text-danger">{{$errors->first('pay_date')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add salary</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
