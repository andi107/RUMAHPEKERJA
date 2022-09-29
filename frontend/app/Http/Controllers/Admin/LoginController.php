<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiH;

class LoginController extends Controller
{
    public function index() {
        //=== Check ===
        $res = ApiH::apiGetVar('/chk');
        if ($res == null) {
            return view('admin.admlogin');
        }
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") {
                return view('admin.admlogin');
            }
        }
        //=== End Check ===
        abort(404);
    }

    function isvalidate($req) {
        $data = array(
            'secret' => "my-secret (should start with 0x..)",
            'response' => $req->input('h-captcha-response')
        );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        // var_dump($response);
        return json_decode($response);
        
    }

    public function go(Request $request) {
        // dd('submitlogn',$request->all());
        // $remember = 0;
        // if ($request->has('remember')) {
        //     $remember = 1;
        // }
        $resCapcha = $this->isvalidate($request);
        if(!$resCapcha->success) {
            dd('return error to user; they did not pass');
            return redirect()->route('adm.login');
        }
        dd('OKOK');
        
        $response = Http::withToken(null)
            ->acceptJson()
            ->post(env('APP_API') . '/a/auth', [
                'username' => $request->txtusername,
                'password' => $request->txtpassword,
                'remember' => 1,
                '_csrf'  => ApiH::csrf($request->txtpassword),
            ]);

        $res = $response->object();
        
        switch ($response->status()) {
            case 422:
                return view('admin.admlogin', ['errLogin' => 'Username atau Password salah!']);
                break;
            case 404;
                return view('admin.admlogin', ['errLogin' => 'Username atau Password salah!']);
            default:
                break;
        }

        if (isset($res->error)) {
            return view('admin.admlogin', ['errLogin' => 'Username atau Password salah!']);
        }

        return redirect()->route('adm.dashboard')
        ->cookie('USERNAME', $res->username, $res->expires_in_minute)
        ->cookie('API_TOKEN', $res->access_token, $res->expires_in_minute)
        ->cookie('EXPIRES_IN', $res->expires_in_minute, $res->expires_in_minute)
        ->cookie('USRID', $res->uid, $res->expires_in_minute);
    }
}
