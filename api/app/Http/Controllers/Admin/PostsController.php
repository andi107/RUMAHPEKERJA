<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

    public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'body' => 'required',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $body = $request->input('body');
        $category = $request->input('category');
        $status = $request->input('status');
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $ckName = DB::table('posts')
            ->where('fttitle','=', $title)
            ->first();
            if ($ckName) {
                DB::rollback();
                return response()->json([
                    'error' => $title.' sudah ada.',
                ], 404);
            }

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
                'updated_at' => $dtnow
            ]);
            $data = DB::table('posts')
            ->selectRaw('id,fttitle, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->where('id','=', $save)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data
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
            'id' => 'required|numeric',
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'category' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $id = $request->input('id');
        $title = urldecode($request->input('title'));
        $description = urldecode($request->input('description'));
        $category = $request->input('category');
        $status = $request->input('status');
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $ckData = DB::table('posts')
            ->where('id','=',$id)
            ->first();
            $ckName = DB::table('posts')
            ->where('id','<>',$id)
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

            DB::table('posts')
            ->where('id','=',$id)
            ->update([
                'fttitle' => $title,
                'ftdescription' => $description,
                'fncategory' => $category,
                'fnstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'updated_at' => $dtnow
            ]);
            $data = DB::table('posts')
            ->selectRaw('id,fttitle, ftdescription, ftuniq, fncategory, fnstatus, fnupdated_by, fncreated_by, created_at, updated_at')
            ->where('id','=', $id)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data
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
            'id' => 'required|numeric',
            'body' => 'required',
        ]);
        $id = $request->input('id');
        $body = $request->input('body');

        try {
            $dtnow = Carbon::now();

            $ckData = DB::table('posts')
            ->where('id','=',$id)
            ->first();
            if (!$ckData) {
                DB::rollback();
                return response()->json([
                    'error' => 'Data tidak ada.',
                ], 404);
            }

            $getUniq = $this->getRandString();
            DB::table('posts')
            ->where('id','=',$id)
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