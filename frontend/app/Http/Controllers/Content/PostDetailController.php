<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\ApiH;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\URL;
class PostDetailController extends Controller
{
    // public function detail($cid,$id,$title) {
    public function detail($category_name,$title,$cid,$id) {
        
        $cid = urlencode($cid);
        $id = urlencode($id);
        $title = urlencode($title);
        $category_name = urlencode($category_name);
        $res = ApiH::apiGetVar('/post/detail/'.$cid.'/'.$id.'/'.$title.'/'.$category_name);
        if ($res == null or isset($res->error) or isset($res->msg)) {
            abort(404);
        }
        
        $logo = asset('src/images/logos/logo.webp');
        $title = $res->data->fttitle;
        $description = $res->data->ftdescription;
        $created_at = Carbon::parse($res->data->created_at)->toIso8601String();
        $updated_at = Carbon::parse($res->data->updated_at)->toIso8601String();
        $category_name = '$res->data->ftcategory_name';
        $keyWord = $res->dataKeyword;
        $addImg1 = route('image-view', [$res->dataBaner->ftfolder,$res->dataBaner->ftext,$res->dataBaner->ftname]);
        $published_by = $res->data->published_by;
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('article:published_time', $created_at, 'property');
        SEOMeta::addMeta('article:section', '$category_name', 'property');
        SEOMeta::addMeta('googlebot-news', 'index,follow', 'property');
        SEOMeta::addMeta('googlebot', 'index,follow', 'property');
        SEOMeta::addKeyword($keyWord);
        
        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('type', 'NewsArticle');
        OpenGraph::addProperty('locale', 'id-ID');
        OpenGraph::addProperty('locale:alternate', ['id-ID']);
        OpenGraph::addProperty('site_name','Rumah Pekerja Hebat');
        OpenGraph::addProperty('image:type',$res->dataBaner->ftmimes);
        OpenGraph::addProperty('image:width','700');
        OpenGraph::addProperty('image:height','393');
        
        OpenGraph::addImage($addImg1);
        
        JsonLd::setDescription($description);
        JsonLd::setType('NewsArticle');
        JsonLd::addValue('headLine', $title);
        JsonLd::addValue('datePublished', $created_at);
        JsonLd::addValue('dateModified', $updated_at);

        JsonLd::addValue('image', [
            '@type' => 'ImageObject',
            'url' => $addImg1,
            'width' => 700,
            'height' => 393
        ]);
        JsonLd::addValue('author', [
            '@type' => 'Person',
            'url' => route('user-profile',['@'.$published_by, 'administrator']),
            'name' => 'x-root'
        ]);
        JsonLd::addValue('publisher', [
            '@type' => 'Organization',
            'name' => 'RPH Teams',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $logo,
                'width' => 255,
                'height' => 114
            ]
        ]);
        JsonLd::addValue('thumbnailUrl', $addImg1);
        // dd($res);
        return view('content.postdetail',[
            'data' => $res,
            'seometa' => SEOMeta::class,
            'opengraph' => OpenGraph::class,
            'jsonld' => JsonLd::class,
            'carbon' => Carbon::class,
        ]);
    }
}
