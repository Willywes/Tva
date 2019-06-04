<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id',
        'customer_id',
        'wasabi',
        'ginger',
        'sticks',
        'sticks_quantity',
        'dispatch_amount',
        'comments',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'total_items',
        'subtotal',
        'total'
    ];

    // RELATIONS

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    static function getCart($customer_id = null)
    {
        $id = $customer_id ? $customer_id : auth()->guard('customer')->user()->id;
        $customer = Customer::findOrFail($id);

        $cart = self::with(['items.product'])
            ->withCount('items')
            ->where('customer_id', $customer->id)
            ->latest()->first();

        if (!$cart) {
            self::create([
                'customer_id' => $customer->id
            ]);
            $cart = Cart::getCart();
        }
        return $cart;

    }

    static function deleteCart($customer_id = null)
    {
        try {
            return self::where('customer_id', $customer_id ? $customer_id : auth()->guard('customer')->user()->id)->delete();
        } catch (\Exception $exception) {
            return null;
        }
    }

    function addToCart($product_id, $cart_id = null, $quantity = null)
    {

        $product = Product::find($product_id);

        if ($product) {

            $item = null;

            $item = CartItem::where('product_id', $product->id)
                ->where('cart_id', $cart_id ? $cart_id : $this->id)
                ->first();

            if ($item) {
                $item->quantity = $quantity ? $quantity : $item->quantity + 1;
                $item->save();

            } else {
                $item = CartItem::create([
                    'product_id' => $product->id,
                    'cart_id' => $cart_id ? $cart_id : $this->id,
                    'quantity' => $quantity ? $quantity : 1,
                ]);
            }
            if ($item) {
                return true;
            }
            return false;
        }
        return false;
    }

    function removeFromCart($product_id, $cart_id = null)
    {
        $product = Product::find($product_id);

        if ($product) {

            $item = CartItem::where('product_id', $product->id)
                ->where('cart_id', $cart_id ? $cart_id : $this->id)
                ->delete();

            if ($item) {
                $item->quantity = $item->quantity + 1;
                $item->save();

            } else {
                CartItem::create([
                    'product_id' => $product->id,
                    'cart_id' => $cart_id ? $cart_id : $this->id,
                    'quantity' => 1,
                ]);
            }

            return true;
        }
        return false;
    }

    function getDispatchAmount()
    {
        return $this->dispatch_amount;
    }

    function setDispatchAmount($dispatch_amount = null)
    {
        $this->dispatch_amount = $dispatch_amount;
        $this->save();
    }

    function getSubtotalAttribute()
    {
        $subtotal = 0;

        if ($this->items) {
            foreach ($this->items as $item) {
                $subtotal += $item->total;
            }
        }
        return $subtotal;
    }

    function getTotalAttribute()
    {
        $total = $this->getSubtotalAttribute();
        if ($this->dispatch_amount) {
            $total += $this->dispatch_amount;
        }
        return $total;
    }

    function getTotalItemsAttribute()
    {
        $total = 0;

        if ($this->items) {
            foreach ($this->items as $item) {
                $total += $item->quantity;
            }
        }
        return $total;
    }

    function isEmpty()
    {
        if ($this->items) {
            return false;
        }
        return true;
    }

    function addDispatchCharger()
    {
        $this->dispatch_amount = 1500;
        $this->save();
    }

    function removeDispatchCharger()
    {
        $this->dispatch_amount = 0;
        $this->save();
    }

    function deleteItems()
    {
        return CartItem::where('cart_id', $this->id)->delete();
    }
}
