<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 13.03.2017
 * Time: 16:18
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function pages(){
        $data['id'] = 777;
        $data['list'] = $this->model->pageList();
        $data['pagination'] = $this->model->pagination();
        $this->load->view("header");
        $this->load->view("pages",$data);
        $this->load->view("footer");

    }
}