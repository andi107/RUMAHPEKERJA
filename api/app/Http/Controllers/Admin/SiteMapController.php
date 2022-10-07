<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SiteMapController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50|regex:/^[a-z]+$/',
        ],[
            'name.regex' => 'Hanya Alphabet a-z.'
        ]);

        $name = $request->input('name');

        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkData = DB::table('sitemap')
            ->where('ftname','=',$name)
            ->first();
            if ($chkData) {
                DB::rollback();
                return response()->json([
                    'error' => $name.' sudah ada.',
                ], 404);
            }

            DB::table('sitemap')
            ->insert([
                'ftname' => $name,
                'created_at' => $dtnow,
                'updated_at' => $dtnow
            ]);
            
            $data = DB::table('sitemap')
            ->where('ftname','=', $name)
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
            'name' => 'required|max:50|regex:/^[a-z]+$/',
        ],[
            'name.regex' => 'Hanya Alphabet a-z.'
        ]);
        $id = $request->input('id');
        $name = $request->input('name');

        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkData = DB::table('sitemap')
            ->where('id','=',$id)
            ->first();
            $chkName = DB::table('sitemap')
            ->where('id','<>',$id)
            ->where('ftname','=',$name)
            ->first();
            if (!$chkData) {
                DB::rollback();
                return response()->json([
                    'error' => 'Data tidak ada.',
                ], 404);
            }else if($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => $name.' sudah ada.',
                ], 404);
            }

            DB::table('sitemap')
            ->where('id','=', $id)
            ->update([
                'ftname' => $name,
                'updated_at' => $dtnow
            ]);
            
            $data = DB::table('sitemap')
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