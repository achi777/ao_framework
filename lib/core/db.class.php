<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 02.03.2017
 * Time: 15:50
 */
class db
{
    public $arrayObj;
    public $table;
    public $filter;
    public $joinStr;
    public $joinTable;
    public $joinMethod;
    public $joinWhere;
    public $ord;
    public $ordType;
    public $group;
    public $limitStr;
    public $queryType;
    public $queryStr;
    public $insertColumns;
    public $insertValues;
    public $records;
    public $sqlQuery;
    public $mysqli;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
            $this->mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);
            $this->mysqli->set_charset("utf8");
            $this->arrayObj = new arrayObj();
        }catch (Exception $e) {
            echo "Service unavailable";
            echo "message: " . $e->getMessage();
            exit;
        }
    }

    public function query_return($queryType)
    {
        $this->queryType = $queryType;
    }

    public function from($table){
        $this->table = $table;
    }

    public function into($table){
        $this->table = $table;
    }

    public function table($table){
        $this->table = $table;
    }

    public function join_table($table)
    {
        $this->joinTable = $table;
    }

    public function join_method($method)
    {
        $this->joinMethod = $method;
    }

    public function join_where($col1,$col2)
    {
        $this->joinWhere = $col1."=".$col2;
    }

    public function join($table,$compareStr,$method = "LEFT")
    {
        if(empty($this->joinStr)){
            $this->joinStr = $method." JOIN ".$table." ON ".$compareStr;
        }else{
            $this->joinStr .= " ".$method." JOIN ".$table." ON ".$compareStr;
        }

    }

    public function columns($arguments){
        $arg = func_get_args();
        $columns = "";
        foreach($arg AS $var){
            $columns .= "`".$var."`,";
        }
        $columns = rtrim($columns,',');
        $this->insertColumns = $columns;

    }

    public function values($arguments){
        $arg = func_get_args();
        $values = "";
        foreach($arg AS $var){
            $values .= "'".$var."',";
        }
        $values = rtrim($values,',');
        $this->insertValues = $values;
    }

    public function like($col,$val)
    {
        if(empty($this->filter)){
            $this->filter = $col." LIKE '%".$val."%'";
        }else{
            $this->filter .= " AND ".$col." LIKE '%".$val."%'";
        }

    }

    public function where($col,$val)
    {
        if(empty($this->filter)){
            if (strpos($col.$val, '>') !== false || strpos($col.$val, '<') !== false || strpos($col.$val, '=') !== false) {
                $this->filter = $col.$val;
            }else{
                $this->filter = $col."=".$val;
            }

        }else{
            if (strpos($col.$val, '>') !== false || strpos($col.$val, '<') !== false || strpos($col.$val, '=') !== false) {
                $this->filter .= " AND ".$col.$val;
            }else{
                $this->filter .= " AND ".$col."=".$val;
            }
        }

    }

    public function and_where($col,$val)
    {
        if (strpos($col.$val, '>') !== false || strpos($col.$val, '<') !== false || strpos($col.$val, '=') !== false) {
            $this->filter .= " AND ".$col.$val;
        }else{
            $this->filter .= " AND ".$col."=".$val;
        }
    }

    public function or_where($col,$val)
    {
        if (strpos($col.$val, '>') !== false || strpos($col.$val, '<') !== false || strpos($col.$val, '=') !== false) {
            $this->filter .= " OR ".$col.$val;
        }else{
            $this->filter .= " OR ".$col."=".$val;
        }
    }

    public function order($by,$type)
    {
        $this->ord = $by;
        $this->ordType = $type;
    }

    public function limit($limit)
    {
        $this->limitStr = $limit;
    }

    public function group($group)
    {
        $this->group = $group;
    }

    public function select($arguments = "*")
    {
        $arg = func_get_args();
        $columns = "";
        foreach($arg AS $var){
            $columns .= $var.",";
        }
        $columns = rtrim($columns,',');
        $this->queryStr = "SELECT " . $columns;
    }

    public function queryBuilder()
    {
        if(!empty($this->filter)){
            $where = "WHERE ".$this->filter;
        }else{
            $where = "";
        }
        if(!empty($this->limitStr)){
            $limit = "LIMIT ".$this->limitStr;

        }else{
            $limit = "";
        }
        if(!empty($this->ord)){
            $ordering = " ORDER BY ".$this->ord." ".$this->ordType;

        }else{
            $ordering = "";
        }
        if(!empty($this->group)){
            $group = "GROUP BY ".$this->group;

        }else{
            $group = "";
        }
        if(!empty($this->joinStr)){
            $join = $this->joinStr;
        }else{
            $join = "";
        }
        if(!empty($this->joinTable) && !empty($this->joinWhere)){
            if(empty($this->joinMethod)){
                $this->joinMethod = "LEFT";
            }
            $join = $this->joinMethod." JOIN ".$this->joinTable." ON ".$this->joinWhere;
        }else{
            $join = "";
        }
        $query = $this->queryStr." FROM " . $this->table." ".$join." ".$where." ".$ordering." ".$group." ".$limit;
        $this->sqlQuery = $query;
        $this->queryStr = "";
        $this->filter = "";
        $this->joinStr = "";
        $this->limitStr = "";
        $this->ord = "";
        $this->ordType = "";
        $this->table = "";
        //echo $query;
        return $query;
    }

    public function get(){
        $result = $this->mysqli->query($this->queryBuilder());
        if (!$result) {
            throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
        }
        switch($this->queryType){
            case "fetch_array":
                while($row[] = $result->fetch_array(MYSQLI_NUM));
                break;
            case "fetch_assoc":
                while($row[] = $result->fetch_assoc());
                break;
            case "num_rows":
                $row = $result->num_rows;
                break;
            default:
                while($row[] = $result->fetch_assoc());
                break;

        }
        return $row;

    }

    public function record(){
        if(!empty($this->insertColumns) && !empty($this->insertValues)){
            $this->mysqli->query("INSERT INTO ".$this->table." (".$this->insertColumns.") VALUES (".$this->insertValues.")");
            $this->insertColumns = "";
            $this->insertValues = "";
            return $this->mysqli->insert_id;
        }
    }

    public function update()
    {
        if(!empty($this->filter)){
            $filter = " WHERE ".$this->filter;
        }else{
            $filter = "";
        }
        $col = preg_replace('/[^A-Za-z0-9\-,_ @#$%&*()!?{}=<>]/', '', $this->insertColumns);
        $col = explode(",",$col);
        $val = preg_replace('/[^A-Za-z0-9\-,_ @#$%&*()!?{}=<>]/', '', $this->insertValues);
        $val = explode(",",$val);
        $i = 0;
        $string = "";
        foreach($col AS $var){
            $string .= $var." = '".$val[$i]."',";
            $i++;
        }
        $string = rtrim($string,',');
        $this->mysqli->query("UPDATE ".$this->table." SET ".$string." ".$filter."");
        $string = "";
        $this->insertColumns = "";
        $this->insertValues = "";
        $this->filter = "";
        $this->table = "";
    }

    public function delete()
    {
        $this->mysqli->query("DELETE FROM ".$this->table." WHERE ".$this->filter."");
        $this->filter = "";
        $this->table = "";
    }

    public function query($str)
    {
        return $this->mysqli->query($str);
    }

    public function run($method = "select"){
        $method = strtolower($method);
        switch ($method){
            case "select":
                $result = $this->get();
                break;
            case "update":
                $result = $this->update();
                break;
            case "insert":
                $result = $this->record();
                break;
            case "delete":
                $result = $this->delete();
                break;
            default:
                $result = $this->get();
                break;
        }
        if(!empty($this->queryStr)){
            $result = $this->get();
        }elseif(!empty($this->insertColumns) && !empty($this->insertValues) && !empty($this->filter)){
            $result = $this->update();
        }elseif(!empty($this->insertColumns) && !empty($this->insertValues)){
            $result = $this->record();
        }
        return $result;
    }

    public function paginationLimit($segment, $num)
    {
        $urlObj = new url();
        $page = intval($urlObj->segment($segment));
        if(!empty($this->filter)){
            $where = "WHERE ".$this->filter;
        }else{
            $where = "";
        }
        if(!empty($this->ord)){
            $ordering = " ORDER BY ".$this->ord." ".$this->ordType;

        }else{
            $ordering = "";
        }

        @$result = $this->mysqli->query($this->queryStr." FROM " . $this->table." ".$this->joinStr." ".$where." ".$ordering);
        @$this->records = mysqli_num_rows($result);

        @$total = intval(($this->records - 1) / $num) + 1;
        if (empty($page) or $page < 0) {
            $page = 1;
        }
        if ($page > $total) {
            $page = $total;
        }
        $start = $page * $num - $num;
        return $start.", ".$num;
    }

    public function pagination($segment, $num)
    {
        $urlObj = new url();
        $page = intval($urlObj->segment($segment));
        $total = intval(($this->records - 1) / $num) + 1;
        if (empty($page) or $page < 0) {
            $page = 1;
        }
        if ($page > $total) {
            $page = $total;
        }
        /*****************************************************************/

        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace("/".$page,"",$url);
        $url = str_replace($page,"",$url);

        $firstpage = null;
        $nextpage = null;
        $page1left = null;
        $page2left = null;
        $page3left = null;
        $page4left = null;
        $page5left = null;
        $page1right = null;
        $page2right = null;
        $page3right = null;
        $page4right = null;
        $page5right = null;

        if ($page != 1)
            $firstpage = paginationInsideStartTag." <a href=".$url."/1>".paginationStartPage."</a>".paginationInsideEndTag. paginationInsideStartTag." <a href=".$url."/" . ($page - 1) . ">".paginationFirstPage."</a>".paginationInsideEndTag;
        if ($page != $total)
            $nextpage = paginationInsideStartTag." <a href=".$url."/" . ($page + 1) . ">".paginationNextPage."</a> ".paginationInsideEndTag. paginationInsideStartTag." <a href=".$url."/" . $total . ">".paginationEndPage."</a></li>";

        if ($page - 5 > 0)
            $page5left = paginationInsideStartTag." <a href=".$url."/" . ($page - 5) . ">" . ($page - 5) . "</a>".paginationInsideEndTag;
        if ($page - 4 > 0)
            $page4left = paginationInsideStartTag." <a href=".$url."/" . ($page - 4) . ">" . ($page - 4) . "</a>".paginationInsideEndTag;
        if ($page - 3 > 0)
            $page3left = paginationInsideStartTag." <a href=".$url."/" . ($page - 3) . ">" . ($page - 3) . "</a>".paginationInsideEndTag;
        if ($page - 2 > 0)
            $page2left = paginationInsideStartTag." <a href=".$url."/" . ($page - 2) . ">" . ($page - 2) . "</a>".paginationInsideEndTag;
        if ($page - 1 > 0)
            $page1left = paginationInsideStartTag." <a href=".$url."/" . ($page - 1) . ">" . ($page - 1) . "</a>".paginationInsideEndTag;

        if ($page + 5 <= $total)
            $page5right = paginationInsideStartTag." <a href=".$url."/" . ($page + 5) . ">" . ($page + 5) . "</a>".paginationInsideEndTag;
        if ($page + 4 <= $total)
            $page4right = paginationInsideStartTag." <a href=".$url."/" . ($page + 4) . ">" . ($page + 4) . "</a>".paginationInsideEndTag;
        if ($page + 3 <= $total)
            $page3right = paginationInsideStartTag." <a href=".$url."/" . ($page + 3) . ">" . ($page + 3) . "</a>".paginationInsideEndTag;
        if ($page + 2 <= $total)
            $page2right = paginationInsideStartTag." <a href=".$url."/" . ($page + 2) . ">" . ($page + 2) . "</a>".paginationInsideEndTag;
        if ($page + 1 <= $total)
            $page1right = paginationInsideStartTag." <a href=".$url."/" . ($page + 1) . ">" . ($page + 1) . "</a>".paginationInsideEndTag;
        if ($total > 1) {

            $html =  paginationStartTag .
                $firstpage . $page5left . $page4left . $page3left . $page2left . $page1left .
                paginationCurrentStartTag."<a>".$page."</a>".paginationCurrentEndTag.
                $page1right . $page2right . $page3right . $page4right . $page5right . $nextpage.
                paginationEndTag;

        }
        return @$html;
    }

    public function  __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->mysqli->close();
    }
}

class security extends db{
    public function sql($str){
        $str = str_replace("/*", "",$str);
        $str = str_replace("*\"", "",$str);
        $str = str_replace("--", "",$str);
        $str = str_replace("'", "",$str);
        $str = str_replace("*", "",$str);
        return $this->mysqli->real_escape_string($str);
    }

    public function html($str){
        return htmlspecialchars($str);
    }

    public function script($str){
        $str = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $str);
        return $str;
    }
}


class arrayObj{

    public function extractArray($arr){
        $str = "";
        foreach($arr as $key){
            $str .= $key.", ";
        }
        $string = rtrim($str, ", ");
        return $string;
    }

    public function extractAssocArray($arr){
        $str = "";
        foreach ($arr as $key => $value){
            $str .= "`".$key ."`='".$value."', ";
        }
        $string = rtrim($str, ", ");
        return $string;
    }
}
