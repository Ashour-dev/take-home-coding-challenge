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
    <h1 class="p-4">Cart</h1>
    <div class="w-25 position-absolute top-0 end-0 pt-3 pe-3 text-center">
        @if (session('item-added'))
        <div class="alert alert-success">
            {{session('item-added')}}
        </div>
        @endif
    </div>
    <div class="w-25 position-absolute top-0 end-0 pt-3 pe-3 text-center">
        @if (session('item-updated'))
        <div class="alert alert-success">
            {{session('item-updated')}}
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row w-100 justify-content-center">
            <div class="col-8 mx-auto">
                <a class="float-end mb-3" href="cart/create">
                    <button type="button" class="btn btn-outline-primary">Add new Item</button>
                </a>
                @if (count($cart)!=0)
                <table class="table w-100 table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">price</th>
                            <th scope="col">Shipped from</th>
                            <th scope="col">Weight</th>
                            <th scope="col" colspan="1">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $product)
                            <tr class="products-index-table">
                                <td>{{$product['name']}}</td>
                                <td>{{$product['Item_type']}}</td>
                                <td>{{$product['quantity']}}</td>
                                <td>{{$product['Item_price']}}</td>
                                <td>{{$product['Country']}}</td>
                                <td>{{$product['Weight']}}</td>
                                <td>
                                    <a href="{{$product['link']}}">
                                        <button type="button" class="btn btn-dark shadow-none">View</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h3 class=" my-5 text-center">Your Cart is Empty</h3>
                @endif
            </div>
        </div>
    </div>
</body>
</html>