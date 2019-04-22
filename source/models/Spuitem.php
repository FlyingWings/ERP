<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-3-2
 * Time: 下午9:30
 */
class SpuItem extends Base {
    public $id, $spu, $name;
    public static $table = "spu_item";
    public function translate_query($data){
        if(isset($data['name'])){
            $this->db->like("name", $data['name']);
            unset($data['name']);
        }
        if(isset($data['spu'])){
            $this->db->like("spu", $data['spu']);
            unset($data['spu']);
        }
        return $data;
    }
}