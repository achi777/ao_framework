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
        /**Select**/
        $this->db->select("*");
        $this->db->from("information");
        //$this->db->join("cat","cat.cat_id=information.cat_id","left");
        $this->db->join_table("cat");
        $this->db->join_where("cat.cat_id","information.cat_id");
        $this->db->join_method("inner");
        $this->db->where("information.id","21");
        $result = $this->db->run("SELECT");
        /*Insert*/
        /*
        $this->db->table("information");
        $this->db->columns("name_geo", "name_eng");
        $this->db->values("test i", "test eng i");
        $this->db->run("INSERT");
        */
        /*Update*/
        /*
        $this->db->table("information");
        $this->db->columns("name_geo", "name_eng");
        $this->db->values("test i 5% & 5*5 +7 -21 =(45645) #@!<>?", "test eng i gdfhgdfhg");
        $this->db->where("id","22");
        $this->db->run("UPDATE");
        */
        /*Delete*/
        /*
        $this->db->table("information");
        $this->db->where("id","22");
        $this->db->delete("DELETE");
        */

        return $result;
    }

}