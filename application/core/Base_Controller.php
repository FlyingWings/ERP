<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-1-30
 * Time: 下午5:51
 */
class Base_Controller extends CI_Controller{
    public $error_message;
    public function __construct(){
        parent::__construct();
        $this->load->library("session");
    }
    public function index(){
        $config = & get_config();
        var_dump($config);
    }
    public function view(){
        echo "Hello View";
    }

    public function render($page, $data=[]){
        $this->load->view("widgets/header", $data);
        $this->load->view($page, $data);
        $this->load->view("widgets/footer", $data);
    }

    public function redirect($location){
        header("Location: $location");
    }

    public function require_auth($operation_key) {
        if($this->oauth->get_roles()[$operation_key]){
            return true;
        }else{
            $this->error("您无权访问该页面，请联系管理员");
            return false;
        }
    }

    public function redirect_return(){
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function error($message){
        $this->load->view("widgets/header");
        $this->load->view("widgets/notifications", ['message'=>$message]);
        $this->load->view("widgets/footer");
    }
}