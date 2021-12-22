@extends('layouts.app')
@section('customer')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Customer</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Customer List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('customer.create')}}" class="btn btn-info btn-sm pull-right">Add customer</a>
                    <h3 class="panel-title">Customer list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FullName</th>                                     
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Upozila</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($customers as $key=>$customer)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->phone}}</td>
                                        
                                        <td>{{$customer->city_name}}</td>
                                        <td>{{$customer->upozila}}</td>
                                        <td class="text-right">
                                        @if($customer->status == 1)
                                            <a href="{{route ('customer.inactive', $customer->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('customer.active', $customer->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif
                                          <a href="{{route ('customer.edit', $customer->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
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
