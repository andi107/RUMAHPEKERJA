<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $search = urldecode($request->input('s'));

        if ($search) {
            $data = DB::table('posts')
            ->selectRaw('id, fttitle, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->where('fttitle','like', '%'. $search .'%')
            ->orderBy('fttitle','asc')
            ->paginate(10);
        }else{
            $data = DB::table('posts')
            ->selectRaw('id, fttitle, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->orderBy('fttitle','asc')
            ->paginate(10);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function detail($uniq) {
        $uniq = urldecode($uniq);

        $data = DB::table('posts')
        ->where('ftuniq','=',$uniq)
        ->first();
        if ($data) {
            $banerData = DB::table('galery')
            ->where('fncontent_id','=', $data->id)
            ->first();
        } else {
            $banerData = null;
        }

        return response()->json([
            'data' => $data,
            'banerdata' => $banerData
        ], 200);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'body' => 'required',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'baner_id' => 'required',
            'isbaner' => 'required|numeric'
        ]);
        $title = urldecode($request->input('title'));
        $description = urldecode($request->input('description'));
        $body = urldecode($request->input('body'));
        $category = $request->input('category');
        $status = $request->input('status');
        $baner_id = $request->input('baner_id');
        $isbaner = $request->input('isbaner');
        if ($isbaner == 1) {
            $this->validate($request, [
                'bfolder' => 'required',
                'bmimes' => 'required',
                'bext' => 'required',
            ]);
            $bfolder = $request->input('bfolder');
            $bmimes = $request->input('bmimes');
            $bext = $request->input('bext');
        }else{
            $bfolder = 'na';
            $bmimes = 'na';
            $bext = 'na';
        }
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $uuidChk = Validator::make(['uuid' => $baner_id], ['uuid' => 'uuid']);
            if ($uuidChk->passes() == false) { return response()->json([ 'error' => 'Invalid '. $baner_id ], 404); };

            $ckName = DB::table('posts')
            ->where('fttitle','=', $title)
            ->first();
            if ($ckName) {
                DB::rollback();
                return response()->json([
                    'error' => $title.' sudah ada.',
                ], 404);
            }

            $resTitle = urlencode(str_replace(' ','-', $title));

            $getUniq = $this->getRandString();
            $save = DB::table('posts')
            ->insertGetId([
                'fttitle' => $title,
                'ftdescription' => $description,
                'ftbody' => $body,
                'ftuniq' => $getUniq,
                'fncategory' => $category,
                'fnstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'fncreated_by' => Auth::id(),
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'fttitle_url' => $resTitle
            ]);
            $data = [
                'name' => $baner_id,
                'folder' => $bfolder,
                'mimes' => $bmimes,
                'ext' => $bext,
                'content_id' => $save,
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'type' => 'baner'
            ];
            $this->saveGalery($data);
            $data = DB::table('posts')
            ->selectRaw('id,fttitle,fttitle_url, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->where('id','=', $save)
            ->first();
            $dataBaner = DB::table('galery')
            ->where('fncontent_id','=', $save)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data,
                'dataBaner' => $dataBaner
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
            'isbaner' => 'required|numeric'
        ]);
        
        $id = $request->input('id');
        $title = urldecode($request->input('title'));
        $description = urldecode($request->input('description'));
        $category = $request->input('category');
        $status = $request->input('status');
        $isbaner = $request->input('isbaner');
        if ($isbaner == 1) {
            $this->validate($request, [
                'bfolder' => 'required',
                'bmimes' => 'required',
                'bext' => 'required',
            ]);
            $bfolder = $request->input('bfolder');
            $bmimes = $request->input('bmimes');
            $bext = $request->input('bext');
        } else {
            $bfolder = 'na';
            $bmimes = 'na';
            $bext = 'na';
        }
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $ckData = DB::table('posts')
            ->where('ftuniq','=',$id)
            ->first();
            $ckName = DB::table('posts')
            ->where('ftuniq','<>',$id)
            ->where('fttitle','=', $title)
            ->first();
            if (!$ckData) {
                DB::rollback();
                return response()->json([
                    'error' => 'Data tidak ada.',
                ], 404);
            }else if ($ckName) {
                DB::rollback();
                return response()->json([
                    'error' => $title.' sudah ada.',
                ], 404);
            }
            
            $resTitle = urlencode(str_replace(' ','-', $title));

            DB::table('posts')
            ->where('ftuniq','=',$id)
            ->update([
                'fttitle' => $title,
                'ftdescription' => $description,
                'fncategory' => $category,
                'fnstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'updated_at' => $dtnow,
                'fttitle_url' => $resTitle
            ]);
            if ($isbaner == 1) {
                $data = [
                    'folder' => $bfolder,
                    'mimes' => $bmimes,
                    'ext' => $bext,
                    'content_id' => $ckData->id,
                    'updated_at' => $dtnow,
                    'type' => 'baner'
                ];
                $this->updateGalery($data);
            }
            $data = DB::table('posts')
            ->selectRaw('id,fttitle,fttitle_url, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->where('ftuniq','=', $id)
            ->first();
            $dataBaner = DB::table('galery')
            ->where('fncontent_id','=', $ckData->id)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data,
                'dataBaner' => $dataBaner
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function update_body(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'body' => 'required',
        ]);
        $id = $request->input('id');
        $body = urldecode($request->input('body'));

        try {
            $dtnow = Carbon::now();

            $ckData = DB::table('posts')
            ->where('ftuniq','=',$id)
            ->first();
            if (!$ckData) {
                DB::rollback();
                return response()->json([
                    'error' => 'Data tidak ada.',
                ], 404);
            }

            DB::table('posts')
            ->where('ftuniq','=',$id)
            ->update([
                'ftbody' => $body,
            ]);

            DB::commit();
            return response()->json([
                'data' => 'OK'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }
}