<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function store($id)
    {
        return $cart = Cart::with(['items.product'])
            ->withCount('items')
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->latest()->first();

        if (!$cart or $cart->items_count == 0) {
            return $this->empty();
        }

        $order = new Order();
        $order->customer_id = $cart->customer_id;
        $order->wasabi = $cart->wasabi;
        $order->ginger = $cart->ginger;
        $order->sticks = $cart->sticks;
        $order->sticks_quantity = $cart->sticks_quantity;
        $order->order_type_id = $id == 1 ? 1000 : 2000; // local o domicilio
        $order->order_status_id = 1000;

        $order->total = 0;
        $order->subtotal = 0;
        $order->save();

        $total = 0;

        foreach ($cart->items as $item) {

            dd($item);

            $price = $item->product->offer_price ? $item->product->offer_price : $item->product->price;

            $ot = new OrderItem();
            $ot->order_id = $order->id;
            $ot->product_id = $item->product_id;
            $ot->quantity = $item->quantity;
            $ot->price = $price;
            $ot->extra_price = $item->extra_price;
            $ot->subtotal = $item->total;


            if(count($item->product_attributes)){
                foreach ($item->product_attributes as $product_attribute){
                    $ot->extra_description .= '<div class="font-12 italic"><strong>' . $product_attribute->attribute->attribute_category->name. '</strong> : <span>'. $product_attribute->attribute->name  . '</span><div>';
                }
            }

            $ot->save();
        }

        $order->subtotal = $cart->total;

        if($order->order_type_id == 2000){
            $order->dispatch_amount = 1500;
            $order->total = $total + 1500;
            $order->save();
        }else{
            $order->total = $total;
            $order->save();
        }


        CartItem::where('cart_id', $cart->id)->delete();
        $cart->delete();

        return view('frontend.order.finish');

    }

    public function empty()
    {
        return view('frontend.cart.empty');
    }

}
