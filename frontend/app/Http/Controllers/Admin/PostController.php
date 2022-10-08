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
        $tmp_id = Uuid::generate(4)->string;
        if ($id) {
            $res_edit = ApiH::apiGetVar('/a/posts/detail/'. urlencode($id));
            if (!$res_edit->data->uuid_tmp_id) {
                $res_edit->data->uuid_tmp_id = $tmp_id;
            }
            return view('admin.admpostedit', [
                'res_edit' => $res_edit
            ]);
        }else{
            return view('admin.admpostcreate',[
                'tmp_id' => $tmp_id
            ]);
        }
    }

    public function indexAttachList(Request $req) {
        $id = $req->input('uniq');
        $res_attach = ApiH::apiGetVar('/a/posts/detail/attach/'. urlencode($id));
        return response()->json([
            'code' => 200,
            'data' => $res_attach,
        ]);
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
                'tmp_id' => 'required',
            ],[
                'title.required' => 'Mohon input Judul.',
                'title.max' => 'Judul tidak lebih dari 255 karakter.',
                'description.required' => 'Deskripsi harus di isi.',
                'description.max' => 'Deskripsi tidak kurang dari 255 karakter.',
                'body.required' => 'Bodi konten harus di isi.',
                'body.min' => 'Bodi konten harus lebih dari 100 karakter.',
                'tmp_id.required' => 'Temporary id dibutuhkan.'
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
            $res = 'null';
            $resImg = 'null';
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
                $banerName = $req->input('baner_name');
                $banerExt = $req->input('baner_ext');
                if ($baner) {
                    $resImg = ApiH::file_create($baner,'postbaner',$banerName,$banerName .'.'. $banerExt);
                    $res = $this->post_update($req,$id, $c,$resImg);
                } else {
                    $res = $this->post_update($req,$id, $c,null);
                    $resImg = [
                        'baner_id' => $banerName,
                        'ext' => $banerExt,
                        'mimes' => 'none'
                    ];
                }
                $this->post_update_body($req,$id,$c);
            }

            return response()->json([
                'code' => 200,
                'msg' => $resBody,
                //  'msg' => $req->input('tmp_id'),
                'data' => $res,
                'dataBaner' => $resImg
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
                'tmp_id' => $req->input('tmp_id'),
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
                '_csrf' => ApiH::csrf(),
                'tmp_id' => $req->input('tmp_id'),
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
                'tmp_id' => $req->input('tmp_id')
            ];
        }else{
            $body = [
                'id' => $id,
                'title' => urlencode($req->input('title')),
                'description' => urlencode($req->input('description')),
                'category' => (int)$req->input('category'),
                'status' => (int)$req->input('status'),
                'isbaner' => 0,
                '_csrf' => ApiH::csrf(),
                'tmp_id' => $req->input('tmp_id')
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

    public function tmpattachsave(Request $req) {
        $validator = Validator::make($req->all(), [
            'tmp_id' => 'required',
            'imgattach' => 'required|mimes:jpg,png|max:5000'
        ],[
            'tmp_id.required' => 'Temporary id dibutuhkan.',
            'imgattach.required' => 'Lampiran dibutuhkan.',
            'imgattach.mimes' => 'Format lampiran hanya diperbolehkan *.jpg & *.png.',
            'imgattach.max' => 'Ukuran lampiran maksimal 5mb.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 404,
                'msg' => $validator->messages()->first(),
            ]);
        }
        $tmp_id = $req->input('tmp_id');
        $attachFile = $req->file('imgattach');
        
        $uuidChk = Validator::make(['uuid' => $tmp_id], ['uuid' => 'uuid']);
        if ($uuidChk->passes() == false) {
            return response()->json([
                'code' => 404,
                'msg' => 'Temporary id Invalid.',
            ]);
        };

        $imgId = Uuid::generate(4)->string;
        $folder = 'postattachment';
        $resImg = ApiH::file_create($attachFile,$folder,$imgId);
        
        $body = [
            'id' => $tmp_id,
            'name' => $imgId,
            'bmimes' => $resImg['mimes'],
            'bext' => $resImg['ext'],
            'bfolder' => $folder,
            '_csrf' => ApiH::csrf()
        ];

        $resBody = 'Lampiran berhasil tersimpan.';

        $update = ApiH::apiPostVar('/a/posts/tmpattach_save', $body);
        $res = $update->object();
        
        if (isset($res->error)) {
            if ($res->error == "Unauthorized") { // Check Auth
                return 'Sesi login telah habis, mohon untuk login kembali.';
            } else {
                if (is_string($res->error)) {
                    return ['msg' => $res->error];
                } else {
                    return '$createPost->body()1';
                }
            }
        }

        // if (!isset($res->msg)) {
        //     return $res->msg;
        // } else {
        //     return '$res->data'; //sukses
        // }
        return response()->json([
            'code' => 200,
            'msg' => $resBody,
            'data' => $res->data,
        ]);
    }

    public function attachdelete(Request $req) {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'file_name' => 'required',
            'tmp_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 404,
                'msg' => $validator->messages()->first(),
            ]);
        }
        $id = $req->input('id');
        $tmp_id = $req->input('tmp_id');
        $filename = $req->input('file_name');
        
        $uuidChk = Validator::make(['uuid' => $tmp_id], ['uuid' => 'uuid']);
        if ($uuidChk->passes() == false) {
            $tmp_id = '';
        };

        $body = [
            'id' => $id,
            'file_name' => $filename,
            'tmp_id' => $tmp_id,
            '_csrf' => ApiH::csrf()
        ];

        $resBody = 'Lampiran terhapus.';

        $res = ApiH::apiPostVar('/a/posts/attach_delete', $body);
        $res = $res->object();
        
        if (isset($res->error)) {
            if (is_string($res->error)) {
                return ['msg' => $res->error];
            }
        }
        return response()->json([
            'code' => 200,
            'msg' => $resBody,
            'data' => $res,
        ]);
    }
}
