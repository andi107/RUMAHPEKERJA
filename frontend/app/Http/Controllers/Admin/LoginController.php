<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiH;

class LoginController extends Controller
{
    public function __construct()
    {
        if (Cookie::get('API_TOKEN')) {
            abort(404);
        }
    }

    public function index() {
        return view('admin.admlogin');
    }

    public function go(Request $request) {
        // dd('submitlogn',$request->all());
        // $remember = 0;
        // if ($request->has('remember')) {
        //     $remember = 1;
        // }

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
