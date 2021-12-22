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
                <li class="active"> Add Employee </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('employee.index')}}" class="btn btn-info btn-sm pull-right">Employee List</a>
                    <h3 class="panel-title">Add Employee</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{route('employee.update', $employee->id)}}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-lg-2">Full Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class=" form-control" value="{{$employee->name}}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">E-Mail</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{$employee->email}}">
                                     @if ($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Phone Number</label>
                                <div class="col-lg-9">
                                    <input type="text" name="phone" class="form-control" value="{{$employee->phone}}">
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">City</label>
                                <div class="col-lg-9">
                                    <input type="text" name="city_name" class="form-control" value="{{$employee->city_name}}">
                                    @if ($errors->has('city_name'))
                                    <span class="text-danger">{{$errors->first('city_name')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Upozila</label>
                                <div class="col-lg-9">
                                    <input type="text" name="upozila" class="form-control" value="{{$employee->upozila}}">
                                    @if ($errors->has('upozila'))
                                    <span class="text-danger">{{$errors->first('upozila')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Job Title</label>
                                <div class="col-lg-9">
                                    <select name="job_id" class="form-control">
                                        <option label="Select Job Title"></option>
                                        @foreach ($jobs as $job)
                                            <option value="{{$job->id}}" {{$employee->job_id===$job->id ? "selected":""}}>{{$job->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('job_id'))
                                    <span class="text-danger">{{$errors->first('job_id')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Join Date</label>
                                <div class="col-lg-9">
                                    <input type="date" name="join_date" class="form-control" value="{{$employee->join_date}}">
                                    @if ($errors->has('join_date'))
                                    <span class="text-danger">{{$errors->first('join_date')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Employee Image</label>
                                <div class="col-lg-9">
                                    <img src="{{asset($employee->image)}}" alt="" width="80" heigth="80">
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="old" value="{{$employee->image}}">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Add Employee</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
