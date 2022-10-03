<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Cart</title>
</head>
<body>
    @if (count($cart)==0)
    {{-- {{dd($cart)}} --}}
    <h1 class="p-3">Cart</h1>
    <div class="container-fluid">
        <div class="row w-100 justify-content-center">
            <div class="col-11 mx-auto">
                <table class="table w-100 table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">type</th>
                            <th scope="col">price</th>
                            <th scope="col">Shipped from</th>
                            <th scope="col">Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $product)
                            <tr class="products-index-table">
                                <td>{{$product['name']}}</td>
                                <td>{{$product['Item_type']}}</td>
                                <td>{{$product['Item_price']}}</td>
                                <td>{{$product['Country']}}</td>
                                <td>{{$product['Weight']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <h3 class=" my-5 text-center">Your Cart is Empty</h3>
    @endif
</body>
</html>