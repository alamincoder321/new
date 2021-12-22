
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
                    <tbody >
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
                                <button onclick="deleteItem('{{route ('destroy', $cart->id)}}')" class="btn btn-danger btn-sm delete-button"><i class="fa fa-trash"></i></button>
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
                    {{-- @csrf --}}
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
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
                            <select name="customer_id" class="form-control text-center customer">
                                <option label="Select customer name"></option>
                                @foreach ($customers as $customer)
                                  <option
                                    @if(isset($new_customer))
                                    {{$new_customer->id == $customer->id ? 'selected' : ''}}
                                    @endif
                                  value="{{$customer->id}}">{{$customer->name}}</option>
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
                                <input type="text" name="total" class="form-control text-center" value="{{$total}}">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pay_date" value="{{date('d.m.Y')}}">
                    <input type="hidden" name="month" value="{{date('m.Y')}}">
                    <button type="submit" class="btn btn-success btn-lg text-center">Save Order</button>
                </div> <!-- end Pricing_card -->
            </form>
