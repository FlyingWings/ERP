<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-3-3
 * Time: 下午2:39
 */
class Inventories extends Base {
    public static $table = "inventory";

    public $id, $sku, $warehouse, $qty;


}