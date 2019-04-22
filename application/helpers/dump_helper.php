<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-1-30
 * Time: 下午5:58
 */
function dd(){
    foreach(func_get_args() as $arg){
        var_dump($arg);
    }
    exit;
}

?>
