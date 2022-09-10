<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiH;

class PostController extends Controller
{
    public function index(Request $req) {
        return view('admin.admpostcreate');
    }
}
