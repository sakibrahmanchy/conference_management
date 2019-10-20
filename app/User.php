<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    //
    public function conferences(){
        return $this->belongsToMany('App\Conference');
    }

     protected $fillable = ['name', 'email', 'password','phone','user_type'];

    public function mailUser($to, $subject, $message){
           $mail = new PHPMailer(true);
    try{

        $mail->isSMTP();
        $mail->CharSet = "UTF-8"; #set it utf-8
        $mail->SMTPAuth = true; #set it true
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com"; #gmail has host  smtp.gmail.com
        $mail->Port = 587; #gmail has port  587 . without double quotes
        $mail->Username = "noreply.confmaster@gmail.com"; #your username. actually your email
        $mail->Password = "conf1234"; # your password. your mail password
        $mail->setFrom("noreply.confmaster@gmail.com", "Conf Master Auto Mailer");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->addAddress($to ,"");
        $mail->send();
     }catch(phpmailerException $e){
        dd($e);
     }catch(Exception $e){
        dd($e);
     }
    }


}
