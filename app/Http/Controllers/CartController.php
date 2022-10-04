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
        if(isset($cart)){
            $subtotal=0;
            $totalShipping=0;
            $shippingCalculatable=true;
            $totalVat=0;
            $items=0;
            $offShoes=0;
            $offShipping=false;
            $tops=0;
            $jacketsDiscounted=false;
            $jacketDiscount=0;
            $discounts=false;
            foreach($cart as $product){
                $subtotal+=$product['Item_price'];
                $totalVat+=$product['VAT'];
                if($product->Item_type=='Shoes')
                    $offShoes+=($product->Item_price*10)/100;
                if($product->Item_type=='T-shirt'||$product->Item_type=='Blouse'){
                    if($product->quantity==1)
                        $tops++;
                    else{
                        for($i=0;$i<$product->quantity;$i++)
                            $tops++;
                    }
                }
                if($product->Item_type=='Jacket'&&!$jacketsDiscounted){
                    $jacketDiscount=$product->Item_price/2;
                    $jacketsDiscounted=true;
                }
                if($shippingCalculatable){
                    if($product['Shipping']==null){
                        $shippingCalculatable=false;
                        $totalShipping='To be determined';
                    }
                    else
                        $totalShipping+=$product['Shipping'];
                }
                if($product->quantity==1)
                    $items++;
                else{
                    for($i=0;$i<$product->quantity;$i++)
                        $items++;
                }
            }
            if($tops<2)
                $jacketsDiscounted=false;
            if($shippingCalculatable){
                if($items>=2){
                    $totalShipping-=10;
                    $offShipping=true;
                }
                if($totalShipping<0)
                    $totalShipping=0;
                if($jacketsDiscounted)
                    $total=$subtotal+$totalShipping+$totalVat-$offShoes-$jacketDiscount;
                else
                    $total=$subtotal+$totalShipping+$totalVat-$offShoes;
            }
            else
                $total='To be determined';
            if($offShipping||$jacketsDiscounted||$offShoes>0)
                $discounts=true;
            $calculatedData=[
                'subtotal'=>$subtotal,
                'totalShipping'=>$totalShipping,
                'totalVat'=>$totalVat,
                'discounts'=>$discounts,
                'offShoes'=>$offShoes,
                'offShipping'=>$offShipping,
                'jacketsDiscounted'=>$jacketsDiscounted,
                'jacketDiscount'=>$jacketDiscount,
                'total'=>$total,
            ];
        }
        return view('cart.index',compact('cart','calculatedData'));
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
            'Item_type' => ['required', Rule::in(['','T-shirt','Blouse', 'Pants','Shoes','Jacket'])],
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
        return view('cart.edit',compact('cart'));
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
        $request->validate([
            'name' => ['required', 'string', 'min:3','max:255'],
            'Item_type' => ['required', Rule::in(['','T-shirt','Blouse', 'Pants','Shoes','Jacket'])],
            'link' => ['required', 'string','min:10','max:65000'],
            'Item_price' => ['required', 'numeric','min:1'],
            'quantity' => ['required', 'numeric','min:1','max:5'],
            'Country'=> Rule::in(['','UK', 'US','CN']),
        ]);
        $data = $request->all();

        $cart->name = $data["name"];
        $cart->Item_type = $data["Item_type"];
        $cart->Country = $data["Country"];
        $cart->quantity = $data["quantity"];
        $cart->Item_price = $data["Item_price"]*$data["quantity"];
        $cart->Weight = $data["Weight"];
        $cart->link = $data["link"];
        if(isset($data["Country"])){
            if($data["Country"]=='UK'||$data["Country"]=='CN')
                $rate=2;
            else
                $rate=3;
            $cart->Rate =$rate;
            $cart->Shipping = ($data["Weight"]*10)*$rate;
        }
        $cart->VAT=($cart->Item_price*14)/100;
        $cart->update();
        return redirect()->route('cart.index')->with('item-updated','Your item was modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('item-deleted','Your item was deleted successfully');
    }
}
