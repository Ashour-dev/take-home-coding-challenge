<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Add new product</title>
</head>
<body>
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="create-container">
            <h1 class="text-center">
                Add a new product
            </h1>
            <form class="container-fluid px-5 mt-4 w-50 mx-auto" action="{{ route('cart.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-2 px-4">
                    <div class="col-6">
                        <label for="name">Name*</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ old('name') ?? '' }}" required autocomplete="on" autofocus minlength="5">
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                Product name
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="Item_type">Category*</label>
                            <select class="form-select shadow-sm" name="Item_type" id="Item_type" value="{{ old('Item_type') ?? '' }}">
                                <option selected>Select</option>
                                <option value="T-shirt">T-shirt</option>
                                <option value="Blouse">Blouse</option>
                                <option value="Pants">Pants</option>
                                <option value="Shoes">Shoes</option>
                                <option value="Jacket">Jacket</option>
                            </select>
                        @error('Item_type')
                            <div class="alert alert-danger mt-2">
                                Category
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 ">
                        <label for="link">Link:*</label>
                        <input class="form-control" type="text" name="link" id="link" value="{{ old('link') ?? '' }}">
                        @error('link')
                            <div class="alert alert-danger mt-2">
                                link
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="Country">Shipped from:</label>
                        <select class="form-select shadow-sm" name="Country" id="Country" value="{{ old('Country') ?? '' }}">
                            <option selected>Select</option>
                            <option value="US">US</option>
                            <option value="UK">UK</option>
                            <option value="CN">CN</option>
                        </select>
                        @error('Country')
                            <div class="alert alert-danger mt-2">
                                Country
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="Item_price">Price:*</label>
                        <input class="form-control" type="number" name="Item_price" id="Item_price" value="{{ old('Item_price') ?? '' }}" required
                            min="1">
                        @error('Item_price')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="quantity">Quantity:*</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity') ?? '' }}" required
                            min="1" max="5">
                        @error('quantity')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label for="Weight">Weight:</label>
                        <input class="form-control" type="number" name="Weight" id="Weight" value="{{ old('Weight') ?? '' }}" required
                            minlength="1">
                        @error('Weight')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-outline-dark" type="submit">Add product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>