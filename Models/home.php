<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 10:39
 */
class Model extends start
{
    public $out;
    public $id;

    public function __construct()
    {
        parent::__construct();
        $this->id = $this->url->segment(1);
    }

    public function satesto(){
        $this->db->select("*");
        $this->db->from("information");
        //$this->db->join("cat","cat.cat_id=information.cat_id","left");
        $this->db->join_table("cat");
        $this->db->join_where("cat.cat_id","information.cat_id");
        $this->db->join_method("inner");
        $this->db->where("information.id","21");
        $result = $this->db->get();
        return $result;
    }

}