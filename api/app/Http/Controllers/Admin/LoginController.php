<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller {

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index','register']]);
    }

    public function index(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:100',
            'password' => 'required|max:100',
        ]);
        DB::beginTransaction();
        try {
            $credentials = request(['username', 'password']);
            dd('OK');
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
