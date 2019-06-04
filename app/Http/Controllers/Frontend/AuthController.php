<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function __construct()
    {

    }


    public function login(Request $request){

        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:4'
            ], []);

            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended(route('init'));
            }else{
                return redirect()->back()->withErrors(['mensaje'=> 'Usuario o contraseña incorrecta.'])->withInput($request->only('email'));
            }

        } catch (ValidationException $e) {
        }


    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->intended(route('init'));
    }

}
