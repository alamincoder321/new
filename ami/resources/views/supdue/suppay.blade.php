@extends('layouts.app')
@section('supplier')
    active
@endsection

@push('style')
    <style type="text/css">
        @media print{
            #datatable
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Supplier Due</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}"> Dashboard </a></li>
                <li class="active"> Supplier Due Payment List </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a onclick="myprint('printc');" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                            <a href="#" onclick="hlw();" class="btn btn-inverse waves-effect waves-light" style="display:none;"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                    <h3 class="panel-title">Supplier Due Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="printc">
                            <table id="datatable" class="table table-striped table-bdueed">
                                <thead>
                                    <tr>
                                        <th>Pay Date</th>
                                        <th>Due payment</th>
                                        <th class="hidden-print">Action</th>                                
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($suppays as $item)
                                    <tr>
                                        <td>{{$item->pay_date}}</td>
                                        <td>{{$item->pay_due}}</td>
                                        <td class="hidden-print">
                                            <a href="{{route('supedit', $item->id)}}" class="btn btn-info btn-sm button"><i class="fa fa-edit"></i></button>
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

@push('js')
    <script type="text/javascript">
        function hlw() {
            window.print();
        }

        function myprint(value){
            var backup = document.body.innerHTML;
            var content = document.getElementById(value).innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = backup;
        }
    </script>
@endpush
