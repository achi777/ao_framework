<?php

/**
 * Created by PhpStorm.
 * User: archil
 * Date: 26.11.2015
 * Time: 12:12
 */
require "core/load.class.php";
require "core/files.class.php";
require "core/url.class.php";
require "core/db.class.php";
require "core/convert.class.php";
require "core/input.class.php";
require "core/validation.class.php";
require "core/send.class.php";


abstract class start{
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
        $this->load = new load();
        $this->files = new files();
        $this->db = new db();
        $this->convert = new convert();
        $this->input = new input();
        $this->validation = new validation();
        $this->send = new send();
    }
}

