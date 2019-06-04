<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{


    public function add_item_cart_customer(Request $request)
    {
        try {
            $cart = Cart::getCart();
            if($cart){
                if ($request->product_id) {
                    if ($cart->addToCart($request->product_id)) {
                        return response()->json([
                            'status' => 'success',
                            'data' => Product::find($request->product_id)
                        ]);
                    }else{
                        HelperFront::responseJsonError('Error al agregar el producto al carrito');
                    }
                }else{
                    HelperFront::responseJsonError('Error al agregar el producto al carrito');
                }
            }else{
                return HelperFront::responseJsonError('Error al intentar acceder al carrito');
            }



        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }

    }

    public function get_cart_customer()
    {
        try {
            $cart = Cart::getCart();
        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
        return response()->json([
            'status' => 'success',
            'data' => $cart
        ]);
    }

    public function update_cart_customer(Request $request)
    {

        try {
            $cart = Cart::getCart();
            $cart->update($request->all());
            if($request->sticks == false and !$request->has('sticks_quantity')){
                $cart->update(['sticks_quantity' => 1]);
            }
            if ($request->products) {
                foreach ($request->products as $key => $value) {
                    $item = CartItem::where('product_id', $key)->where('cart_id', $cart->id)->first();
                    $item->quantity = $value;
                    $item->save();
                }
            }

        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
        return response()->json([
            'status' => 'success',
            'data' => $cart
        ]);
    }
}
