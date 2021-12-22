@extends('layouts.app')
@section('expense')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Expense</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Update Expense </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('expense.index')}}" class="btn btn-info btn-sm pull-right">Expense List</a>
                    <h3 class="panel-title">Update Expense</h3>
                </div>
            <form action="{{route ('expense.update', $expense->id)}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="month" value="{{date('m.Y')}}">
                <input type="hidden" name="check" value="{{date('d.m.Y')}}">
                <div class="panel-body">
                    <div class="form-group ">
                        <label class="control-label col-lg-2">Short Description</label>
                        <div class="col-lg-10">
                            <textarea name="short_desc" class="form-control" rows="6">{{$expense->short_desc}}</textarea>
                            @if ($errors->has('short_desc'))
                                <span class="text-danger">{{$errors->first('short_desc')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-lg-2">Amount</label>
                        <div class="col-lg-10">
                            <input type="number" name="amount" class=" form-control" value="{{$expense->amount}}">
                            @if ($errors->has('amount'))
                                <span class="text-danger">{{$errors->first('amount')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-lg-2">Date</label>
                        <div class="col-lg-10">
                            <input type="date" name="date" class=" form-control" value="{{$expense->date}}">
                            @if ($errors->has('date'))
                                <span class="text-danger">{{$errors->first('date')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 pull-right">
                            <button class="btn btn-success waves-effect waves-light pull-right expenseAdd" type="submit">Update Expense</button>
                        </div>
                    </div>
                </div> <!-- panel-body -->
            </form>
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection