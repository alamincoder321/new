<tbody id="product-body">
    @foreach ($products as $product)
        <tr>
            <form action="{{route ('addcart', $product->id)}}" method="POST" id="form-{{$product->id}}">
                @csrf
            </form>
                <td>{{ $product->name }}</td>
                <td>{{ $product->unit_cost }}</td>
                <td>{{ $product->weight }}</td>
                <td><button type="submit" form="form-{{$product->id}}" class="btn btn-success btn-sm"><i
                            class="fa fa-plus-square"></i></button></td>

        </tr>
    @endforeach
</tbody>
