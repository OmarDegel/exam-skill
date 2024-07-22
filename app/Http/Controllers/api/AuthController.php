<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
       $val= Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($val->fails()){
            return response()->json([
                "erorrs"=>$val->errors()
            ],409);
        }
        $access_token=Str::random(64);
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_token' => $access_token,
        ]);

        return response()->json([
            "access_token"=>$access_token
        ],201);
        
    }
    public function login(Request $request){
        $val= Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if($val->fails()){
            return response()->json([
                "erorrs"=>$val->errors()
            ],409);
        }
        $user=User::where("email",$request->email)->first();

        if($user !== null){
            $login= Hash::check($request->password, $user->password);
            $access_token=Str::random(64);

                if($login){
                    $user->update([
                        "access_token"=>$access_token
                    ]);

                    return response()->json([
                        "access_token"=>$access_token
                    ],201);

                }else{
                    return response()->json([
                        "msg"=> "bad password"
                    ]);
                }
        }else{
            return response()->json([
                "msg"=> "email not found"
            ]);
        }


    }
    public function logout(Request $request){
        $access_token=$request->header("access_token");
        $user=User::where("access_token",$access_token)->first();
        $user->update([
            "access_token" =>null
        ]);
        return response()->json([
            "msg"=> "logged out succussfully"
        ], 200);
    }
}
