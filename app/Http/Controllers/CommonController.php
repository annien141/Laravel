<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Session\Middleware\StartSession;

class CommonController extends Controller{
    public function __construct()
    {
        $this->request = request();
        // 验证是否登录
        $this->middleware(function ($request, $next) {
            if (!\Session::get('name')) {
                return redirect('login/index');
            }
            return $next($request);
        });

    }
}