<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 02.03.2017
 * Time: 15:47
 */

class validation{
    public function email($str){
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        if(preg_match($regex, $str)){
            return true;
        }else{
            return false;
        }
    }

    public function is_empty($str){
        if(isset($str)){
            return false;
        }else{
            return true;
        }
    }

    public function random_str($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}