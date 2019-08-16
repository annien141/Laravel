<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;

class CarController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    function jia(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $cid=$request->input('cid');
        $num2=$request->input('num2');
        $car=DB::select("update `car` set `num`=$num2 where user_id='$id' and cid=$cid");
        echo json_encode($car);
    }
    function selectnum(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $cid=$request->input('cid');
        DB::select("update `car` set `buy`=0 where user_id='$id' and cid=$cid");
        $car=DB::select("select * from car where user_id='$id' and cid=$cid");
        echo json_encode($car);
    }
    function buy(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $cid=$request->input('cid');
        $car=DB::select("update `car` set `buy`=1 where user_id='$id' and cid=$cid");
        echo json_encode($car);
    }
    function car(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $shangpin=$request->input('shangpin');
        $gid=$request->input('gid');
        $num=$request->input('num');

        $car=DB::select("select * from car where user_id='$id' and goods_id=$gid and shuxing='$shangpin'");
        if(empty($car)){
            $users = DB::insert("insert into car(`user_id`,`goods_id`,`shuxing`,`num`,`buy`) values('$id',$gid,'$shangpin',$num,0)");
            echo json_encode($users);
        }else{
            $users = DB::update("update `car` set `num`=num+$num where user_id='$id' and goods_id=$gid and shuxing='$shangpin'");
            return response()->json(['code'=>'1','status'=>'error','data'=>"已添加"]);
        }
    }

    function showcar(Request $request){
        $a=auth()->user();
        $id=$a->id;
        DB::select("update `car` set `buy`=0");
        $users=DB::select("select * from car join ecgoods on ecgoods.goods_id=car.goods_id join huopin on huopin.goods_id=car.goods_id and car.shuxing=huopin.shuxing where user_id='$id'");
        echo json_encode($users);
    }
}