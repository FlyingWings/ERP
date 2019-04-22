<?php
class InventoryUpdate extends Base {
    public function __construct($data=[])
    {
        parent::__construct($data);
    }

    public static $table = "inventory_update";

    public $id, $sku, $qty, $price, $channel, $warehouse, $files_related, $operator, $record_time;

    public static $STATUS=[
        "init"=>"已创建",
        "confirmed"=>"已确认",
    ];

    public static $CHANNELS=[
        "local"=>"比恋奴",
        "local-fang"=>"方老板",
        "1688"=>"1688",
        "pdd"=>"拼多多",

    ];


}