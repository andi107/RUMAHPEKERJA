<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    public function index() {
        return view('home');
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
