<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function __construct()
    {

    }


    public function login(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:4'
            ], []);
            if ($validator->passes()) {
                if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->intended(route('init'));

                   // return HelperFront::responseJsonSuccess('Autentificación Exitosa', null);
                } else {

                    $title = 'Error de credenciales';
                    $message = 'Los datos ingresados no coinciden con nuestros registros, intentalo denuevo.';

                    return response()->view('frontend.globals.refuted', compact('title', 'message'));

                    //return HelperFront::responseJsonError('Datos Incorrectos', null);
                    //return redirect()->back()->withErrors(['mensaje'=> 'Usuario o contraseña incorrecta.'])->withInput($request->only('email'));
                }
            }
            return HelperFront::responseJsonError($e->getMessage(), $validator->all());

        } catch (\Exception $e) {
            return HelperFront::responseJsonError($e->getMessage());
        }


    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->intended(route('init'));
    }

}
