<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           $user=Auth::user();
           if ($user){
               $success['token']=$user->createToken(rand(0, 10000000000))->plainTextToken;;
               $success['user']=$user;
               return response()->json(['status'=>true,'success'=>$success],200);
           }else{
               return response()->json(['status'=>false, 'success'=>"Something went wrong"],500);
           }
       }
       else{
           return response()->json(['status'=>false, 'success'=>"Your credential is wrong"],400);
       }
    }
}
