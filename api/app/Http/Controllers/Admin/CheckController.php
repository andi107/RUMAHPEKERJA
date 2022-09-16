<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CheckController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return response()->json([
            'data' => 'ok'
        ], 200);
    }
}