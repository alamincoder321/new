@extends('layouts.app')
@section('product')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Product</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{ route('dashboard') }}"> Dashboard </a></li>
                <li class="active"> Update Product </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('product.index') }}" class="btn btn-info btn-sm pull-right">product List</a>
                    <h3 class="panel-title">Update Product</h3>
                </div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="POST" action="{{ route('product.update', $product->id) }}"
                            enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-lg-2">Product Name</label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class=" form-control" value="{{ $product->name }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Buying Cost</label>
                                <div class="col-lg-9">
                                    <input type="number" name="buy_cost" class="form-control"
                                        value="{{ $product->buy_cost }}">
                                    @if ($errors->has('buy_cost'))
                                        <span class="text-danger">{{ $errors->first('buy_cost') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Selling Cost</label>
                                <div class="col-lg-9">
                                    <input type="number" name="unit_cost" class="form-control"
                                        value="{{ $product->unit_cost }}">
                                    @if ($errors->has('unit_cost'))
                                        <span class="text-danger">{{ $errors->first('unit_cost') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Quantity</label>
                                <div class="col-lg-9">
                                    <input type="number" name="weight" class="form-control"
                                        value="{{ $product->weight }}">
                                    @if ($errors->has('weight'))
                                        <span class="text-danger">{{ $errors->first('weight') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Category Name</label>
                                <div class="col-lg-9">
                                    <select name="category_id" class="form-control">
                                        <option label="Select category Name"></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Supplier Name</label>
                                <div class="col-lg-9">
                                    <select name="supplier_id" class="form-control">
                                        <option label="Select supplier Name"></option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('supplier_id'))
                                        <span class="text-danger">{{ $errors->first('supplier_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update
                                        Product</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@endsection
