<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 02.03.2017
 * Time: 15:48
 */

class convert{
    public function to_double($var){
        return (double)$var;
    }
    public function to_str($var){
        return (string)$var;
    }
    public function to_int($var){
        return intval($var);
    }
    public function to_float($var){
        return floatval($var);
    }
    public function to_char($var){
        return chr($var);
    }
    public function to_currency($var){
        return money_format('$%i', $var);
    }
    public function format_bytes($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}