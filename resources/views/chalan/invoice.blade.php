@extends('layouts.app')

@section('chalan')
    active
@endsection

@section('content')
@php
    $companys = App\Models\Company::latest()->limit(1)->get();
@endphp
<div class="row" id="printc">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="clearfix" style="display: flex;">
                    @foreach($companys as $company)
                    <div style="width: 25%;padding-left: 25px;box-sizing: border-box;">
                        <img src="{{asset($company->company_logo)}}">
                    </div>
                    <div style="width: 60%; text-align: center;"><h2>{{$company->title}}</h2>
                        <p><strong>Address: </strong>{{$company->address}}</p>
                        <p><strong>Phone: </strong>{{$company->phone}}</p>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="pull-left m-t-30">
                            <address>
                              <strong>Customer Name: </strong><br>
                              Address: <br>
                              </address>
                        </div>
                        <div class="pull-right m-t-30">
                            <p><strong>Order Date: </strong> Jun 15, 2015</p>
                            <p class="m-t-10"><strong>Invoice No: </strong> #123456</p>
                        </div>
                    </div>
                </div>
                <div class="m-h-50"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table m-t-30">
                                <thead>
                                    <tr><th>#</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                </tr></thead>
                                <tbody>
                                    @foreach($items as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->weight}}</td>
                                        <td>{{$item->product->unit_cost}}</td>
                                        <td>{{$item->weight*$item->product->unit_cost}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-radius: 0px;">
                    <div class="col-md-3 col-md-offset-9">
                        <p class="text-right"><b>Sub-total:</b> {{$invoice->total}}.00</p>
                        <hr>
                        <h3 class="text-right">TAKA {{$invoice->total}}.00</h3>
                    </div>
                </div>
                <hr>
                <div class="hidden-print">
                    <div class="pull-right">
                        <a onclick="myprint('printc');" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                        <a href="#" onclick="hlw();" class="btn btn-inverse waves-effect waves-light" style="display:none;"><i class="fa fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

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