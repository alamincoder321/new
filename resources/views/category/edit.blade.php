@extends('layouts.app')
@section('category')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Category</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Update Category </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('category.index')}}" class="btn btn-info btn-sm pull-right">Category List</a>
                    <h3 class="panel-title">Update Category</h3>
                </div>
            <form action="{{route ('category.update', $category->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="panel-body">
                    <div class=" form">
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Category Name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class=" form-control" value="{{$category->name}}">
                                 @if ($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success waves-effect waves-light pull-right categoryAdd" type="submit">Update Category</button>
                                </div>
                            </div>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </form>
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection

