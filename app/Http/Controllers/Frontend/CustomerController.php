<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth_cart')->except(['recoveryPassword', 'sendPassword', 'createAccount', 'registerAccount']);
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

                if (!$exits) {

                    $count = CustomerAddress::where('customer_id', auth()->guard('customer')->user()->id)
                            ->count() + 1;
                    $address = new CustomerAddress();
                    $address->name = $request->name ?? 'Mi Dirección ' . $count;
                    $address->address = $request->address;
                    $address->customer_id = auth()->guard('customer')->user()->id;
                    $address->save();

                    if ($address->save()) {
                        return HelperFront::responseJsonSuccess('Nueva dirección registrada correctamente', $address);
                    } else {
                        return HelperFront::responseJsonError('Error al agregar la dirección');
                    }
                } else {
                    return HelperFront::responseJsonError('Dirección ya registrada', null, 409);
                }

            } else {
                return HelperFront::responseJsonError('No hay dirección para agregar.');
            }


        } catch (\Exception $exception) {
            return HelperFront::responseJsonError($exception->getMessage());
        }
    }

    public function myProfile()
    {
        $customer = Customer::find(auth()->guard('customer')->user()->id);
        return view('frontend.profile.my-profile', compact('customer'));
    }

    public function storeProfile(Request $request)
    {

        $id = decrypt($request->id);

        if ($id != auth()->guard('customer')->user()->id) {
            $title = 'Privilegios no asignados';
            $message = 'Acción no valida.';

            return response()->view('frontend.globals.refuted', compact('title', 'message'));
        }

        $rules = [
            'email' => 'required|email|unique:customers,email,' . $id,
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric|min:100000000|max:999999999'
        ];

        $messages = [
            'firstname.required' => 'El campo nombres es obligatorio.',
            'lastname.required' => 'El campo apellidos es obligatorio.',
            'phone.min' => 'El teléfono debe tener 9 digitos.',
            'phone.max' => 'El teléfono debe tener 9 digitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $customer = Customer::find($id);
            $customer->update($request->except('id'));
            $customer->phone = '+56' . $request->phone;
            $customer->save();

            if ($customer) {
                session()->flash('success', 'Datos actualizados correctamente.');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al actualizar los datos.'])->withInput();

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    public function changePassword()
    {
        return view('frontend.profile.change-password');
    }

    public function storePassword(Request $request)
    {

        $rules = [
            'old_password' => 'required',
            'password' => 'required|min:4|different:old_password',
            'password_confirmation' => 'required|same:password'
        ];

        $messages = [
            'different' => 'La contraseña debe ser diferente a la que esta usando.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $customer = auth()->guard('customer')->user();

            if (Hash::check($request->old_password, $customer->password)) {
                $customer->password = bcrypt($request->password);
                $customer->save();

                $title = 'Cambio de Contraseña';
                $message = 'Su nueva contraseña ha sido actualizada correctamente.';

                return response()->view('frontend.globals.refuted', compact('title', 'message'));

            } else {
                return redirect()->back()->withErrors(['mensaje' => 'la contraseña anterior no coincide.'])->withInput();
            }

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    public function recoveryPassword()
    {
        if (auth()->guard('customer')->user()) {
            return redirect()->route('init');
        }
        return view('frontend.profile.recovery-password');
    }

    public function sendPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $customer = Customer::where('email', $request->email)->first();

            if ($customer) {
                $pass = mt_rand(123456, 999999);
                $customer->password = bcrypt($pass);
                $customer->save();
                HelperFront::sendMailRecoveryCustomer($customer->id, $pass);
            }
            $title = 'Recuperación de Contraseña';
            $message = 'Su nueva contraseña ha sido generada y fue enviada al correo ' . $request->email . '.';

            return response()->view('frontend.globals.refuted', compact('title', 'message'));

//            session()->flash('success', 'Revise su correo, le enviaremos su nueva contraseña de acceso');
//            return redirect()->back();

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    public function createAccount()
    {
        if (auth()->guard('customer')->user()) {
            return redirect()->route('init');
        }
        return view('frontend.profile.create-account');
    }

    public function registerAccount(Request $request)
    {

        $rules = [
            'email' => 'required|email|unique:customers,email',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric|min:100000000|max:999999999',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ];

        $messages = [
            'firstname.required' => 'El campo nombres es obligatorio.',
            'lastname.required' => 'El campo apellidos es obligatorio.',
            'phone.min' => 'El teléfono debe tener 9 digitos.',
            'phone.max' => 'El teléfono debe tener 9 digitos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $customer = Customer::create($request->except('id'));
            $customer->password = bcrypt($request->password);
            $customer->save();

            if ($customer) {

                if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){

                    $title = 'Hola, ' .  auth()->guard('customer')->user()->fullname;
                    $message = 'Tu cuenta ha sido registrada con éxito, te invitamos a disfrutar de nuestros deliciosos productos.';

                    return response()->view('frontend.globals.refuted', compact('title', 'message'));
                }else{
                    $title = 'Registro Éxitoso';
                    $message = 'Tu cuenta ha sido registrada con éxito, te invitamos a disfrutar de nuestros deliciosos productos. Por favor inicia sessión';

                    return response()->view('frontend.globals.refuted', compact('title', 'message'));
                }

                session()->flash('success', 'Datos actualizados correctamente.');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al actualizar los datos.'])->withInput();

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
