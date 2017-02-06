<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\User;



class UsersController extends Controller
{
    public function index(Request $request){
        $id = $request->id;
        $param = user::where('id',$id)->first();
       // dd($param);
        return view('/users',compact('param'));
    }
}