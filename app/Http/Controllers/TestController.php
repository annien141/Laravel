<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;
//header('Access-Control-Allow-Origin:*');

class TestController extends Controller
{
    public function test()
    {
        $users = DB::select("select * from ecgoods where `is_hot`=1 ");
        echo json_encode($users);
    }

    public function fenlei1()
    {
        $users = DB::select("select floor.fid,ecgoods.goods_name,floor.fname,ecgoods.goods_id from goods_floor join ecgoods on goods_floor.goods_id=ecgoods.goods_id join floor on goods_floor.floor_id=floor.fid");
        foreach($users as $k=>$v) {   //对象转数组
            $sellers[$k] = (array)$v;
        }
        $arr=[];
        foreach($sellers as $k1=>$v1) {   //对象转数组
            $arr[$v1['fid']][$v1['fname']][]=$v1;
        }
      //  var_dump($arr);die;
        echo json_encode($arr);
    }

    public function quanbufenlei()
    {
        $users = DB::select("select * from category");
        foreach($users as $k=>$v) {
            $sellers[$k] = (array)$v;
        }
        $list=$this->getTree($sellers);
        return  response()->json($list);
    }

    function getTree($arr,$pid=0,$lev=0){
        $list = array();
        foreach($arr as $v){
            if($v['parent_id']==$pid){
                $v['child'] = $this->getTree($arr,$v['cat_id'],$lev+1);
                $list[] = $v;
            }
        }
        return $list;
    }
    function huopin(Request $request){
        $id=$request->input('sp1');
        $users = DB::select("select * from ecgoods join huopin on ecgoods.goods_id=huopin.goods_id where huopin.goods_id=$id ");
        echo json_encode($users);
    }

    function price(Request $request){
        $shuxing=$request->input('shuxing');
        $users = DB::select("select * from huopin where shuxing='$shuxing'");
        echo json_encode($users);
    }
    function price1(Request $request){
        $id=$request->input('sp1');
        $users = DB::select("select * from huopin where goods_id='$id'");
        foreach($users as $k=>$v) {
            $sellers[$k] = (array)$v;
        }
        $max=max($sellers);
        $min=min($sellers);
        $newarr[]=$min;
        $newarr[]=$max;
        echo json_encode($newarr);
    }
}