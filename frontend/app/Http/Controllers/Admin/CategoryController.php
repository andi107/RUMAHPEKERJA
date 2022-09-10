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

        if ($req->has('filter')) {
            $search = $req->input('filter');
            if ($search != "") {
                $url = '/a/category?s=' . urlencode($search);
            }
        }

        if ($req->has('page')) {
            $url = $url . '?page=' . $req->input('page');
            $page = $req->input('page');
        }
        $firstrow = (($page * $perPage) - $perPage) + 1;

        $res = ApiH::apiGetVar($url);
        if ($res == null) {
            return redirect()->route('adm.login');
        }
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") {
                return redirect()->route('adm.login');
            } else {
                return view('admin.admcategory')->with('error', $res->error);
            }
        }
        $res = ApiH::fixPagination(route('adm.category'), $res->data);
        $hlp = ApiH::class;
        return view('admin.admcategory', ['hlp' => $hlp,'res' => $res, 'firstrow' => $firstrow, 'qsearch' => $search]);

    }

    public function create(Request $request) {
        
        $request->validate([
            'txtKategoriName' => 'required|max:100',
            'txtDescription' => 'max:255',
            'selStatus' => 'required',
        ]);
        
        // Params
        $body = [
            'name' => $request->txtKategoriName,
            'description' => $request->txtDescription,
            'status' => (int)$request->selStatus,
            '_csrf'  => ApiH::csrf()
        ];

        // Post Create
        $createPost = ApiH::apiPostVar('/a/category/create', $body);
        $res = $createPost->object();

        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return redirect()->route('adm.login');
            } else {
                if (is_string($res->error)) {
                    return redirect(url()->previous())->with('error', $res->error);
                } else {
                    return redirect(url()->previous())->with('error', $createPost->body());
                }
            }
        }

        if (!isset($res->msg)) {
            return redirect(url()->previous())->with('error', $createPost->body());
        } else {
            return redirect(url()->previous())->with('success', $res->msg);
        }
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'txtKategoriName' => 'required|max:100',
            'txtDescription' => 'max:255',
            'selStatus' => 'required',
        ]);

        // Params
        $body = [
            'id' => $id,
            'name' => $request->txtKategoriName,
            'description' => $request->txtDescription,
            'status' => (int)$request->selStatus,
            '_csrf'  => ApiH::csrf()
        ];


        // Post Update
        $updatePost = ApiH::apiPutVar('/a/category/update', $body);
        $res = $updatePost->object();
        
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return redirect()->route('adm.login');
            } else {
                if (is_string($res->error)) {
                    return redirect(url()->previous())->with('error', $res->error);
                } else {
                    return redirect(url()->previous())->with('error', $updatePost->body());
                }
            }
        }

        if (!isset($res->msg)) {
            return redirect(url()->previous())->with('error', $updatePost->body());
        } else {
            return redirect(url()->previous())->with('success', $res->msg);
        }
    }
}
