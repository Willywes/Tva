<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth_cart');
    }

    public function orders()
    {
        $orders = Order::with('items')
            ->withCount('items')
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('frontend.profile.orders', compact('orders'));
    }

    public function addresses()
    {
        return view('frontend.profile.addresses');
    }

    public function getAddresses()
    {
        try {
            $addresses = CustomerAddress::where('customer_id', auth()->guard('customer')->user()->id)
                ->orderBy('id', 'desc')
                ->get();
            if ($addresses) {
                return HelperFront::responseJsonSuccess(null, $addresses);
            }
            return HelperFront::responseJsonError($addresses);
        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
    }

    public function addAddress(Request $request)
    {
        try {

            if ($request->address) {
                $exits = CustomerAddress::where('address', $request->address)
                    ->where('customer_id', auth()->guard('customer')->user()->id)
                    ->first();

                if(!$exits){

                    $count = CustomerAddress::where('customer_id', auth()->guard('customer')->user()->id)
                        ->count() + 1;
                    $address = new CustomerAddress();
                    $address->name = $request->name ?? 'Mi Dirección ' . $count ;
                    $address->address  = $request->address;
                    $address->customer_id = auth()->guard('customer')->user()->id;
                    $address->save();

                    if ($address->save()) {
                        return HelperFront::responseJsonSuccess('Nueva dirección registrada correctamente', $address);
                    } else {
                        return HelperFront::responseJsonError('Error al agregar la dirección');
                    }
                }else{
                    return HelperFront::responseJsonError('Dirección ya registrada',null, 409);
                }

            } else {
                return HelperFront::responseJsonError('No hay dirección para agregar.');
            }


        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
    }
}
