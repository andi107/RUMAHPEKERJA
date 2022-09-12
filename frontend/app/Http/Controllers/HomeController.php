<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function shrt_link($id) {

        return redirect(env('APP_URL') .'/asd/asdasd/asdasdasd');
    }
}
