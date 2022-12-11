<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Mail\MailQueue;
class UsersController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req) {
        $search = $req->input('s');

        if ($search) {
            $data = DB::table('users')
            ->selectRaw('id, username, email, fbstatus, fnupdated_by, fncreated_by, created_at, updated_at, ftfirst_name, ftlast_name')
            ->where('username','like', '%'. $search .'%')
            ->orWhere('email','like', '%'. $search .'%')
            ->orWhere('ftfirst_name','like', '%'. $search .'%')
            ->orWhere('ftlast_name','like', '%'. $search .'%')
            ->orderBy('updated_at','desc')
            ->paginate(10);
        }else{
            $data = DB::table('users')
            ->selectRaw('id, username, email, fbstatus, fnupdated_by, fncreated_by, created_at, updated_at, ftfirst_name, ftlast_name')
            ->orderBy('updated_at','desc')
            ->paginate(10);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function create(Request $req) {
        $this->validate($req, [
            'username' => [
                'required',
                'min:3',
                'max:50',
                'regex:/(^([a-z0-9]+)(\d+)?$)/u'
            ],
            'password' => ['required',
                'min:6',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$%^&*()\-_=+{};:,<.>]).{6,}$/',
            ],
            'email' => 'required|regex:/(^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$)/u',
            'first_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'status' => 'required|numeric',
            'validation_email' => 'numeric'
        ],[
            'username.regex' => 'Hanya huruf kecil dan angka yang diperbolehkan.',
            'password.regex' => 'Anda harus membuat kata sandi yang lebih kuat. Karakter huruf besar atau kecil yang diperlukan (A – Z)(a – z), Basis 10 digit (0 – 9), Non-alfanumerik (Misalnya: @, $, #, atau %).',
            'first_name.regex' => 'Hanya huruf nama depan yang diperbolehkan.',
            'last_name.regex' => 'Hanya huruf nama belakang yang diperbolehkan.',
            'email.regex' => 'Email tidak valid.'
        ]);

        $username = $req->input('username');
        $password = $req->input('password');
        $email = $req->input('email');
        $first_name = $req->input('first_name');
        $last_name = $req->input('last_name');
        $status = $req->input('status');
        $validation_email = $req->input('validation_email');

        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkName = DB::table('users')
            ->where('username','=',$username)
            ->first();
            $chkEmail = DB::table('users')
            ->where('email','=',$email)
            ->first();
            if ($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => 'Username :'. $username.' sudah ada.',
                ], 404);
            }else if($chkEmail) {
                DB::rollback();
                return response()->json([
                    'error' => 'Email : '.$email.' sudah ada.',
                ], 404);
            }else if($status > 2 || $status <= 0) {
                DB::rollback();
                return response()->json([
                    'error' => 'Status tidak valid.',
                ], 404);
            }

            if ($validation_email) {
                if($validation_email > 2 || $status <= 0) {
                    DB::rollback();
                    return response()->json([
                        'error' => 'Validasi email tidak valid.',
                    ], 404);
                }
                // For Email Veryfication
                $data = [
                    'title' => 'Rumah Pekerja Hebat',
                    'host' => $data->host,
                    'public_ip' => $data->public_ip,
                    'browser' => $data->browser,
                    'devices' => $data->devices,
                    'os' => $data->os,
                    'user_agent' => $data->user_agent,
                ];
                MailQueue::send('new_user',$email,$data,$username);
            }

            $save = DB::table('users')
            ->insertGetId([
                'username' => $username,
                'email' => $email,
                'password'  => Hash::make($password),
                'fbstatus' => $status,
                'fnupdated_by' => Auth::id(),
                'fncreated_by' => Auth::id(),
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name
            ]);
            
            $data = DB::table('users')
            ->where('id','=', $save)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }

    public function update(Request $req) {
        $this->validate($req, [
            'id' => 'required|numeric',
            'password' => ['required',
                'min:6',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$%^&*()\-_=+{};:,<.>]).{6,}$/',
            ],
            'email' => 'required|regex:/(^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$)/u',
            'first_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        ],[
            'username.regex' => 'Hanya huruf kecil dan angka yang diperbolehkan.',
            'password.regex' => 'Anda harus membuat kata sandi yang lebih kuat. Karakter huruf besar atau kecil yang diperlukan (A – Z)(a – z), Basis 10 digit (0 – 9), Non-alfanumerik (Misalnya: @, $, #, atau %).',
            'first_name.regex' => 'Hanya huruf nama depan yang diperbolehkan.',
            'last_name.regex' => 'Hanya huruf nama belakang yang diperbolehkan.'
        ]);
        $id = $req->input('id');
        $password = $req->input('password');
        $email = $req->input('email');
        $first_name = $req->input('first_name');
        $last_name = $req->input('last_name');

        DB::beginTransaction();
        try {
            $dtnow = Carbon::now();

            $chkId = DB::table('users')
            ->where('id','=',$id)
            ->first();
            if ($chkName) {
                DB::rollback();
                return response()->json([
                    'error' => 'Username :'. $username.' sudah ada.',
                ], 404);
            }

            $save = DB::table('users')
            ->insertGetId([
                'password'  => Hash::make($password),
                'fbstatus' => 1,
                'fnupdated_by' => Auth::id(),
                'fncreated_by' => Auth::id(),
                'created_at' => $dtnow,
                'updated_at' => $dtnow,
                'ftfirst_name' => $first_name,
                'ftlast_name' => $last_name
            ]);
            
            $data = DB::table('users')
            ->where('id','=', $save)
            ->first();

            DB::commit();
            return response()->json([
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'error' => 'Internal Server Error.',
            ], 500)
                ->header('X-Content-Type-Options', 'nosniff')
                ->header('X-Frame-Options', 'DENY')
                ->header('X-XSS-Protection', '1; mode=block')
                ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
        }
    }
}