<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller {

    public function index(Request $req) {
        return response()->json([
            'data' => '$data'
        ], 200);
    }

    public function detail($cat_id,$cont_id,$title_url) {
        $cat_id = urldecode($cat_id);
        $cont_id = urldecode($cont_id);
        $title_url = urldecode($title_url);
        try {
            $data = DB::table('posts')
            ->where('fnstatus','=',1)
            ->where('ftuniq','=',$cont_id)
            ->where('fncategory','=', $cat_id)
            ->where('fttitle_url','=', $title_url)
            ->first();
            if (!$data){
                return response()->json([
                    'msg' => 'Data not found'
                ], 404);
            }
            $dataBaner = DB::table('galery')
            ->where('fncontent_id','=',$data->id)
            ->where('fttype','=','baner')
            ->first();
            return response()->json([
                'data' => $data,
                'dataBaner' => $dataBaner
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Data not found'
            ], 404);
        }
    }

}