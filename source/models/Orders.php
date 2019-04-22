<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-1-30
 * Time: 下午6:08
 */
class Orders extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_data(){
        return 123;
    }
}