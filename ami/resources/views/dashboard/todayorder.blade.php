@extends('layouts.app')
@section('dashboard')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Order</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Order List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('dashboard')}}" class="btn btn-info btn-sm pull-right">Return back</a>
                    <h3 class="panel-title">Order Details Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>                                     
                                        <th>Invoice_no</th>
                                        <th>Order_date</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Due</th>
                                        <th>Discount</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($todays as $key=>$order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->customer->name}}</td>
                                        <td>{{$order->invoice_no}}</td>
                                        <td>{{$order->pay_date}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{$order->pay_amount}}</td>
                                        <td>{{$order->due}}</td>
                                        <td>
                                        @if($order->discount === NULL)
                                            NULL
                                        @else
                                            {{$order->discount}}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{route ('final.invoice', $order->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
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
