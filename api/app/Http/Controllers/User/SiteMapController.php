<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SiteMapController extends Controller {

    public function st_sitemap() {
        $data = DB::table('sitemap')
        ->orderBy('created_at','desc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function st_posts() {
        $data = DB::select("select
            a.*,ctg.ftname as ftcategory_name
            from (
                select
                    pst.fttitle, pst.ftdescription ,pst.ftuniq ,pst.fncategory,pst.fttitle_url,pst.created_at , pst.updated_at,pst.fnstatus,
                    gal.ftname as ftgalery_name,gal.ftfolder as ftgalery_folder,gal.ftext as ftgalery_ext
                from posts pst left join galery gal
                    on (pst.id = gal.fncontent_id and gal.fttype = 'baner')
            ) a left join category ctg
            on (a.fncategory = ctg.id) where a.fnstatus = 1 order by a.created_at desc");
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function st_category() {
        $data = DB::table('category')
        ->orderBy('created_at','desc')
        ->get();
        return response()->json([
            'data' => $data
        ], 200);
    }
}