@extends('layouts.app')
@section('report')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Sells Report</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active">Manage Report</li>
            </ol>
        </div>
    </div>
{{-- Customer Table here --}}
    <div class="row">
        <div class="col-md-10 col-12 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Due Customer Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bdueed">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Due</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $key=>$customer)

                                    @if($customer->order->sum('due')-$customer->due->sum('pay_due') == 0)
                                    @else
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->order->sum('due')-$customer->due->sum('pay_due')}}</td>
                                            <td class="text-center">
                                                <a href="{{route ('list.due', $customer->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye text-danger"></i>Due Payment History</a>

                                        <a  class="btn btn-purple btn-sm" data-toggle="modal" data-target="#con-close-modal{{$customer->id}}">Payment</a>

                                        </td>
                                        </tr>
                                    @endif

                <!-- Modal content  --->
                <div id="con-close-modal{{$customer->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title"> Customer Due </h4>
                            </div>
                             <form action="{{route ('due.pay')}}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                        <input type="hidden" name="month" value="{{date('m.Y')}}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Pay Due</label>
                                        <input type="number" name="pay_due" class="form-control" placeholder="Pay Due" max="{{$customer->order->sum('due')-$customer->due->sum('pay_due')}}">
                                            @if ($errors->has('pay_due'))
                                            <span class="text-danger">{{$errors->first('pay_due')}}</span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Pay Date</label>
                                        <input type="text" name="pay_date" class="form-control" value="{{date('d.m.Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Due Pay</button>
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
