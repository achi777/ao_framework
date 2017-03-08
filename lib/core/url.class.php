<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 02.03.2017
 * Time: 15:46
 */
class url
{
    public function segment($part)
    {
        $url = str_replace(path, "", $_SERVER['REQUEST_URI']);
        $result = explode("/", $url);
        if (!empty($result[$part])) {
            return $result[$part];
        } else {
            return 0;
        }

    }

    public function full_url(){
        return $_SERVER['REQUEST_URI'];
    }

    public function redirect($url){
        header("Location: ".$url);
    }

    public function baseurl()
    {
        return domain.path;

    }

    public function reverseIPOctets($ip)
    {
        return implode('.', array_reverse(explode('.', $ip)));
    }
    public function checkTor(){
        if (gethostbyname($this->ReverseIPOctets($_SERVER['REMOTE_ADDR']).".".$_SERVER['SERVER_PORT'].".".$this->ReverseIPOctets($_SERVER['SERVER_ADDR']).".ip-port.exitlist.torproject.org")=="127.0.0.2") {
            return "tor";
        }
    }

    public function browser_info()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $ub = 'Unknown';

        if(preg_match('/MSIE/i',$u_agent))
        {
            $ub = "MSIE";
        }
        elseif(preg_match('/Edge/i',$u_agent))
        {
            $ub = "Edge";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $ub = "Opera";
        }
        elseif(preg_match('/Firefox/i',$u_agent) && $this->checkTor() != "tor")
        {
            $ub = "Firefox";
        }
        elseif(preg_match('/http/i',$u_agent) || preg_match('/https/i',$u_agent))
        {
            $ub = "Iframe";
        }
        elseif(preg_match('/OPR/i',$u_agent))
        {
            $ub = "Opera";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $ub = "Safari";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $ub = "Netscape";
        }elseif ($this->checkTor() == "tor"){
            $ub = "Tor";
        }

        return $ub;
    }
}