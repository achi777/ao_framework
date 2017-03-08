<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 18:33
 */
class Controller extends start {
    public $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home");
        $this->model = new Model();

    }
    public function upload(){
        if($this->input->post("submit")){
            $this->files->upload_path("uploads/");
            $this->files->upload_ext("jpg");
            $this->files->upload_ext("png");
            $this->files->upload_ext("jepg");
            $this->files->upload_size(2);
            $this->files->upload_name($this->validation->random_str(10).".jpg");
            echo $this->files->upload($this->input->file("file"));
        }
        $this->load->view("header");
        $this->load->view("upload");
        $this->load->view("footer");

    }
}