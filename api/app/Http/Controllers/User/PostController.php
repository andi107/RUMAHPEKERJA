<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller {

    public function index(Request $req) {
        $data = DB::table('posts')
        ->join('galery', 'posts.id', '=', 'galery.fncontent_id')
        ->join('category', 'posts.fncategory', '=', 'category.id')
        ->selectRaw('posts.fttitle, posts.ftdescription ,posts.ftuniq ,posts.fncategory,posts.fttitle_url,posts.created_at,posts.updated_at,posts.fnstatus,posts.published_at,
        galery.ftname as ftgalery_name,galery.ftfolder as ftgalery_folder,galery.ftext as ftgalery_ext,category.ftname as ftcategory_name')
        ->where('galery.fttype','=','baner')
        ->where('posts.fnstatus','=',1)
        ->orderBy('posts.published_at','desc')
        ->paginate(10);

        return response()->json([
            'data' => $data
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