<?php

namespace App\Http\Controllers\SiteMap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use App\Helpers\ApiH;
use Carbon\Carbon;
class SiteMapController extends Controller
{
    public function posts() {
        
        $res = ApiH::apiGetVar('/st/posts');
        // if (isset($res->data)) {
        //     echo '1';
        //     foreach ($res->data as $key) {
        //         $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $key->updated_at, 'UTC')
        //         ->setTimezone('Asia/Jakarta');
        //         $sitemap->add(Url::create('/c/'. $key->fncategory .'/'. $key->ftuniq .'/'.$key->fttitle_url)
        //         ->setLastModificationDate(Carbon::parse($updated_at))
        //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        //         ->setPriority(0.2));
        //     }
        // }
        // dd($res);
        $content = View::make('sitemap.posts',[
            'res' => $res,
            'carbon' => Carbon::class,
        ]);
        return Response::make($content, '200')->header('Content-Type', 'text/xml');

        // return view('sitemap.posts')
        // ->withHeaders([
        //     'Content-Type' => 'text/xml'
        // ]);
    }
}
