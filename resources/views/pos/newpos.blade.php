@extends('layouts.app')

@section('pos')
    active
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    @foreach ($categories as $category)
                        <button onclick="updateCategory({{$category->id}})" type="button"
                            class="btn btn-purple waves-effect waves-light w-sm m-b-5" id="cat{{$category->id}}" value="{{$category->id}}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
                <!-- Product tabel here ----->

        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Product table </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-4 col-sm-4 col-xs-12">
                            <table id="datatable" class="col-4 table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="product-body">
                                    @foreach ($products as $product)
                                        <tr>
                                            <form action="{{route ('addcart', $product->id)}}" method="POST">
                                                @csrf
                                                
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->unit_cost }}</td>
                                                <td>{{ $product->weight }}</td>
                                                <td><button type="submit" class="btn btn-success btn-sm"><i
                                                            class="fa fa-plus-square"></i></button></td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <div class="price_card text-center">
                <h4 class="bg-info text-center text-white"> Invoice Product </h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Sl</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Unit Total Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $key=>$cart)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$cart->product->name}}</td>
                            <td>
                                <form action="{{route ('updatecart', $cart->id)}}" method="POST">
                                    @csrf
                                    <input type="number" name="weight" value="{{$cart->weight}}" style="width:30%; padding:3px; text-align:center;">
                                    <button type="submit" class="btn btn-success btn-sm" style="margin-top: 0px;"><i class="fa fa-check"></i></button>
                                </form>
                            </td>
                            <td>{{$cart->weight*$cart->product->unit_cost}}</td>
                            <td>
                                <a href="{{route ('destroy', $cart->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
                <div class="pricing-header bg-primary"><br>
                    <h1 class="text-white">Total Price</h1>
                    <h4 class="text-white p-0 m-0">{{$total}} taka</h4>
                    <hr>                    
                </div>
                <form action="{{route ('order.place')}}" method="POST">
                    @csrf
                    <div class="col-md-12 row mb-4">
                        <div class="col-md-6 card">                        
                            <button type="button" id="new_customer" class="btn btn-info" data-toggle="modal" data-target="#con-close-modal" class="btn btn-success">New Customer</button>
                        </div>
                        <div class="col-md-6">                        
                            <button type="button" id="exit_customer" class="btn btn-purple">Exit Customer</button> 
                        </div>
                    </div>
                    @if ($errors->has('customer_id'))
                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                    @endif
                    <div class="exit">
                        <br><br><br><br>
                        <div class="col-md-8 col-md-offset-2 mt-md-3">
                            <select name="customer_id" class="form-control text-center select">
                                <option>Select customer Name</option>
                                @foreach ($customers as $customer)
                                  <option value="{{$customer->id}}">{{$customer->name}}</option>  
                                @endforeach
                            </select>
                        </div>
                    </div><br><br><br>
                    <div class="pay">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group col-md-6">
                                <label>Pay Amount</label>
                                <input type="text" name="pay_amount" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Discount</label>
                                <input type="text" name="discount" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6 col-md-offset-3">
                                <label>Total Amount</label>
                                <input type="text" name="total" class="form-control text-center" value="{{$total}}" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pay_date" value="{{date('d.m.Y')}}">
                    <input type="hidden" name="month" value="{{date('m.Y')}}">
                    <button type="submit" class="btn btn-success btn-lg text-center">Save Order</button>
                </div> <!-- end Pricing_card -->
            </form>
        </div>
    </div> <!-- End Row -->

<!-- Modal content  --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Customer Add </h4>
            </div>
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">First Name</label>
                                <input type="text" name="name" class="form-control" autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Phone</label>
                                <input type="number" name="phone" class="form-control" autocomplete="off">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">City</label>
                                <input type="text" name="city_name" class="form-control" autocomplete="off">
                                @if ($errors->has('city_name'))
                                    <span class="text-danger">{{ $errors->first('city_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Upozila</label>
                                <input type="text" name="upozila" class="form-control" autocomplete="off">
                                @if ($errors->has('upozila'))
                                    <span class="text-danger">{{ $errors->first('upozila') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Add Customer</button>
                    </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $("#exit_customer").click(function(){
            $('.exit').show();
        });
    });

    $(document).ready(function(){        
        $("#new_customer").click(function(){
            $('.exit').show();
        });
    });

    function updateCategory(id){
        $("#product-body").load('{{URL::to('/load/product')}}/'+id);
    }
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
@endpush
