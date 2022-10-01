<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'nombre'=> 'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        //develve respuesta
        return response()->json([
            "status"=>1, //si esta todo ok
            "msg"=>"El usuario se registro correctamente",
            'data'=>$request->all()
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email',$request->email)->first();

        if(isset($user->id)){
            if(Hash::check($request->password,$user->password)){

                $token = $user->createToken("auth_token")->plainTextToken;
                Auth::login($user);
                return response()->json([
                    "status"=>1,
                    "msg"=>"Login correcto",
                    "access_token"=>$token
                ]);

            }else{
                return response()->json([
                    "status"=>0,
                    "msg"=>"La password es incorrecta",
                ],400);
            }
        }else{
            return response()->json([
                "status"=>0,
                "msg"=>"Credenciales incorrectas",
            ],400);
        }
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        auth()->guard('web')->logout();


        return response()->json([
            "status"=>1, //si esta todo ok
            "msg"=>"Logout exitoso",
        ]);
    }
}
