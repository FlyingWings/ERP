<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Check if request authenticated, if not, redirect to login page
 *
 * authenticate
 * @return void
 **/
function authenticate()
{
    $ci=&get_instance();
    $user=@$_SESSION['admin_id'];
    if($user){
        // do nothing
    }
    else
    {
        //redirect to login page
        $whitelist=$ci->config->item('url_white_list');
        $pass=false;

        foreach($whitelist as $pattern){
            if(preg_match('|'.$pattern.'|', $ci->uri->uri_string)){
                $pass=true;
                break;
            }
        }
        if(!$pass){
            header("Location: /main/login");
            exit();
        }
    }
}
