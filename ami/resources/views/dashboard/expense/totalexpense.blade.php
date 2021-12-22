@extends('layouts.app')
@section('dashboard')
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
                    <a href="{{route('dashboard')}}" class="btn btn-info btn-sm pull-right">Return back</a>
                    <h3 class="panel-title">Expense Details Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>short_desc</th>
                                        <th>Date</th>
                                        <th>Ammount</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($expenses as $key=>$expense)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$expense->short_desc}}</td>
                                        <td>{{$expense->date}}</td>
                                        <td>{{$expense->amount}}</td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
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
