<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listbycategory($cid,$category) {
        $cid = urldecode($cid);
        $category = urldecode($category);
        
        return view('content.category.listbycategory');
    }
}
