<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use App\Helpers\ApiH;
class DashboardController extends Controller
{

    public function index() {
        // $res = ApiH::apiGetVar('/a/dashboard');
        // if (!isset($res->data)) {
        //     if ($res == "Unauthorized.") { // Check Auth
        //         return redirect()->route('adm.login');
        //     } else {
        //         if ($res == null) {
        //             return redirect()->route('adm.login');
        //         } else {
        //             return redirect(url()->previous())->with('error', $res);
        //         }
        //     }
        // }


        return view('admin.admhome');
    }
}
