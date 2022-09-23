<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiH;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{

    public function indexList(Request $req) {
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

        $page = 1;
        $perPage = 10;
        $url = '/a/posts';
        $search = "";

        if ($req->has('filter')) {
            $search = $req->input('filter');
            if ($search != "") {
                $url = '/a/posts/?s=' . urlencode($search);
            }
        }

        if ($req->has('page')) {
            $url = $url . '?page=' . $req->input('page');
            $page = $req->input('page');
        }
        $firstrow = (($page * $perPage) - $perPage) + 1;

        $res = ApiH::apiGetVar($url);
        if (isset($res->error)) {
            if (!$res->error == "Unauthorized") {
                return view('admin.admpostlist')->with('error', $res->error); 
            }
        }
        $res = ApiH::fixPagination(route('adm.post-list-index'), $res->data);
        $hlp = ApiH::class;
        return view('admin.admpostlist', ['hlp' => $hlp,'res' => $res, 'firstrow' => $firstrow, 'qsearch' => $search]);
    }

    public function index(Request $req) {
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
        return view('admin.admpostcreate');
    }

    public function create_update(Request $req) {
        // try {
        
            $id = $req->input('type');

            $validator = Validator::make($req->all(), [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'body' => 'required|min:100',
                'category' => 'required|numeric',
                'status' => 'required|numeric',
            ],[
                'title.required' => 'Mohon input Judul.',
                'title.max' => 'Judul tidak lebih dari 255 karakter.',
                'description.required' => 'Deskripsi harus di isi.',
                'description.max' => 'Deskripsi tidak kurang dari 255 karakter.',
                'body.required' => 'Bodi konten harus di isi.',
                'body.min' => 'Bodi konten harus lebih dari 100 karakter.'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'code' => 404,
                    'msg' => $validator->messages()->first(),
                ]);
            }
            $resBody = 'Data berhasil tersimpan.';
            if ($id == 'new') {
                $res = $this->post_new($req);
            }else{
                $c = ApiH::csrf();
                $res = $this->post_update($req,$id,$c);
                $this->post_update_body($req,$id,$c);
            }

            return response()->json([
                'code' => 200,
                'msg' => $resBody,
                'data' => $res
            ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'code' => 404,
        //         'msg' => 'Gagal menyimpan data.',
        //     ]);
        // }
    }

    function post_new($req) {
        $body = [
            'title' => urlencode($req->input('title')),
            'description' => urlencode($req->input('description')),
            'body' => $req->input('body'),
            'category' => (int)$req->input('category'),
            'status' => (int)$req->input('status'),
            '_csrf' => ApiH::csrf()
        ];

        $createPost = ApiH::apiPostVar('/a/posts/create/save', $body);
        $res = $createPost->object();

        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return 'Sesi login telah habis, mohon untuk login kembali.';
            } else {
                if (is_string($res->error)) {
                    return ['msg' => $res->error, 'id' => 'new'];
                } else {
                    return '$createPost->body()1';
                }
            }
        }

        if (!isset($res->msg)) {
            return $res->data;
        } else {
            return '$res->data'; //sukses
        }
    }

    function post_update($req,$id, $csrf) {
        
        $body = [
            'id' => $id,
            'title' => urlencode($req->input('title')),
            'description' => urlencode($req->input('description')),
            'category' => (int)$req->input('category'),
            'status' => (int)$req->input('status'),
            '_csrf' => $csrf
        ];

        $update = ApiH::apiPutVar('/a/posts/update', $body);
        $res = $update->object();

        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return 'Sesi login telah habis, mohon untuk login kembali.';
            } else {
                if (is_string($res->error)) {
                    return ['msg' => $res->error, 'id' => $id];
                } else {
                    return '$createPost->body()1';
                }
            }
        }

        if (!isset($res->msg)) {
            return $res->data;
        } else {
            return '$res->data'; //sukses
        }
    }

    function post_update_body($req,$id,$csrf) {
        
        $body = [
            'id' => $id,
            'body' => urlencode($req->input('body')),
            '_csrf' => $csrf
        ];

        $update = ApiH::apiPutVar('/a/posts/update_body', $body);
        $res = $update->object();
        
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return 'Sesi login telah habis, mohon untuk login kembali.';
            } else {
                if (is_string($res->error)) {
                    return '$res->error';
                } else {
                    return '$createPost->body()1';
                }
            }
        }

        if (!isset($res->msg)) {
            return '$res->data1';
        } else {
            return '$res->data'; //sukses
        }
    }

}
