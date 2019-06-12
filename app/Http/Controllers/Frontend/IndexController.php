<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $destacados = Product::with('product_category')
            ->where('active',  1)
            ->where('offer', 1)
            ->orWhere('offer_price','>', 0)
            ->orderBy('position')
            ->get();

        $products_categories = ProductCategory::with('products')
            ->orderBy('position')
            ->where('active',  1)
            ->where('id', '<>', 1)
            ->whereHas('products', function($q){
                $q->where('active', 1);
            })
            ->get();

        return view('frontend.inicio.index', compact('products_categories', 'destacados'));
    }

    public function pro(){

        Return Order::with('items')->get();

        $cart =  Cart::getCart(1);
        return json_encode($cart->items[0]->product_attributes->pluck('id'));
        return CartItem::select('id')->whereHas('cart_item_attributes', function ($query) {
            $query->whereIn('cart_item_attributes.product_attribute_id', [2,3]);
        })->where('cart_id', 9)->get();

        return Product::whereHas('attributes')->get();
//        $cat = AttributeCategory::select('id')->whereHas('attributes', function($attribute){
//                $attribute->whereHas('products', function($p){
//                    $p->where('product_id', 41565);
//                });
//            })->get();
//
//        $cat;
//
//
//        return AttributeCategory::whereHas('attributes')
//        ->with(['attributes' => function($attribute){
//            $attribute->whereHas('products', function($p){
//                $p->where('product_id', 41565);
//            });
//        }])->find($cat);

    }
}
