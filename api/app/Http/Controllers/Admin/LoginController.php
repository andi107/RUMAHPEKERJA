<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
class LoginController extends Controller {

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index','go_migrate']]);
    }

    public function index(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:100',
            'password' => 'required|max:100',
        ]);
        try {
            $credentials = request(['username', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => "Wrong credential!"], 200);
            }else{
                $check = DB::table('users')
                    ->select('id','username', 'fbstatus')
                    ->where('username', '=', $request->input('username'))
                    ->where('fbstatus', '=', 1)
                    ->first();
                if (!$check) {
                    return response()->json(['error' => "Wrong credential!"], 200);
                }
                $token_time = 1440;
                // if ($request->input('remember') == 1) {
                //     $token_time = 8640;
                // }else{
                //     $token_time = 1440;
                // }
                $token = auth()->setTTL($token_time)->attempt($credentials);
                
                return response()->json([
                    'access_token' => $token,
                    'expires_in_minute' => auth()->factory()->getTTL(),
                    'username' => $check->username,
                    'uid' => $check->id
                ])->header('Authorization', sprintf('Bearer %s', $token));
            }

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function go_migrate() {
        try {
            // Artisan::call('migrate');
            Artisan::call('migrate', ["--force" => true ]);
        } catch (\Throwable $th) {
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
