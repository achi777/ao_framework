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

    public function selectJoin(){
        /**Select**/
        $this->db->select("*");
        $this->db->from("information");
        //$this->db->join("cat","cat.cat_id=information.cat_id");
        //$this->db->join("cat","cat.cat_id=information.cat_id","left");
        $this->db->join_table("cat");
        $this->db->join_where("cat.cat_id","information.cat_id");
        $this->db->join_method("inner");
        $this->db->where("information.id","21");
        $this->db->or_where("information.id","22");
        $result = $this->db->run("SELECT");
        return $result;
    }

    public function seletcOne($id){
        /**Select with pagination**/
        $this->db->select("*");
        $this->db->from("information");
        $this->db->where("id",$id);
        $result = $this->db->run("SELECT");
        return $result;
    }

    public function pageList(){
        /**Select with pagination**/
        $this->db->select("*");
        $this->db->from("information");
        $this->db->limit($this->db->paginationLimit(2, 3));
        $result = $this->db->run("SELECT");
        return $result;
    }

    public function pagination(){
        /**pagination**/
        $result = $this->db->pagination(2, 3);
        return $result;
    }

    public function recordToBase($name_geo,$name_eng){
        /*Insert*/
        $this->db->table("information");
        $this->db->columns("name_geo", "name_eng");
        $this->db->values($name_geo, $name_eng);
        $this->db->run("INSERT");
    }

    public function updateToBase($id,$name_geo,$name_eng){
        /*Update*/
        $this->db->table("information");
        $this->db->columns("name_geo", "name_eng");
        $this->db->values($name_geo, $name_eng);
        $this->db->where("id",$id);
        $this->db->run("UPDATE");
    }

    public function deleteFromBase($id){
        /*Delete*/
        $this->db->table("information");
        $this->db->where("id",$id);
        $this->db->delete("DELETE");
    }

}