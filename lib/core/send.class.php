<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 02.03.2017
 * Time: 15:44
 */


class send{
    public function sendSMS($src, $dest, $sms, $prefix, $gateway){
        $sms = urlencode($sms);
        //$gateway = "http://91.151.128.64:7777/pls/sms/phttp2sms.Process?src=";
        $requestURL = $gateway.$src."&dst=".$prefix.$dest."&txt=".$sms."";
        $request = file_get_contents($requestURL);
        if($request == "y"){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    public function sendMail($to, $cc, $from, $subject, $text){
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "CC: ". strip_tags($cc) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = '<html><body>';
        $message .= '<h1>'.$text.'</h1>';
        $message .= '</body></html>';
        if(mail($to, $subject, $message, $headers)){
            return true;
        }else{
            return false;
        }
    }
}