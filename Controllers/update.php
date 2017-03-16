<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 16.03.2017
 * Time: 10:06
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function update(){
        if($this->input->post("submit")){
            $this->model->updateToBase($this->url->segment(2),$this->input->post("name_geo"),$this->input->post("name_eng"));
        }
        $data['info'] = $this->model->seletcOne($this->url->segment(2));
        $data['id'] = $this->url->segment(2);
        $this->load->view("header");
        $this->load->view("update",$data);
        $this->load->view("footer");

    }
}