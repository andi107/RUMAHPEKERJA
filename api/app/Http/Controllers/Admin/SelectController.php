<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class SelectController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users_list() {
        $data = DB::table('users')
        ->selectRaw('username,ftfirst_name,ftlast_name')
        ->where('fbstatus','=',1)
        ->orderBy('username','asc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}