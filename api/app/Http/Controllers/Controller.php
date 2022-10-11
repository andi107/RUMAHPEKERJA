<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    function getRandString() {
        $length = rand(5,10);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function text_clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
     }

    function saveGalery($data) {
        return DB::table('galery')
        ->insertGetId([
            'ftname' => $data['name'],
            'ftfolder' => $data['folder'],
            'ftmimes' => $data['mimes'],
            'ftext' => $data['ext'],
            'fncontent_id' => $data['content_id'],
            'fnupdated_by' => Auth::id(),
            'fncreated_by' => Auth::id(),
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
            'fttype' => $data['type'],
            'uuid_tmp_id' => $data['tmp_id']
        ]);
    }

    function updateGalery($data) {    
        DB::table('galery')
        ->where('fttype','=', $data['type'])
        ->where('fncontent_id','=',$data['content_id'])
        ->update([
            'ftfolder' => $data['folder'],
            'ftmimes' => $data['mimes'],
            'ftext' => $data['ext'],
            'fnupdated_by' => Auth::id(),
            'updated_at' => $data['updated_at'],
        ]);
    }

    function updateTmpAttach($data) {
        DB::table('galery')
        ->where('fttype','=', $data['type'])
        ->where('fncontent_id','=',0)
        ->where('uuid_tmp_id','=', $data['tmp_id'])
        ->update([
            'fnupdated_by' => Auth::id(),
            'updated_at' => $data['updated_at'],
            'fncontent_id' => $data['content_id'],
            'uuid_tmp_id' => null,
        ]);
    }
}
