<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return response()->json([
        "ok" => true,
        "message" => "User info has been retrieved",
        "data" => User::all()
        ], 200);
    }

    

    public function store(Request $request){
        $validator = validator($request->all(), [
            "username" => "required|min:4|stri ng|unique:users|max:32",
            "password" => "required|min:8|max:32|string|confirmed",
            "phone_number" => "required|min:11|max:13|phone:PH",
            "email" => "required|email|max:64|unique:users",
        ]);

    
        if($validator->fails()){
            return response()->json([
                "ok" => false,
                "message" => "Request didnt pass the validation.",
                "errors" => $validator->errors()
            ], 400);
        }
    
        $user = User::create($validator->validated());
        $user->token = $user->createToken("registration_token")->accessToken;
        return response()->json([
            "ok" => true,
            "message" => "Account has been created!",
            "data" => $user
        ], 201);
    }
 
}
