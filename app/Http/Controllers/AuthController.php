<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        $user->token = $user->createToken("registration_token")->accessToken;
        return response()->json([
            "ok" => true,
            "message" => "Success",
            "data" => $user,
        ], 201);
    }


    public function login(Request $request){
        $validator = validator($request->all(), [
            'username'=>"required ",
            'password'=>"required"
        ]);

        if($validator->fails()){
            return response()->json([
                "ok" => false,
                "message"=>"Request didn't pass validation",
                "errors"=>$validator->errors()
            ], 400);
        }

        $credentials = $request->only("username", "password");

    
        if(auth()->attempt($validator->validated())){
            $user=auth()->user();
            $user->token = $user->createToken("api-token")->accessToken;
            return response()->json([
                "ok" => true,
                "message" =>"Login Success",
                "data" => $user
            ], 200);
        }

        return response()->json([
            "ok"=>false,
            "message"=>"Incorrect username or password",
        ], 401);
    }


}
