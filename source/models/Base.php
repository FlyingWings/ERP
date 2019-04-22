<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-3-2
 * Time: 下午6:36
 */
class Base extends CI_Model{
    public static $table;
    public $data;
    private $db;
    public function __construct($data=[])
    {
        get_instance()->load->database();
        $this->db = get_instance()->db;
        foreach($data as $key=>$value){
            $this->data[$key] = $value;
            if(!$this->$key){
                $this->$key = $value;
            }else{
                error_log("{$key} is already set to {$this->$key}");
            }
        }
    }

    public function __get($name)
    {
        if($name == "db"){
            return $this->db;
        } elseif($name == "class"){
            // 返回类名
            return get_class($this);
        }elseif($name == "table"){
            // 返回表名
            return get_called_class()::$table;
        }else{
            return @$this->data[$name];
        }
    }

    public function __set($name, $value){
        $this->$name = $value;
        $this->data[$name] = $value;
    }

    public function translate_query($data){
        return $data;
    }

    public function find_one($condition=[]){
        $query = $this->db->get_where($this->table, $condition, 1, 0);
        $class= $this->class;
        if($obj = $query->row(0)){
            return new $class($obj);
        }
        return null;
    }

    public function find_all($condition=["1=1"], $order=[], $limit="limit 99999"){

        $table = $this->table;
        $class= $this->class;

        foreach($order as $key=>$value){
            $this->db->order_by($key, $value);
        }
        $condition = $this->translate_query($condition);
        $query = $this->db->get_where($table, $condition);
        $res =[];
        foreach($query->result() as $line){
            $res[]= new $class($line);
        }
        return $res;
    }

    public function translate_where($where_cond){
        $conds = ["1=1"];
        foreach($where_cond as $k=>$v){
            $conds[]= " $k = {$this->db->escape($v)}";
        }
        return implode(" AND ", $conds);
    }
    public function distinct($key, $cond){

        $query = $this->db->query("SELECT DISTINCT($key) FROM {$this->table} WHERE ".$this->translate_where($cond));
        return array_map(function($i){return $i->warehouse;}, $query->result());
    }

    public function to_array(){
        return $this->data;
    }

    public function save(){
        $this->_check();

        if($this->id){
            return $this->db->update($this->table, $this->data, ['id'=>$this->data['id']]);
        }else{
            return $this->db->insert($this->table, $this->data);
        }
    }

    public function bind($data){
        foreach($data as $k=>$v){
            $this->data[$k]=$v;
            $this->$k = $v;
        }
        return true;
    }

    public function delete(){
        return $this->db->delete($this->table, ['id'=>$this->id]);
    }

    // 魔术方法，减少数据不一致
    protected function _check(){
        foreach($this->data as $key=>$value){
            $this->data[$key] = $this->$key;
        }
    }

}