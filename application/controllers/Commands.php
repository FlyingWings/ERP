<?php
if(php_sapi_name() != "cli"){
    exit("CMD Only");
}


class Commands extends Base_Controller{
    public function __construct()
    {
        parent::__construct();
    }

//    public function index($spu="DK-19001"){
//        $colors= ['BLACK'=>'黑色', "NUDE"=>'肉色', "WHITE"=>'白色'];
//        $sizes = ["S"=>"小款", "M"=>"中款", "L"=>"大款"];
//        foreach($colors as $color=>$n){
//            foreach($sizes as $size=>$m){
//                $sku = $spu."-".$color."-".$size;
//                $list = $this->lm->find_one(['sku'=>$sku]);
//                if(!$list){
//                    $list = new ListingItem(['sku'=>$sku, "spu"=>$spu]);
//                    $list->save();
//                }else{
//                    if($spu == "DK-19001")
//                        $list->name = "蕾丝安全裤".$n.$m;
//                    if($spu == "DK-19002")
//                        $list->name = "高腰冰丝安全裤".$n.$m;
//
//                    $list->save();
//                }
//            }
//        }
//    }

    public function test($sku=""){
//        $listing = $this->listings->find_one(['sku'=>$sku]);
        $p = new ListingItem(['sku'=>"TEST", "spu"=>"TEST", "qty"=>0]);
        $r = $p->save();
        dd($r);
    }

    public function run1(){
        $item = "black-S	black-M	black-L	nude-S	nude-M	nude-L	white-S	white-M	white-L";
        $item = explode("\t", $item);
        foreach($item as $line){
            file_put_contents(APP_ROOT."temp/r.log", "DK-19001-".strtoupper($line)."\n", FILE_APPEND);
        }
    }

}