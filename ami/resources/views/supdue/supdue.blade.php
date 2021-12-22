@extends('layouts.app')
@section('supplier')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Supplier</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active"> Supplier Due </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Supplier Due list</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FullName</th>
                                        <th>Supplier Total</th>   
                                        <th>Supplier due</th>   
                                        <th>Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($suppliers as $key=>$supplier)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$supplier->name}}</td>
                                        <td>{{($supplier->product->sum('buy_cost')*$supplier->product->sum('tweight'))-$supplier->duesupplier->sum('pay_due')}}</td>
                                        <td>{{($supplier->product->sum('tweight')-$supplier->product->sum('weight'))*$supplier->product->sum('buy_cost')-$supplier->duesupplier->sum('pay_due')}}</td>
                                        <td class="text-right">
                                            <a href="{{route('suppayshow',$supplier->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#con-close-modal{{$supplier->id}}"><i class="fa fa-check"></i></a>
                                        </td>
                                    </tr>
<!-- Modal content  --->

    <div id="con-close-modal{{$supplier->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> Supplier Due </h4>
                </div>
                <form action="{{ route('supduepay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Supplier Due</label>
                                    <input type="text" name="pay_due" class="form-control" autocomplete="off">
                                    @if ($errors->has('pay_due'))
                                        <span class="text-danger">{{ $errors->first('pay_due') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Due Pay Date</label>
                                    <input type="date" name="pay_date" class="form-control">
                                    @if ($errors->has('pay_date'))
                                        <span class="text-danger">{{ $errors->first('pay_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light"> Supplier Due Pay </button>
                        </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

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

