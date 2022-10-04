<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\URL;
class HomeController extends Controller
{
    public function index() {

        $title = 'Beranda';
        $description = 'rumahpekerjahebat.com adalah sebuah portal web berisi berita, artikel, media komunikasi, dan jasa konsultasi, bagi masyarakat pekerja atau buruh Indonesia.';
        $created_at = '2022-09-28';
        $category_name = 'news';
        $keyWord = ['rumah pekerja hebat', 'rumah pekerja', 'pekerja hebat'];

        if (config('app.env') === 'production') {
            $imgLogo = secure_asset('src/images/icons/logo-01.png');
        } else{
            $imgLogo = asset('src/images/icons/logo-01.png');
        }
        
        SEOMeta::setTitle('Beranda');
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
        OpenGraph::addProperty('type', 'article');
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
        
        return view('home',[
            'seometa' => SEOMeta::class
        ]);
    }

    public function shrt_link($id) {

        return redirect(env('APP_URL') .'/asd/asdasd/asdasdasd');
    }

    public function image_view($folder, $ext, $fileName) {
        try {
            $fileLocation = $folder.'/'. $fileName .'.'. $ext;
            if (!Storage::exists($fileLocation)) {
                $fileLocation = 'static/no_image.png';
                if (!Storage::exists($fileLocation)) {
                    abort(404);
                }
                $headers = ['Content-Type' => 'image/png'];
                return Storage::download($fileLocation, 'ContentFile' , $headers);
            }
            $headers = ['Content-Type' => 'image/'.$ext];
            return Storage::download($fileLocation, 'ContentFile' , $headers);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
