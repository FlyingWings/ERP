<?php
class ListingItem extends Base{
    public function __construct($data=[])
    {
        parent::__construct($data);
    }
    public static $table = "listing_item";

    public $id, $sku, $spu, $name, $qty, $status;
    public $last_updated;

    public function translate_query($data){
        if(isset($data['name'])){
            $this->db->like("name", $data['name']);
            unset($data['name']);
        }
        return $data;
    }


//    public function find_all_spu_prefix($condition=["1=1"], $limit="limit 99999"){
//        $query = $this->db->query("SELECT * FROM spu_type where ? $limit", implode(" AND ", $condition));
//        return $query->result();
//    }
//
////    public function to_array(){
////        return [
////            'sku'=>$this->sku,
////            'spu'=>$this->spu,
////            'name'=>$this->name ?:"默认",
////            'qty'=>$this->qty?:0,
////            'status'=>$this->status?:0
////        ];
////    }
//
//    public function save(){
//        $data = $this->to_array();
//        if($this->find_one(['sku'=>$data['sku']])){
//            return $this->db->update("listing_item", $data, ['sku'=>$data['sku']]);
//        }else{
//            return $this->db->insert("listing_item", $data);
//        }
//    }

}