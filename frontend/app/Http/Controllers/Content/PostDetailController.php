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
    public function detail($cid,$id,$title) {
        $cid = urlencode($cid);
        $id = urlencode($id);
        $title = urlencode($title);
        $res = ApiH::apiGetVar('/post/detail/'.$cid.'/'.$id.'/'.$title);
        if ($res == null or isset($res->error) or isset($res->msg)) {
            abort(404);
        }
// dd($res);
        $title = $res->data->fttitle;
        $description = $res->data->ftdescription;
        $created_at = Carbon::parse($res->data->created_at)->setTimezone('Asia/Jakarta')->toIso8601String();
        $category_name = '$res->data->ftcategory_name';
        $keyWord = ['key1', 'key2', 'key3'];
        $addImg1 = route('image-view', [$res->dataBaner->ftfolder,$res->dataBaner->ftext,$res->dataBaner->ftname]);
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
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'id-ID');
        OpenGraph::addProperty('locale:alternate', ['id-ID']);
        OpenGraph::addProperty('site_name','Rumah Pekerja Hebat');
        OpenGraph::addProperty('image:type',$res->dataBaner->ftmimes);
        OpenGraph::addProperty('image:width','1000');
        OpenGraph::addProperty('image:height','529');
        
        OpenGraph::addImage($addImg1);
        
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('Article');
        JsonLd::addImage($addImg1);
        return view('content.postdetail',[
            'data' => $res,
            'seometa' => SEOMeta::class,
            'opengraph' => OpenGraph::class,
            'jsonld' => JsonLd::class
        ]);
    }
}
