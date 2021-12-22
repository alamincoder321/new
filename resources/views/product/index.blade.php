@extends('layouts.app')
@section('product')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">product</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> product List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route ('product.create')}}" class="btn btn-info btn-sm pull-right">Add product</a>
                    <h3 class="panel-title">product list Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Buying Cost</th>
                                        <th>Selling Cost</th>
                                        <th>Total qty</th>
                                        <th>Available Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $key=>$product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="text-center">{{$product->name}}</td>
                                        <td class="text-center">{{$product->category->name}}</td>
                                        <td class="text-center">{{$product->buy_cost}}</td>
                                        <td class="text-center">{{$product->unit_cost}}</td>
                                        <td class="text-center">{{$product->tweight}}</td>
                                        <td class="text-center"><span class="btn btn-success btn-sm">{{$product->weight}} </span> </td>
                                        <td class="text-center">{{$product->weight*$product->buy_cost}}</td>

                                         <td class="text-right">
                                          @if($product->status == 1)
                                            <a href="{{route ('product.inactive', $product->id)}}" class="btn btn-success btn-sm"><i class="ion-checkmark"></i></a>
                                          @else
                                            <a href="{{route ('product.active', $product->id)}}" class="btn btn-danger btn-sm"><i class="ion-close-round"></i></a>
                                          @endif

                                          <a href="{{route ('product.edit', $product->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                          <a href="javascript:;" data-id="{{$product->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                              <form action="{{route ('product.destroy', $product->id)}}" id="delete{{$product->id}}" method="POST">
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
