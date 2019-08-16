<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;

class Car2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    function showcar(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $users=DB::select("select * from car join ecgoods on ecgoods.goods_id=car.goods_id join huopin on huopin.goods_id=car.goods_id and car.shuxing=huopin.shuxing where user_id='$id' and car.buy=0");
        echo json_encode($users);
    }
    function address(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $users=DB::select("select * from address where uid='$id' and moren=0");
        echo json_encode($users);
    }
    function jiesuan(Request $request){
        $a=auth()->user();
        $id=$a->id;
        $users1=[];
        $arr1= DB::select("select * from address where uid=$id and moren=0");
        foreach($arr1 as $k=>$v) {   //对象转数组
            $users1[$k] = (array)$v;
        }
        $area= $users1[0]['area'];
        $name1= $users1[0]['name'];
        $address= $users1[0]['address'];
        

        $huopin=[];
        $arr= DB::select("select * from car join ecgoods on ecgoods.goods_id=car.goods_id join huopin on huopin.goods_id=car.goods_id and car.shuxing=huopin.shuxing where user_id='$id' and car.buy=0");
        foreach($arr as $k=>$v) {   //对象转数组
            $huopin[$k] = (array)$v;
        }

        $date=date("Y-m-d h:i:s");
        $dingdanhao1=time();
        $dingdanhao2=rand(1000000, 9999999);
        $dingdanhao= $dingdanhao1.$dingdanhao2;
      //  var_dump($dingdanhao2);
        $name=[];
        $shuxing=[];
        $num=[];
        $price=[];
        $zongjia=0;
        for($i=0;$i<count($huopin);$i++){
            $name[]=$huopin[$i]['goods_name'];
            $shuxing[]=$huopin[$i]['shuxing'];
            $num[]=$huopin[$i]['num'];
            $price[]=$huopin[$i]['price'];
            $zongjia+=$huopin[$i]['num']*$huopin[$i]['price'];
        }
        $users0=DB::insert("insert into dingdan(`uid`,`status`,`name`,`time`,`area`,`address`,`dingdanhao`,`zongjia`) values('$id',0,'$name1','$date','$area','$address','$dingdanhao','$zongjia')");
        for($i=0;$i<count($name);$i++){
            $users=DB::insert("insert into dingdanxiangqing(`uid`,`huopin`,`shuxing`,`num`,`price`,`oid`) values('$id','$name[$i]','$shuxing[$i]','$num[$i]','$price[$i]','$dingdanhao')");
        }
        DB::delete("delete from car where user_id=$id and buy=0");
        $data=['zongjia'=>$zongjia,'dingdanhao'=>$dingdanhao];
        echo json_encode($data);
    }
}