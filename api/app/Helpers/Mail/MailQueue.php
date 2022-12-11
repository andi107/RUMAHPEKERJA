<?php
 
namespace App\Helpers\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use App\Helpers\Mail\PerangkatBaruTerdeteksi;
use App\Helpers\Mail\PendaftaranAktivasiEmailUntukAdministrator;
class MailQueue {
    
    public static function get_rand_first() {
        return DB::table('x_mail_queue')
            ->first();
    }

    public static function save($name,$mail,$data) {
        $generate = Uuid::generate(4)->string;
        DB::table('x_mail_queue')
            ->insert([
                'id' => $generate,
                'ftname' => $name,
                'ftmail' => $mail,
                'ftjson_data' => json_encode($data),
                'created_at' => Carbon::now()
            ]);
    }

    public static function send($name,$mail,$data,$username = null) {
        // $data = json_decode($data,true);
        // dd('aaa',$name,$mail,$data);
        // MailQueue::delete($get->id);

        switch ($name) {
            case 'new_login':
                $token = Crypt::encryptString($username);
                // dd($token);
                Mail::to($mail)->send(new PerangkatBaruTerdeteksi($data,$token));
                DB::table('users')
                ->where('username','=', $username)
                ->update([
                    'ftreset_password' => $token
                ]);
                break;
            case 'new_user':
                Mail::to($mail)->send(new PerangkatBaruTerdeteksi($data,$token));
                break;
            default:
                return response()->json([
                    'status' => 'Sending mail failed.',
                ], 404);
        }
        return response()->json([
            'status' => 'Sending mail to >> ' . $mail .' (Success)',
        ], 200);
    }

    public static function delete($id) {
        DB::table('x_mail_queue')
            ->where('id','=',$id)
            ->delete();
    }
}