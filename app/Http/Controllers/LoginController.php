<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session\Middleware\StartSession;

class LoginController extends Controller
{
    public function login_action(Request $request)
    {
        $name=$request->input('name');
        $password=$request->input('password');
//        echo "$name";
        $users = DB::select("select * from users where name = '$name' and password='$password'");
        if (!empty($users)){
          //  $value = $request->session()->put('name', $name);
         //   $name = $request->session()->get('name', $name);
            $arr5 = ['code' => '0', 'status' => 'ok', 'data' => "登录成功"];
            echo json_encode($arr5);
        } else{
            $arr5 = ['code' => '0', 'status' => 'error', 'data' => "登录失败"];
            echo json_encode($arr5);
        }
    }
    public function md(){
        $hashed = Hash::make("aaa");
        echo $hashed;
    }

}