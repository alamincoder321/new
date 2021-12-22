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
                <li class="active"> Expense List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('expense.create')}}" class="btn btn-info btn-sm pull-right">Add Expense</a>
                    <h3 class="panel-title">Expense list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($expenses as $key=>$expense)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$expense->date}}</td>
                                        <td>{{$expense->short_desc}}</td>
                                        <td>{{$expense->amount}}</td>
                                        <td class="text-right">

                                            <a href="{{route ('expense.edit', $expense->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                            <a href="javascript:;" data-id="{{$expense->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('expense.destroy', $expense->id)}}" id="delete{{$expense->id}}" method="POST">
                                              @csrf
                                              @method('DELETE')                    
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- End Row -->

@endsection
