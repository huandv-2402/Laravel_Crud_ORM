<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestPostAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index(){
        return view("admin/login");
    }

    public function login(RequestPostAdmin $request){

        $requestData = $request->validated();

        $remember = $request->has("remember");

        if(Auth::attempt($requestData,$remember) && Auth::user()->role == 1){
            return redirect(route("admin."));
        }

        return redirect(route("admin.login.get"))->with(["status"=>false,"email" => $requestData["email"]]);

    }

    public function logout(){
        Auth::logout();
        return redirect(route("admin.login.get"));
    }
}
