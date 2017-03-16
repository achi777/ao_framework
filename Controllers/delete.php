<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 16.03.2017
 * Time: 11:17
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function delete(){
        $this->model->deleteFromBase($this->url->segment(2));
        $this->url->redirect(baseurl);
    }
}