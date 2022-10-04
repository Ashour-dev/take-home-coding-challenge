<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart=Cart::all();
        return view('cart.index',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3','max:255'],
            'Item_type' => ['required', 'string', 'min:3','max:255'],
            'link' => ['required', 'string','min:10','max:65000'],
            'Item_price' => ['required', 'numeric','min:1'],
            'quantity' => ['required', 'numeric','min:1','max:5'],
            'Country'=> Rule::in(['','UK', 'US','CN']),
        ]);
        $data = $request->all();

        $newItem = new Cart();
        $newItem->name = $data["name"];
        $newItem->Item_type = $data["Item_type"];
        $newItem->Country = $data["Country"];
        $newItem->quantity = $data["quantity"];
        $newItem->Item_price = $data["Item_price"]*$data["quantity"];
        $newItem->Weight = $data["Weight"];
        $newItem->link = $data["link"];
        if(isset($data["Country"])){
            if($data["Country"]=='UK'||$data["Country"]=='CN')
                $rate=2;
            else
                $rate=3;
            $newItem->Rate =$rate;
            $newItem->Shipping = ($data["Weight"]*10)*$rate;
        }
        $newItem->VAT=($newItem->Item_price*14)/100;
        $newItem->save();
        return redirect()->route('cart.index')->with('item-added','New Item is added');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }
}
