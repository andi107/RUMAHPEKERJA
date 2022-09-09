<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiH;
class CategoryController extends Controller
{
    public function index(Request $req) {
        $page = 1;
        $perPage = 10;
        $url = '/a/category';
        $search = "";

        // Check Search
        if ($req->has('filter')) {
            $search = $req->input('filter');
            if ($search != "") {
                $url = '/a/category/search/' . urlencode($search);
            }
        }

        // Check Page
        if ($req->has('page')) {
            $url = $url . '?page=' . $req->input('page');
            $page = $req->input('page');
        }
        $firstrow = (($page * $perPage) - $perPage) + 1;

        //Get Cargo List
        $res = ApiH::apiGetVar($url);
        if ($res == null) {
            return redirect()->route('adm.login');
        }
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return redirect()->route('adm.login');
            } else {
                return view('admin.admcategory')->with('error', $res->error);
            }
        }

        $res = ApiH::fixPagination(route('admin.admcategory'), $res->data);

        return view('admin.admcategory', ['cargoList' => $res, 'firstrow' => $firstrow, 'qsearch' => $search]);

    }
}
