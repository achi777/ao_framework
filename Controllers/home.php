<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 10:36
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function Home(){
        $data['id'] = 777;
        $data['zauri'] = $this->model->satesto();
        $this->load->view("header");
        $this->load->view("home",$data);
        $this->load->view("footer");

    }
}