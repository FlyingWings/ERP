<?php

class Main extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("listingitem", "listings");

    }
    public function index(){
        // 静态页面
        if($this->oauth->is_admin()){
            $this->oauth->get_roles();
            $this->render("main/index");
        }else{
            $this->load->view("main/index", []);
        }
    }

    public function login(){
        // 已登陆的，直接跳转
        if($this->oauth->is_admin()){
            $this->redirect("/main");
        }
        if(empty($_POST)){
            $this->load->view("main/login", []);
        }else{
            if($this->oauth->admin_login($_POST['admin_name'], $_POST['admin_password'])){
                $this->redirect("/main");
            }else{
                $this->error("Username OR password error!");
                $this->redirect("/main/login");
            }
        }
    }

    public function logout(){
        if(isset($_SESSION['admin_id']))
        unset($_SESSION['admin_id']);

        $this->redirect("/main");
    }
}