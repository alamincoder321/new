@extends('layouts.app')
@section('employee')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Employee</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Employee List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('employee.create')}}" class="btn btn-info btn-sm pull-right">Add Employee</a>
                    <h3 class="panel-title">Employee list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>FullName</th>
                                        <th>JobTitle</th>                                      
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Upozila</th>
                                        <th>JoinDate</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($employees as $key=>$employee)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img src="{{asset($employee->image)}}" width="60" height="60">
                                        </td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->job->title}}</td>
                                        <td>{{$employee->phone}}</td>
                                        <td>{{$employee->city_name}}</td>
                                        <td>{{$employee->upozila}}</td>
                                        <td>{{$employee->join_date}}</td>
                                        <td class="text-right">
                                          @if($employee->status == 1)
                                            <a href="{{route ('employee.inactive', $employee->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('employee.active', $employee->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif

                                          <a href="{{route ('employee.edit', $employee->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                          <a href="javascript:;" data-id="{{$employee->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('employee.destroy', $employee->id)}}" id="delete{{$employee->id}}" method="POST">
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
