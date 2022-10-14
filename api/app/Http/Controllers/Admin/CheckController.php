<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
class CheckController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $chkData = DB::table('users')
        ->where('id','=', Auth::id())
        ->where('fbstatus','<>', 1)
        ->first();
        if ($chkData) {
            $this->go_logout();
        }
        return response()->json([
            'data' => 'ok'
        ], 200);
    }

    public function go_logout() {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function go_migrate(Request $request) {
        try {
            // Artisan::call('migrate');
            if (config('app.env') == 'production') {
                return 'OK';
            }
            if (!Auth::id() == 1) {
                return 'OK';
            }
            $step = $request->input('step');
            if ($step) {
                // Artisan::call('migrate:rollback', [
                //     "--step" => $step,
                //     "--force" => true
                // ]);
               $res = Artisan::call('migrate:rollback', [
                    "--step" => $step
                ]);
            }else {
                // Artisan::call('migrate', ["--force" => true ]);
                $res = Artisan::call('migrate');
            }
            return response()->json([
                'error' => $res,
            ], 500);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error.#2',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }
}