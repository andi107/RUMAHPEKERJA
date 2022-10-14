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
        ->join('users','posts.fnpublished_by','=','users.id')
        ->selectRaw('posts.fttitle, posts.ftdescription ,posts.ftuniq ,posts.fncategory,posts.fttitle_url,posts.created_at,posts.updated_at,posts.fnstatus,posts.published_at,
        galery.ftname as ftgalery_name,galery.ftfolder as ftgalery_folder,galery.ftext as ftgalery_ext,category.ftname as ftcategory_name,
        (select username from users where id = posts.fnpublished_by) as published_by,
        users.ftfirst_name as published_first_name, users.ftlast_name as published_last_name')
        ->where('galery.fttype','=','baner')
        ->where('posts.fnstatus','=',1)
        ->orderBy('posts.published_at','desc')
        ->paginate(10);

        return response()->json([
            'data' => $data
        ], 200);
    }

    // public function detail($cat_id,$cont_id,$title_url,$category_name) {
    public function detail($cont_id,$title_url) {
        try {
            $data = DB::table('posts')
            ->join('category', 'posts.fncategory', '=', 'category.id')
            ->join('users','posts.fnpublished_by','=','users.id')
            ->selectRaw(
                'posts.id,posts.fttitle, posts.ftdescription,posts.ftbody ,posts.ftuniq ,posts.fncategory,posts.fttitle_url,posts.created_at,
                posts.updated_at,posts.fnstatus,posts.published_at,category.ftname as ftcategory_name,
                (select username from users where id = posts.fnpublished_by) as published_by,
                users.ftfirst_name as published_first_name, users.ftlast_name as published_last_name')
            ->where('posts.fnstatus','=',1)
            ->where('posts.ftuniq','=',$cont_id)
            // ->where('posts.fncategory','=', $cat_id)
            ->where('posts.fttitle_url','=', $title_url)
            // ->where('category.ftname','=', $category_name)
            ->first();
            if (!$data){
                return response()->json([
                    'msg' => 'Data not found #1'
                ], 404);
            }
            $dataBaner = DB::table('galery')
            ->where('fncontent_id','=',$data->id)
            ->where('fttype','=','baner')
            ->first();
            $dataKeyword = [
                'Turun Ke Jalan','Turun Ke Jalan Tolak','Ke Jalan Tolak kenaikan','Aliansi Buruh Turun Ke',
                'Buruh Turun Ke Jalan','RUMAH PEKERJA','PEKERJA','RUMAH','HEBAT','Buruh'
            ];
            return response()->json([
                'data' => $data,
                'dataBaner' => $dataBaner,
                'dataKeyword' => $dataKeyword
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Data not found #2'
            ], 404);
        }
    }

}