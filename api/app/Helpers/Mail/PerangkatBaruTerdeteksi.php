<?php
 
namespace App\Helpers\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PerangkatBaruTerdeteksi extends Mailable
{
    use Queueable, SerializesModels;
 
    public $data;
    public $token;
    public function __construct($data,$token)
    {
        $this->token = $token;
        $this->data = $data;
    }
 
    public function build()
    {
        $data = $this->data;
        $token = $this->token;
        return $this->from(env('MAIL_SENDER'), $data['title'])
            ->view('mail.newlogin')
            ->with('data',$data)
            ->with('token',$token);
    }
}