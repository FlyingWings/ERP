<?php
class Auth extends Base_Controller{
    public function pdd_callback(){
        file_put_contents(TEMPPATH."access.log", json_encode($_GET)."\n", FILE_APPEND);
    }
}