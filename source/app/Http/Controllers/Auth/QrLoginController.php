<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrLoginController extends Controller
{
    public function showQrReader(){
        return view('auth.qr.login');

    }

    public function login(Request $request){
        
        $result = false;
        dd($request->uuid);
        $user = \App\User::where('uuid', $request->uuid)->first();

        if(!is_null($user)){
            \Auth::login($user);
            $result = true;
        }

        return [
            'result' => $result,
            'user' => $user
        ];
    }
}
