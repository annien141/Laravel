<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['area']]);
    }
    function shezhi(Request $request){
        $a=auth()->user();
        $uid=$a->id;
        $id=$request->input('id');
        $area=DB::update("update address set moren=1 where uid=$uid and moren=0");
        $area1=DB::update("update address set moren=0 where id=$id");
        echo json_encode($area);
    }
    function area(Request $request){
        $pid=$request->input('pid');
        $area=DB::select("select * from `area` where parent_id=$pid");
        echo json_encode($area);
    }
    function address(){
        $a=auth()->user();
        $id=$a->id;
        $area=DB::select("select * from `address` where uid='$id' and moren=0");
        echo json_encode($area);
    }
    function alladdress(){
        $a=auth()->user();
        $id=$a->id;
        $area=DB::select("select * from `address` where uid='$id'");
        echo json_encode($area);
    }
    function addAddress(Request $request){
        // header('Access-Control-Allow-Origin:*');
        $a=auth()->user();
        $id=$a->id;

        $name=$request->input('name');
        $area=$request->input('area');
        $address=$request->input('address');
        $phone=$request->input('phone');
        $tel=$request->input('tel');
        $jianzhu=$request->input('jianzhu');
        $email=$request->input('email');
        $youbian=$request->input('youbian');
        $arr1=$request->input('arr1');
        if(empty($name)||empty($address)||empty($email)||empty($phone)){
            $users=['code'=>1,'status'=>'error','data'=>'必填项不能为空'];
            return response()->json($users);
        }
        if(count($arr1)!=3){
            $users=['code'=>1,'status'=>'error','data'=>'必须填写配送地区'];
            return response()->json($users);
        }
        $area= $arr1[0]."-".$arr1[1]."-".$arr1[2];
        $area5=DB::select("select * from `address` where uid='$id'");
        if (empty($area5)){
            $moren=0;
        } else{
            $moren=1;
        }
        $users=DB::insert("insert into `address`(`uid`,`name`,`tel`,`phone`,`address`,`jianzhu`,`email`,`youbian`,`area`,`moren`)values($id,'$name','$tel','$phone','$address','$jianzhu','$email','$youbian','$area',$moren)");
        echo json_encode($users);
    }

    function update(Request $request){
        $a=auth()->user();
        $id=$a->id;

        $name=$request->input('name');
        $address=$request->input('address');
        $phone=$request->input('phone');
        $tel=$request->input('tel');
        $jianzhu=$request->input('jianzhu');
        $email=$request->input('email');
        $youbian=$request->input('youbian');
        $arr1=$request->input('arr1');
        $area= $arr1[0]."-".$arr1[1]."-".$arr1[2];
        $users=DB::update("update address set name='$name',area='$area',address='$address',phone='$phone',tel='$tel',jianzhu='$jianzhu',email='$email',youbian='$youbian' where uid=$id and moren=0");
        $area=DB::select("select * from `address` where uid='$id'");
        echo json_encode($area);
    }
}