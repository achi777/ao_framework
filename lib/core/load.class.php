<?php

/**
 * Created by PhpStorm.
 * User: archil
 * Date: 06.03.2017
 * Time: 13:48
 */
class load
{
    public $db;
    public $load;
    public $files;
    public $url;
    public $convert;
    public $input;
    public $validation;
    public $send;

    public function __construct()
    {
        $this->url = new url();
        $this->files = new files();
        $this->db = new db();
        $this->convert = new convert();
        $this->input = new input();
        $this->validation = new validation();
        $this->send = new send();
    }

    public function file($filename)
    {
        include($filename . ".php");
    }

    public function model($filename)
    {
        require "Models/" . $filename . ".php";
    }

    public function view($filename, $data = "")
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                ${"$key"} = $value;
            }
        }
        require "Views/" . $filename . ".php";
    }

    public function controller($filename)
    {
        require "Controllers/" . $filename . ".php";
    }
}
