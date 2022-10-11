<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller {

    public function index() {
        $data = DB::table('category')
        ->orderBy('created_at','desc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}