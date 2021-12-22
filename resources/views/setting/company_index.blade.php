@extends('layouts.app')
@section('setting')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Company</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Company List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('company.create')}}" class="btn btn-info btn-sm pull-right">Add Company Details</a>
                    <h3 class="panel-title">Company list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company Logo</th>
                                        <th>Title</th>
                                        <th>Company Address</th>
                                        <th>Phone</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($companys as $key=>$company)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img src="{{asset($company->company_logo)}}" width="60">
                                        </td>
                                        <td>{{$company->title}}</td>
                                        <td>{{$company->address}}</td>
                                        <td>{{$company->phone}}</td>

                                         <td class="text-right">

                                          <a href="{{route ('company.edit', $company->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                          <a href="javascript:;" data-id="{{$company->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('company.destroy', $company->id)}}" id="delete{{$company->id}}" method="POST">
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
