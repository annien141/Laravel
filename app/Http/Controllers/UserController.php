<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;

class UserController extends CommonController
{


    public function show(Request $request)
    {
        $name=$request->session()->get('name');
        $users = DB::select("select * from users order by id");
        $arr=['data'=>$users,'data1'=>$name];
        echo json_encode($arr);
    }
    public function del(Request $request)
    {
        $id=$request->input('id');
        DB::delete("delete from users where id='$id'");
    }

    public function add(Request $request)
    {
        $name=$request->input('name');
        $password=$request->input('password');
        DB::insert("insert into users(`name`,`password`) values('$name','$password')");
    }
    public function up(Request $request)
    {
        $id=$request->input('id');
        $name=$request->input('name');
        $password=$request->input('password');
        DB::update("update users set name='$name',password='$password' where id='$id'");
    }

    public function logout(Request $request){
        $value = $request->session()->pull('name');
    }

    public function login(Request $request)
    {
        $name=$request->session()->get('name');
        return view('index.ok');
    }

    public function test(){

    }
}