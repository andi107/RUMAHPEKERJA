<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostDetailController extends Controller
{
    public function detail($cid,$category,$id,$title) {
        return view('content.postdetail');
    }
}
