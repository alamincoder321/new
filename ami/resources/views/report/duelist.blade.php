@extends('layouts.app')
@section('report')
    active
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Due</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Due List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Due List Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bdueed">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Due Payment Date</th>
                                        <th>Due Payment</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $key = 1;
                                    @endphp

                                    @foreach ($dues as $item)
                                    <tr>
                                        <td>{{$key++}}</td>
                                        <td>{{$item->pay_date}}</td>
                                        <td>{{$item->pay_due}}</td>
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

