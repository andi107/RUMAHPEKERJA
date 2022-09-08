<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostDetailController extends Controller
{
    public function index($category,$id,$judul) {
        return view('content.postdetail');
    }
}
