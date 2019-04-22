<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-3-3
 * Time: 下午5:14
 */
class Info extends Base_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $status_map = InventoryUpdate::$STATUS;
        $channels = InventoryUpdate::$CHANNELS;
        $this->render("info/system", compact("status_map", "channels"));
    }
}