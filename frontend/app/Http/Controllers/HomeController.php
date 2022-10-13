<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Response;
use App\Helpers\ApiH;
class HomeController extends Controller
{
    public function index(Request $req) {

        $title = 'Rumah Pekerja Hebat';
        $description = 'Rumah Pekerja Hebat adalah sebuah portal web berisi berita, artikel, media komunikasi, dan ~~';
        $created_at = Carbon::now()->toIso8601String();
        $category_name = 'news';
        $keyWord = ['rumah pekerja hebat', 'rumah pekerja', 'pekerja hebat'];
        
        $imgLogo = asset('src/images/logos/logo.webp');
        
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('article:published_time', $created_at, 'property');
        // SEOMeta::addMeta('article:section', '$category_name', 'property');
        SEOMeta::addMeta('googlebot-news', 'index,follow', 'property');
        SEOMeta::addMeta('googlebot', 'index,follow', 'property');
        SEOMeta::addMeta('news_keywords','rumah pekerja hebat, rumah pekerja, pekerja hebat','property');
        SEOMeta::addKeyword($keyWord);
        
        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'id-ID');
        OpenGraph::addProperty('locale:alternate', ['id-ID']);
        OpenGraph::addProperty('site_name','Rumah Pekerja Hebat');
        OpenGraph::addProperty('image:type','image/png');
        OpenGraph::addProperty('image:width','67');
        OpenGraph::addProperty('image:height','30');
        
        OpenGraph::addImage($imgLogo);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('Article');
        JsonLd::addImage($imgLogo);
        
        $page = 1;
        $perPage = 10;
        $url = '/post';

        if ($req->has('page')) {
            $url = $url . '?page=' . $req->input('page');
            $page = $req->input('page');
        }
        $firstrow = (($page * $perPage) - $perPage) + 1;

        $res = ApiH::apiGetVar($url);
        $res = ApiH::fixPagination(route('home'), $res->data);
        
        return view('home',[
            'firstrow' => $firstrow,
            'hlp' => ApiH::class,
            'seometa' => SEOMeta::class,
            'opengraph' => OpenGraph::class,
            'jsonld' => JsonLd::class,
            'carbon' => Carbon::class,
            'res' => $res
        ]);
    }

    public function shrt_link($id) {

       // return redirect(env('APP_URL') .'/asd/asdasd/asdasdasd');
    }

    public function image_view($folder, $ext, $fileName) {
        try {
            $fileLocation = $folder.'/'. $fileName .'.'. $ext;
            if (!Storage::exists($fileLocation)) {
                $fileLocation = 'static/no_image.png';
                if (!Storage::exists($fileLocation)) {
                    abort(404);
                }
            }
            $file = Storage::disk('local')->get($fileLocation);
            $type = Storage::mimeType($fileLocation);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
