@extends('layouts.app')
@section('chalan')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Chalan</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Chalan List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Chalan Details Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Chalan_date</th>
                                        <th>Total</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($chalans as $key=>$chalan)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$chalan->chalan_date}}</td>
                                        <td>{{$chalan->total}}</td>
                                        <td class="text-right">
                                            <a href="{{route('chalan.invoice', $chalan->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:;" data-id="{{$chalan->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('chalan.destroy', $chalan->id)}}" id="delete{{$chalan->id}}" method="POST">
                                              @csrf
                                              @method('HEAD')                   
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
