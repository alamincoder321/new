@foreach ($products as $product)
<tr>
    <form id="form-{{$product->id}}" action="{{route ('addcart', $product->id)}}" method="POST" class="cart-form">
        @csrf

        <td>{{ $product->name }}</td>
        <td>{{ $product->unit_cost }}</td>
        <td>{{ $product->weight }}</td>
        <td><button form="form-{{$product->id}}" type="submit" class="btn btn-success btn-sm"><i
                    class="fa fa-plus-square"></i></button></td>
    </form>
</tr>
@endforeach
