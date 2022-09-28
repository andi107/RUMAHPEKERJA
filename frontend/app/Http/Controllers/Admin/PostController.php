<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiH;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
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
        $id = $req->input('edit');
        if ($id) {
            $res_edit = ApiH::apiGetVar('/a/posts/detail/'. urlencode($id));
            // dd($res_edit);
            return view('admin.admpostedit', [
                'res_edit' => $res_edit
            ]);
        }else{
            return view('admin.admpostcreate');
        }
        
    }

    public function create_update(Request $req) {
        try {
        
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
            
            $baner = $req->file('mybaner');
            if ($baner) {
                $validator = Validator::make($req->all(), [
                    'mybaner' => 'mimes:jpg,png|max:5000'
                ],[
                    'mybaner.mimes' => 'Format Baner hanya diperbolehkan *.jpg & *.png.',
                    'mybaner.max' => 'Ukuran Baner maksimal 5mb.'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'code' => 404,
                        'msg' => $validator->messages()->first(),
                    ]);
                }
            }

            if ($id == 'new') {
                $photoId = Uuid::generate(4)->string;
                if ($baner) {
                    $resImg = ApiH::file_create($baner,'postbaner',$photoId);
                    $res = $this->post_new($req,$photoId,$resImg);
                }else{
                    $res = $this->post_new($req,$photoId,null);
                }
            } else {
                $c = ApiH::csrf();
                $res = 'null';
                if ($baner) {
                    $banerName = $req->input('baner_name');
                    $banerExt = $req->input('baner_ext');
                    $resImg = ApiH::file_create($baner,'postbaner',$banerName,$banerName .'.'. $banerExt);
                    $res = $this->post_update($req,$id, $c,$resImg);
                } else {
                    $res = $this->post_update($req,$id, $c,null);
                    // $res = $req->all();
                }
                $this->post_update_body($req,$id,$c);
            }

            return response()->json([
                'code' => 200,
                'msg' => $resBody,
                // 'msg' => $banerName,
                'data' => $res
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 404,
                'msg' => 'Gagal menyimpan data.',
            ]);
        }
    }

    function post_new($req,$baner_id,$valid) {
        if ($valid) {
            $body = [
                'title' => urlencode($req->input('title')),
                'description' => urlencode($req->input('description')),
                'body' => $req->input('body'),
                'category' => (int)$req->input('category'),
                'status' => (int)$req->input('status'),
                '_csrf' => ApiH::csrf(),
                'baner_id' => $baner_id,
                'isbaner' => 1,
                'bfolder' => 'postbaner',
                'bmimes' => $valid['mimes'],
                'bext' => $valid['ext'],
            ];
        }else{
            $body = [
                'title' => urlencode($req->input('title')),
                'description' => urlencode($req->input('description')),
                'body' => $req->input('body'),
                'category' => (int)$req->input('category'),
                'status' => (int)$req->input('status'),
                'baner_id' => $baner_id,
                'isbaner' => 0,
                '_csrf' => ApiH::csrf()
            ];
        }
        

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

    function post_update($req,$id, $csrf,$valid) {
        // $body = [
        //     'id' => $id,
        //     'title' => urlencode($req->input('title')),
        //     'description' => urlencode($req->input('description')),
        //     'category' => (int)$req->input('category'),
        //     'status' => (int)$req->input('status'),
        //     '_csrf' => $csrf
        // ];

        if ($valid) {
            $body = [
                'id' => $id,
                'title' => urlencode($req->input('title')),
                'description' => urlencode($req->input('description')),
                'category' => (int)$req->input('category'),
                'status' => (int)$req->input('status'),
                '_csrf' => ApiH::csrf(),
                'isbaner' => 1,
                'bfolder' => 'postbaner',
                'bmimes' => $valid['mimes'],
                'bext' => $valid['ext'],
            ];
        }else{
            $body = [
                'id' => $id,
                'title' => urlencode($req->input('title')),
                'description' => urlencode($req->input('description')),
                'category' => (int)$req->input('category'),
                'status' => (int)$req->input('status'),
                'isbaner' => 0,
                '_csrf' => ApiH::csrf()
            ];
        }
        
        $update = ApiH::apiPostVar('/a/posts/update', $body);
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

        $update = ApiH::apiPostVar('/a/posts/update_body', $body);
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
