<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class WebAuthController extends Controller
{

    public function auth_check(){
        $session = Session::get('auth_user');
//        dd($session['user_id']);
        if (isset($session['user_id'])){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function web_login(Request $request){

        if(auth()->attempt(['email'=>$request->login,'password'=>$request->password],true)){

            $user = Auth::user();
            Session::put('auth_user',
                [
                    'user_id' => $user->id,
                ]);
            return response()->json(true);
        }else{
            return abort(403, 'Вы не авторизованы!');
        }
    }

}