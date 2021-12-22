@extends('layouts.app')

@section('pos')
    active
@endsection
@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
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
                                            <form action="{{route ('addcart', $product->id)}}" method="POST" class="cart-form">
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

        <div class="col-sm-6 col-md-6" id="cart-body">
            @include('pos.cart_body')

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
            <form action="{{ route('customer.store') }}" method="POST" id="add-customer">
                {{-- @csrf --}}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="from_pos" value="1">
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
        $('.exit').hide();
        $("#exit_customer").click(function(){
            $('.exit').show();
        });
//add-customer
        $(document).on('submit', "form.cart-form", {}, function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $("[name='_token']").val()
        }
      });
      $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function(data) {
            $('#cart-body').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });


    $(document).on('submit', "form#add-customer", {}, function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $("[name='_token']").val()
        }
      });
      $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function(data) {
            $('#cart-body').html(data);
            document.querySelector("#add-customer > div > div.modal-footer > button.btn.btn-default.waves-effect").click()
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

    });
    function deleteItem(url){
        $('#cart-body').load(url);
    }

    $(document).ready(function(){
        $("#new_customer").click(function(){
            $('.exit').hide();
        });
    });

    function updateCategory(id){
        $("#product-body").load('{{URL::to('/load/product')}}/'+id);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
