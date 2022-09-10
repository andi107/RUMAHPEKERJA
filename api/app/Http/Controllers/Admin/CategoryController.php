<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CategoryController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $search = urldecode($request->input('s'));

        if ($search) {
            $data = DB::table('category')
            ->where('ftname','like', '%'. $search .'%')
            ->orderBy('ftname','asc')
            ->paginate(10);
        }else{
            $data = DB::table('category')
            ->orderBy('ftname','asc')
            ->paginate(10);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $request) {

        $this->validate($request, [
            // 'name' => 'required|max:100|regex:/^[a-z\d\-_\s]+$/i',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'status' => 'required|numeric',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $status = $request->input('status');
        
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkName = DB::table('category')
            ->where('ftname','=', $name)
            ->first();
            if ($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => $name.' sudah ada.',
                ], 404);
            }

            $resID = DB::table('category')
            ->insertGetId([
                'ftname' => $name,
                'ftdescription' => $description,
                'fnstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'fncreated_by' => Auth::id(),
                'created_at' => $dtnow,
                'updated_at' => $dtnow
            ]);
            $data = DB::table('category')
            ->where('id','=', $resID)
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
            'name' => 'required|max:100',
            'description' => 'max:255',
            'status' => 'required|numeric',
        ]);
        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $status = $request->input('status');
        
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkData = DB::table('category')
            ->where('id','=', $id)
            ->first();
            $chkName = DB::table('category')
            ->where('id','<>', $id)
            ->where('ftname','=', $name)
            ->first();
            if (!$chkData) {
                DB::rollback();
                return response()->json([
                    'error' => 'Data tidak ada.',
                ], 404);
            }else if ($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => $name.' sudah ada.',
                ], 404);
            }

            DB::table('category')
            ->where('id','=',$id)
            ->update([
                'ftname' => $name,
                'ftdescription' => $description,
                'fnstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'updated_at' => $dtnow
            ]);
            $data = DB::table('category')
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
}