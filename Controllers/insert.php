<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 16.03.2017
 * Time: 09:50
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function insert(){
        if($this->input->post("submit")){
            $lastID = $this->model->recordToBase($this->input->post("name_geo"),$this->input->post("name_eng"));
        }else{
            $lastID = "";
        }
        $data['lastInsertID'] = $lastID;
        $this->load->view("header");
        $this->load->view("insert",$data);
        $this->load->view("footer");

    }
}