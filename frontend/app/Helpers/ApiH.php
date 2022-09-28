<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
class ApiH
{
    public static function csrf($value = null)
    {
        $geo_location = Session::get(Cookie::get('USERNAME') . 'location');
        if ($geo_location) {
            $geo_location = json_decode($geo_location);
            $_lat = $geo_location->latitude;
            $_long = $geo_location->longitude;
        } else {
            $_lat = 'n/a';
            $_long = 'n/a';
        }
        $message = json_encode([
            'host' => request()->getHttpHost(),
            'app_id' => env('APP_ID'),
            'public_ip' => UserSystemInfo::get_ip(),
            'browser' => UserSystemInfo::get_browsers(),
            'devices' => UserSystemInfo::get_device(),
            'os' => UserSystemInfo::get_os(),
            'user_agent' => request()->userAgent(),
            'url' => URL::current(),
            'geo_latitude' => $_lat,
            'geo_longitude' => $_long,
            'message' => $value
        ]);
        $method = env('CSRF_METHOD');
        $secret = env('CSRF_SECRET');
        $message = substr(date('c'), 0, 19) . "$message";
        $iv = substr(bin2hex(openssl_random_pseudo_bytes(16)), 0, 16);
        $enc = base64_encode($iv) . openssl_encrypt($message, $method, $secret, 0, $iv);
        $hmac = hash_hmac('md5', $enc, $secret);
        return $hmac . '.' . $enc;
    }

    public static function apiGetVar($url)
    {
        $response = Http::withToken(Cookie::get('API_TOKEN'))
        ->get(env('APP_API') . $url);

        return $response->object();
    }

    public static function apiPostVar($url, $body)
    {
        $response = Http::withToken(Cookie::get('API_TOKEN'))
        ->acceptJson()->post(env('APP_API') . $url, $body);

        return $response;
    }

    public static function apiPutVar($url, $body)
    {
        $response = Http::withToken(Cookie::get('API_TOKEN'))
        ->acceptJson()->put(env('APP_API') . $url, $body);

        return $response;
    }

    public static function apiPostVarFile($url, $body, $fparam = null, $tfile = null, $fname = null, $multiple = null)
    {
        if ($multiple) {
            $response = Http::withToken(Cookie::get('API_TOKEN'));
            foreach ($multiple as $a_value) {
                $response = $response->attach($a_value[0], $a_value[1], $a_value[2]);
            }
            $response = $response->acceptJson()->post(env('APP_API') . $url, $body);
        }else{
            $response = Http::withToken(Cookie::get('API_TOKEN'))
            ->attach($fparam, $tfile, $fname)
                ->acceptJson()->post(env('APP_API') . $url, $body);
        }
        return $response;
    }

    public static function fixPagination($url, $obj, $filter = "")
    {
        if ($obj->first_page_url != null) {
            $fpage = explode('?', $obj->first_page_url);
            if ($filter != "") {
                $obj->first_page_url = $url . "?filter=" . $filter . "&" . $fpage[1]; // replace first page pagination
            } else {
                $obj->first_page_url = $url . "?" . $fpage[1]; // replace first page pagination
            }
        }

        if ($obj->last_page_url != null) {
            $lpage = explode('?', $obj->last_page_url);
            if ($filter != "") {
                $obj->last_page_url = $url . "?filter=" . $filter . "&" . $lpage[1]; // replace last page pagination
            } else {
                $obj->last_page_url = $url . "?" . $lpage[1]; // replace last page pagination
            }
        }

        if ($obj->prev_page_url != null) {
            $ppage = explode('?', $obj->prev_page_url);
            if ($filter != "") {
                $obj->prev_page_url = $url . "?filter=" . $filter . "&" . $ppage[1]; // replace prev page pagination
            } else {
                $obj->prev_page_url = $url . "?" . $ppage[1]; // replace prev page pagination
            }
        }

        if ($obj->next_page_url != null) {
            $npage = explode('?', $obj->next_page_url);
            if ($filter != "") {
                $obj->next_page_url = $url . "?filter=" . $filter . "&" . $npage[1]; // replace next page pagination
            } else {
                $obj->next_page_url = $url . "?" . $npage[1]; // replace next page pagination
            }
        }

        foreach ($obj->links as $key => $item) {
            if ($item->url != null) {
                $page = explode('?', $item->url);
                if ($filter != "") {
                    $obj->links[$key]->url = $url . "?filter=" . $filter . "&" . $page[1];
                } else {
                    $obj->links[$key]->url = $url . "?" . $page[1];
                }
            }
        }

        return $obj;
    }

    public static function statusForm($stat)
    {
        if ($stat == 1) { // 1
            $badge = "success";
        } else if ($stat == 3) { // 3
            $badge = "danger";
        } else if ($stat == 2) { // 2
            $badge = "warning";
        } else {
            $badge = "default";
        }
        return $badge;
    }

    public static function statusForm2($stat)
    {
        if ($stat == 1) {
            $badge = "Publik";
        } else if ($stat == 3) {
            $badge = "Tidak Publik";
        } else if ($stat == 2) {
            $badge = "Draft";
        } else {
            $badge = "general";
        }
        return $badge;
    }

    public static function statusTrxOrder($stat) {
        if ($stat == 6) { // Ordered
            $badge = "info";
        } else if ($stat == 13 || $stat == 15) { // Delivered
            $badge = "success";
        } else if ($stat == 10 || $stat ==11 || $stat == 12) { // vtq & pickup & delivery
            $badge = "info";
        } else if ($stat == 7 || $stat == 14) { // draft
            $badge = "warning";
        } else if ($stat == 8) { // Canceled
            $badge = "danger";
        } else if ($stat == 9) { // Closed
            $badge = "secondary";
        } else {
            $badge = "default";
        }
        return $badge;
    }

    public static function img_base64($content_id) {
        try {
            $res = ApiH::apiGetVar('/api/admin/gallery/select?content_id='.$content_id);
            if (isset($res->data)) {
                $data = $res->data;
                return 'data:'. $data->ftmimes .';base64,'. $data->ftblob;
            }   
        } catch (\Throwable $th) {}
        return env('APP_URL').'/icon/noimage.png';
    }

    public static function file_create($file,$folder,$photoId,$old_filename = null) {
        try {
            switch ($file->getClientMimeType()) {
                case 'image/png':
                    $mimes = 'image/png';
                    $type = 'png';
                    break;
                case 'image/jpeg' || 'image/jpg':
                    $mimes = 'image/jpg';
                    $type = 'jpg';
                    break;
                default:
                    return 'Invalid_file_type1';
                    break;
            }

            $setFileName = sprintf('%s.%s', $photoId, $type);

            if ($old_filename) {
                if (Storage::exists($folder.'/'.$old_filename)) {
                    Storage::delete($folder.'/'.$old_filename);
                }
            }
            $path = $folder.'/'.$setFileName;
            Storage::disk('local')->put($path, file_get_contents($file));
            $data = [
                'baner_id' => $photoId,
                'mimes' => $mimes,
                'ext' => $type
            ];
            return $data;
        } catch (\Throwable $th) {
            return 'Invalid_file_type2 ';
        }
    }
}
