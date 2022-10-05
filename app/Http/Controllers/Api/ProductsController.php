<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\config\products;

class ProductsController extends Controller
{
    public function index()
    {
        $products=config('products');
        return response()->json($products);
    }
}
