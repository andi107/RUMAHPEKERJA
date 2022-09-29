<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use App\Helpers\ApiH;
class DashboardController extends Controller
{
    public function index() {
        //=== Check ===
        $res = ApiH::apiGetVar('/chk');
        if ($res == null) {
            return redirect()->route('adm.login');
        }
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") {
                return redirect()->route('adm.login');
            }
        }
        //=== End Check ===
        return view('admin.admhome');
    }

    public function go_logout() {
        
        //=== Check ===
        $res = ApiH::apiGetVar('/logout');
        if ($res == null) {
            return redirect()->route('adm.login');
        }
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") {
                return redirect()->route('adm.login');
            }
        }
        //=== End Check ===
        // Cookie::forget('API_TOKEN');
        // Cookie::forget('USERNAME');
        // Cookie::forget('EXPIRES_IN');
        // Cookie::forget('USRID');
        return redirect()->route('adm.login');
    }
}
