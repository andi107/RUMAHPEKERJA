<?php

namespace App\Helpers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
// use App\Helpers\Notification;
use App\Helpers\Mail\MailQueue;
class Guard {

    public static function check_point($value,$username = '') {
        $public_ip = '::1';
        $dtnow = Carbon::now();
        $err = '{"error":"{{ERR}}"}';
        
        try {
            
            $res_msg = explode('.',$value);
            $h = $res_msg[0];
            $msg = $res_msg[1];
            
            $method = "AES-256-CBC";
            $sec = env('CSRF_KEY','32');
            $intervalThreshold = env('CSRF_EXP');

            if (hash_hmac('md5', $msg, $sec) == $h) {
                
                $iv = base64_decode(substr($msg, 0, 24));
                $dc = openssl_decrypt(substr($msg, 24), $method, $sec, 0, $iv);
                
                $msgDate = new Carbon(str_replace("T"," ",substr($dc,0,19)));
                $dc = json_decode(substr($dc,19));
                
                $public_ip = $dc->public_ip;
                
                $checkBlockedIp = DB::table('blacklist_ip')
                    ->where('ftpublic_ip', '=', $public_ip)
                    ->where('fnattempt','>=', 10)
                    ->first();
                    
                if($checkBlockedIp) {
                    return json_decode(str_replace('{{ERR}}', 'You are forbidden to access.#1',$err));
                }
                
                if (($dtnow->getTimestamp() - $msgDate->getTimestamp()) <= $intervalThreshold) {
                    $chkWhite = DB::table('domain_whitelist')
                        ->where('ftdomain','=', $dc->host)
                        ->where('uuid_app_id','=', $dc->app_id)
                        ->where('fnstatus','=', 1)
                        ->first();
                        
                    if($chkWhite) {
                        if ($username){
                            $res = (new self)->users_log($dc,$username);
                            if (str_contains($res, '{{ERR}}')){ 
                                DB::rollback();
                                return json_decode(str_replace('{{ERR}}', str_replace('{{ERR}}','',$res),$err));
                            }
                        }
                        
                        return $dc;
                    }
                }else{
                    return json_decode(str_replace('{{ERR}}', 'Invalid Token. ~001',$err));
                }
            }
            return json_decode(str_replace('{{ERR}}', 'Invalid Token. ~002',$err));
        } catch (\Throwable $th) {
            try {
                $checkBlockedIp = DB::table('blacklist_ip')
                    ->where('ftpublic_ip', '=', $public_ip)
                    ->where('fnattempt','>=', 10)
                    ->first();
                if($checkBlockedIp) {
                    return json_decode(str_replace('{{ERR}}', 'You are forbidden to access.#2',$err));
                }
                $getBlockedIp = DB::table('blacklist_ip')
                    ->where('ftpublic_ip', '=', $public_ip)
                    ->where('ftfrom_url', '=', 'Method POST : '.URL::current())
                    ->first();
                if (!$getBlockedIp) {
                    DB::table('blacklist_ip')
                        ->insert([
                            'ftpublic_ip' => $public_ip,
                            'created_at' => $dtnow,
                            'ftfrom_url' => 'Method POST : '.URL::current()
                        ]);
                }else{
                    DB::table('blacklist_ip')
                        ->where('ftpublic_ip','=', $public_ip)
                        ->update([
                            'fnattempt' => $getBlockedIp->fnattempt + 1,
                            'ftfrom_url' => 'Method POST : '.URL::current()
                        ]);
                }
            } catch (\Throwable $th) {}
            return json_decode(str_replace('{{ERR}}', 'You are forbidden to access.#3',$err));
        }
    }

    public static function users_log($data,$username) {
        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();
            $getUsernameWithoutLogin = DB::table('users')
                ->where('username','=', $username)
                ->first();
            if ($getUsernameWithoutLogin) {
                $generate = Uuid::generate(4)->string;
                $getUserLog = DB::table('users_log_ip')
                    ->where('fnuser_id', '=', $getUsernameWithoutLogin->id)
                    ->where('ftpublic_ip','=',$data->public_ip)
                    ->where('ftbrowser','=',$data->browser)
                    ->where('ftdevice','=',$data->devices)
                    ->where('ftos','=',$data->os)
                    ->first();
                if (!$getUserLog) {
                    DB::table('users_log_ip')
                        ->insert([
                            'id' => $generate,
                            'fnuser_id' => $getUsernameWithoutLogin->id,
                            'ftpublic_ip' => $data->public_ip,
                            'ftbrowser' => $data->browser,
                            'ftdevice' => $data->devices,
                            'ftos' => $data->os,
                            'fncreated_by' => $getUsernameWithoutLogin->id,
                            'fnupdated_by' => $getUsernameWithoutLogin->id,
                            'created_at' => $dtnow,
                            'updated_at' => $dtnow,
                        ]);

                    $data = [
                        'title' => 'RPH - New Login',
                        'host' => $data->host,
                        'public_ip' => $data->public_ip,
                        'browser' => $data->browser,
                        'devices' => $data->devices,
                        'os' => $data->os,
                        'user_agent' => $data->user_agent,
                    ];
                    
                    MailQueue::send('new_login',$getUsernameWithoutLogin->email,$data,$username);
                    DB::commit();

                }elseif($getUserLog->fnblocked == 1){
                    return '{{ERR}}Your IP address has been blocked.';
                }
                return false;
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }
}