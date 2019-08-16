<?php

namespace App\Http\Controllers;

use Yansongda\Pay\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    protected $config = [
        'alipay' => [
            'app_id' => '2016101000654198',
            'notify_url' => 'http://localhost/laravel/blog/public/api/pay/notify',
            'return_url' => 'http://localhost/laravel/blog/public/api/pay/return',
            'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmi8y0z7StHiWtL0jMUpI7PIQwiU9ZEzMMr6dIMYfdfVUZySsve+EvDFhQ6p9/Zkq83yUK2UblCe1tY6FrFNYXhcONpVjETFvgmW14tBLmQr0cjBwrjTk/VGHZrwL78VWr/v9YHU3NuQ2EknwoVYdxusLb84oSFXmcJv9SLipAwb4NduF97LvZLdLp6LCGdrly20EQI017rVUAtCNyjzd2YBp+t8D5vTPIhR18IPf0QRAUyXjZg/p4eJwPOxRTepwmybOwmXa5BoeYLSf+v/dOy7W3imnjRc0fhO9D3dXa3RRXv7RiWHy3nzKj2bUOl4O0/ZsGTuMF8KdBtAcQd3xLQIDAQAB',
            'private_key' => 'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCEV4whZDOgp1BDlDm6AhaMRxzJh99FneMgN6Ot48WwoS4EA8bGHCaxcYJS9GYPgVcd8VbuJ64PpMkmTroQ5PTFpCEyw18RibOk1vExkGeKBF83GWhUvZCRTgHAUa0LeAdR//wyK+zL5HIX1ALXg8BgrD+Dquit2STud9sskXOOaBlLoLUQi7L/hCHqdMPJpPf/+yV9UWjKtZkWgRlyN8oj2IU4X4oa5KBc93AoFJmr58cxzwZnpDPfAzLKDGKmRtI9NNWl00E7QH4CJj7ICXpPsdeVIrtEjGfy1Zr+AOiajoT8dw4NhPPuHXG9DcV29038eGqTfjAt6vLbAS3jWhHXAgMBAAECggEBAIL3gJ2q48ygxzWZgmcpmdbIqRxncfUbAqHnbfuv5PufBkLC2ftD8Ka5hhdB9Z5yiRwAsd6NNhwVH1rhnhEKA5Fzk8cAwRxCAZ2neJlsJorXOML2SeFSl7a0U9dW/MDUz6m+gn3EKlq8gIxEK2vL3p3M2C4c/JbOxVWZFzVL2+eYgM0X8si8yTx24ZPgAwN8afiHqhNO9rZ28a2x2IT+dMXmimomStDzsp8iYqfXLP6XvvKkzbhNuoEu/3CCgQLAaR0rHCjCgevQRHkdwAGERj5QG/nhJHregM5ooizn3cbY3Sp8U+k42U/J3/bT/I3tySFBcc5COoeL2HwcprO52kECgYEAu+h+/Th3vsXplVthwi7KQxM2aRtYw9xvxY51/k1iHu2crvrqAvsEt+AvmOQ6bogE3jgceoHISWTVbfjO48pxr0YrLVmWMhFnnplCr6mAtP/R6xdTkjxLQVoItJS6Y8tv53nD8dxVuBNA2kGaP5VMt7bEWkanBNbM+dEIpR0K2jMCgYEAtExkkYmkCPdytK7l8wim7e9Btb1aVmhENxvoWJk74PCXiYDwD6M+V8GBYlMAlFWKD21yQMEm9wST43MZfbOAloRk6V0zcvSZPhsKjZMqSpdPUhm4LaBybdEQ6n6VEsmJJHXPYOIYZKaWjbC9HfvFlvBu/cPnZag/GP7l/LHYTc0CgYEAp5x5ObIWzeqHspwylR1beX03uYWVJhAI+zVZ9p5b+a6FZmeWOVZjHQkyK7TYkiNuBDIU5QnC+ASjhFa9ZN79jRSQCwGwQbTYstWOcFZH4iuWuZazCuwRTJfc0AciQ0YB6X3p1GFvbKRv4r9FsZWhOvYiK0x+Soi3idZ1WaKQPZUCgYA3mX9B6kItibFTysOaqMZhhXCsDNJ45vpyTCbge5Cdk1QH0T02dU7aXQ/7NEFvfNlwXH3pPic38a9xaqMnwl0bDYTY+ibNgmRnZItikUlvay3I0amcWGgxOVGQHqz1+DRUjAgBhnejQkQXObN4NZX/L/HqS6lmDfY3TRO7U1Sy2QKBgQCjaJQyxrbrTXxSa5Dd9FCjamVBMBVyNf2QniiwxeR8GtF5JU4i2py0VfIOCLqUSbLwzF/Kgu5ukxsqV/qVHTu+fjEAPAvcFzG9bn28G9uZMNrbQ8aLUDuJ2iRUN00nwHxrINpTrzNJx4+6Q2X1b48Fzoqmpy1xUvc+R0/T9iTigA==',
        ],
    ];

    public function index(Request $request)
    {
        $config_biz = [
            'out_trade_no' => $request->input('oid'),
            'total_amount' => $request->input('price'),
            'subject'      => 'test',
            'goods_type' => '0',
        ];

        $pay = new Pay($this->config);

        return $pay->driver('alipay')->gateway()->pay($config_biz);
    }

    public function return(Request $request)
    {
        $pay = new Pay($this->config);

        $arr=$pay->driver('alipay')->gateway()->verify($request->all());
        $order_id=$arr['out_trade_no'];
        $total_price=$arr['total_amount'];
        $order_time=$arr['timestamp'];
        header("location:http://localhost:8081/#/Car3?o_id=$order_id&total_price=$total_price&order_time=$order_time");
    }

    public function notify(Request $request)
    {
        $pay = new Pay($this->config);

        if ($pay->driver('alipay')->gateway()->verify($request->all())) {
            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况
            $dingdanhao= $request->out_trade_no;
            file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单号：' . $request->out_trade_no . "\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单金额：' . $request->total_amount . "\r\n\r\n", FILE_APPEND);
            
            DB::update("update dingdan set status=1 where dingdanhao='$dingdanhao'");
        } else {
            file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
        }

        echo "success";
    }
}