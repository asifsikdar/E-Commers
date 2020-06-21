

@foreach($orders as $order)
<table class="table table-borderless">
    <thead>
    <tr>
        <th scope="col">Product Name</th>
        <th scope="col">Product Price</th>
        <th scope="col">Product Quantity</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="border: 1px solid black; text-align: center">{{$order->product->product_name}}</td>
        <td style="border: 1px solid black; text-align: center">{{$order->product_price}}</td>
        <td style="border: 1px solid black; text-align: center">{{$order->product_quantity}}</td>
    </tr>
    </tbody>
</table>
@endforeach