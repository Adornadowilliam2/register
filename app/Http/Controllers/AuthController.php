<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = validator($request->all(),[
            "username" => "required|string|min:4|max:12|unique:users",
            "email"=> "required|string|min:4|max:32|unique:users",
            "password" => "required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
            "phone_number" => "required|phone:PH|max:11",
            
        ]);

        if($validator->fails()){
            return response()->json([
                "ok" => false,
                "message" => "Request didn't pass validation",
                "error" => $validator->errors(),
            ], 400);
        }
        

        $user = User::create($validator->validated());
        return response()->json([
            "ok" => false,
            "message" => "Request didn't pass validation",
            "data" => $user,
        ], 201);
    }
}
