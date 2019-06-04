<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth_cart');
        $this->middleware('only_ajax', ['except' => [
            'index',
            'currier',
            'repeatOrder',
            'selectDelivery',
            'dispatchDelivery',
            'selectAddress',
            'setDelivery',
            'finish'
        ]]);
    }

    public function index()
    {
        $cart = Cart::getCart();
        return view('frontend.cart.full-cart', compact('cart'));
    }

    public function getCart()
    {

        try {
            $cart = Cart::getCart();
            if ($cart) {
                return HelperFront::responseJsonSuccess(null, (object)$cart);
            }
            return HelperFront::responseJsonError($cart);
        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
    }

    public function addToCart(Request $request)
    {

        try {
            $cart = Cart::getCart();
            if ($cart) {
                $product = Product::find($request->product_id);
                if(!$product->product_category->active or !$product->active){
                    return HelperFront::responseJsonError('Lo sentimos este producto no puede ser pedido por ahora.');
                }
                if ($product) {
                    if ($cart->addToCart($product->id)) {
                        return HelperFront::responseJsonSuccess('Producto agregado correctamente.', $product);
                    }
                    return HelperFront::responseJsonError('Error al crear el carro');
                }
                return HelperFront::responseJsonError('Producto no encontrado');
            }
        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }


    }

    public function updateCart(Request $request)
    {

        try {

            $cart = Cart::getCart();
            $cart->update($request->all());

            if ($request->sticks == false and !$request->has('sticks_quantity')) {
                // return $request->sticks;
                if (!$cart->sticks) {
                    $cart->update(['sticks_quantity' => 1]);
                }
            }

            if ($request->products) {
                foreach ($request->products as $key => $value) {
                    $item = CartItem::where('product_id', $key)->where('cart_id', $cart->id)->first();
                    $item->quantity = $value;
                    $item->save();

                    if ($value < 1) {
                        $item->delete();
                    }
                }
            }
            return HelperFront::responseJsonSuccess(null, $cart);

        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }

    }

    public function removeFromCart(Request $request)
    {
        try {
            $cart_item = CartItem::find($request->id);
            if ($cart_item) {
                if ($cart_item->delete()) {
                    return HelperFront::responseJsonSuccess('Producto eliminado correctamente.');
                }
                return HelperFront::responseJsonError('Error al crear el carro');
            }
        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
    }


    public function repeatOrder(Request $request)
    {
        $order = Order::with('items')->where('customer_id', auth()->guard('customer')->user()->id)->find($request->id);
        if ($order) {

            $cart = Cart::getCart();
            $cart->deleteItems();


            $cart->wasabi = $order->wasabi;
            $cart->ginger = $order->ginger;
            $cart->sticks = $order->sticks;
            $cart->sticks_quantity = $order->sticks_quantity;
            //$cart->dispacth_amount = $order->dispacth_amount;
            $cart->save();

            foreach ($order->items as $item) {
                $cart->addToCart($item->product_id, null, $item->quantity);
            }

            return redirect()->route('cart');

        }

        $title = 'Error';
        $message = 'No se ha encontrado la orden.';
        return response()->view('frontend.globals.refuted', compact('title', 'message'));

    }


    public function selectDelivery()
    {
        $cart = Cart::getCart();

        if (!$cart or $cart->items_count == 0) {
            return view('frontend.cart.empty');
        } else {
            return view('frontend.cart.select-delivery', compact('cart'));
        }
    }

    public function dispatchDelivery(Request $request)
    {

        $cart = Cart::getCart();
        $id = decrypt($request->type);

        if (!$cart or $cart->items_count == 0) {
            return view('frontend.cart.empty');
        }
        if ($id != 1000 and $id != 2000) {
            $title = 'Error';
            $message = 'No se ha seleccionado el tipo de delivery de forma correcta';
            return response()->view('frontend.globals.refuted', compact('title', 'message'));
        }

        if ($id == 1000) {
            return $this->storeOrder(1000, $request);
        }
        if ($id == 2000) {
            return redirect()->route('order.select-address');
        }
    }

    public function selectAddress()
    {

        $cart = Cart::getCart();

        if (!$cart or $cart->items_count == 0) {
            return view('frontend.cart.empty');
        } else {
            return view('frontend.cart.domicilio');
        }

    }

    public function setDelivery(Request $request)
    {
        $cart = Cart::getCart();
        if (!$cart or $cart->items_count == 0) {
            return view('frontend.cart.empty');
        } else {
            return $this->storeOrder(2000, $request);
        }
    }

    public function storeOrder($id, Request $request)
    {
        //return redirect()->route('order.finish');

        $cart = Cart::with(['items.product'])
            ->withCount('items')
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->latest()->first();

        if (!$cart or $cart->items_count == 0) {
            return view('frontend.cart.empty');
        }

        $pay = $request->payment ? decrypt($request->payment) : null;

        $order = new Order();
        $order->customer_id = $cart->customer_id;
        $order->wasabi = $cart->wasabi;
        $order->ginger = $cart->ginger;
        $order->sticks = $cart->sticks;
        $order->sticks_quantity = $cart->sticks_quantity;
        $order->comments = $cart->comments;
        $order->order_status_id = 1000;
        $order->order_type_id = $id; // local o domicilio

        $order->total = 0;
        $order->subtotal = 0;
        $order->save();

        $total = 0;

        foreach ($cart->items as $item) {

            $price = $item->product->offer_price ? $item->product->offer_price : $item->product->price;
            $sub_total = $item->quantity * $price;
            $total += $sub_total;

            $ot = new OrderItem();
            $ot->order_id = $order->id;
            $ot->product_id = $item->product_id;
            $ot->quantity = $item->quantity;
            $ot->price = $price;
            $ot->subtotal = $sub_total;
            $ot->save();
        }

        $order->subtotal = $total;

        if ($order->order_type_id == 2000) {

            $order->dispatch_amount = 1500;
            $order->total = $total + 1500;
            $order->customer_address_id = $request->customer_address_id;

            $order->payment = $pay == 1 ? 'Efectivo' : 'Tarjeta de Débito/Crédito';

            $order->save();

        } else {
            $order->customer_address_id = null;
            $order->total = $total;
            $order->payment = null;
            $order->save();
        }


        CartItem::where('cart_id', $cart->id)->delete();
        $cart->delete();

        session()->flash('order_id', $order->id);
        return redirect()->route('order.finish');

    }

    function finish()
    {
        if (session()->has('order_id')) {
            $order = Order::find(session('order_id'));
            HelperFront::sendMailCustomer($order->id);
            return view('frontend.cart.finish', compact('order'));
        } else {
            return redirect()->route('profile.orders');
        }

    }
}
