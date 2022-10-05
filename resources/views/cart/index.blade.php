@extends('layouts.app')

@section('title','Cart')

@section('content')
    <h1 class="text-center">Cart</h1>
    @if (session('item-added'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 me-3" role="alert">
            {{session('item-added')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('item-updated'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 me-3" role="alert">
            {{session('item-updated')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('item-deleted'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 me-3" role="alert">
            {{session('item-deleted')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                            <th scope="col">Options</th>
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
                                <td class="d-flex justify-content-around">
                                    <a href="{{$product['link']}}">
                                        <button type="button" class="btn btn-sm btn-outline-dark shadow-none">
                                            <span class="material-symbols-outlined">
                                                open_in_new
                                            </span>
                                        </button>
                                    </a>
                                
                                    <a href="/cart/{{$product['id']}}/edit">
                                        <button type="button" class="btn btn-sm btn-outline-dark shadow-none">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </button>
                                    </a>
                                
                                    <form action="{{ route('cart.destroy', $product) }}" method="POST"
                                        class="cart-form-destroyer">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger shadow-none">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <img class="w-100" src="https://www.adasglobal.com/img/empty-cart.png" alt="">
                @endif
            </div>
        </div>
        @if (count($cart)!=0)
            <div class="receipt position-fixed bottom-0 start-0 p-3 m-3 border border-secondary">
                <span>Subtotal: {{$calculatedData['subtotal']}}</span>
                <span>Shipping: {{$calculatedData['totalShipping']}}</span>
                <span>Vat: {{$calculatedData['totalVat']}}</span>
                @if(isset($calculatedData['discounts']))
                    <span>Discounts:</span>
                    @if ($calculatedData['offShoes']>0)
                        <span class="ms-5">10% off shoes: -${{$calculatedData['offShoes']}}</span>
                    @endif
                    @if ($calculatedData['jacketsDiscounted'])
                        <span class="ms-5">50% off jacket: -${{$calculatedData['jacketDiscount']}}</span>
                    @endif
                    @if ($calculatedData['offShipping'])
                        <span class="ms-5">$10 of shipping: -$10</span>
                    @endif
                @endif
                <span>Total: {{$calculatedData['total']}}</span>
            </div>
        @endif
    </div>
@endsection
