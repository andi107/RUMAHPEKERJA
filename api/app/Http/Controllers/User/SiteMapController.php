<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SiteMapController extends Controller {

    public function st_posts() {
        $data = DB::table('sitemap_posts')
        ->where('fnstatus','=',1)
        ->orderBy('updated_at','desc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}