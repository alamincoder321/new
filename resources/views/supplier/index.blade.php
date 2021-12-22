@extends('layouts.app')
@section('supplier')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">supplier</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Supplier List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('supplier.create')}}" class="btn btn-info btn-sm pull-right">Add Supplier</a>
                    <h3 class="panel-title">Supplier list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FullName</th>                                     
                                        <th>Address</th>
                                        <th>Contact One</th>
                                        <th>Contact two</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($suppliers as $key=>$supplier)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$supplier->name}}</td>
                                        <td>{{$supplier->address}}</td>
                                        <td>{{$supplier->phone1}}</td>
                                        <td>{{$supplier->phone2}}</td>
                                        <td class="text-right">
                                        @if($supplier->status == 1)
                                            <a href="{{route ('supplier.inactive', $supplier->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('supplier.active', $supplier->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif
                                          <a href="{{route ('supplier.edit', $supplier->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
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
