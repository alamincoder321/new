@extends('layouts.app')
@section('job')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Job</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Add Job </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('job.index')}}" class="btn btn-info btn-sm pull-right">Job List</a>
                    <h3 class="panel-title">Add Job</h3>
                </div>
            <form action="{{route ('job.store')}}" method="POST">
                @csrf
                <div class="panel-body">
                    <div class="form-group ">
                        <label class="control-label col-lg-2">Job Name</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" class=" form-control" autocomplete="off">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-lg-2">Salary</label>
                        <div class="col-lg-10">
                            <input type="number" name="salary" class=" form-control" autocomplete="off">
                            @if ($errors->has('salary'))
                                <span class="text-danger">{{$errors->first('salary')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 pull-right">
                            <button class="btn btn-success waves-effect waves-light pull-right jobAdd" type="submit">Add Job</button>
                        </div>
                    </div>
                </div> <!-- panel-body -->
            </form>
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection