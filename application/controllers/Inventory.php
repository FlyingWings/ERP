<?php
class Inventory extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cond = $this->input->get()?:[];
        $cond = array_filter($cond);
        $data['inventories'] = $this->inventory->find_all($cond, ["id"=>"desc"]);
        $data['warehouses'] = $this->inventory->distinct("warehouse", []);
        $data['title'] = "库存记录";
        $data = $data+ $cond;

        $this->render("inventory/index", $data);
    }
    public function record(){
        $cond = $this->input->get()?:[];
        $cond = array_filter($cond);
        $data['records'] = $this->inventory_update->find_all($cond, ["id"=>"desc"]);
        $data['warehouses'] = $this->inventory->distinct("warehouse", []);
        $data['title'] = "库存变动记录";
        $data = $data+ $cond;

        $this->render("inventory/record", $data);
    }

    public function record_new(){
        if(!$this->input->post()){
            if($this->input->get("sku")){
                $listing = $this->listings->find_one(['sku'=>$this->input->get("sku")]);
            }else{
                $listing = new ListingItem();
            }
            $this->render("inventory/record_new", compact("listing"));

        }else{
            $sku = $this->input->post("sku");
            if(!$sku){
                $this->error("SKU 不能为空");
                return 0;
            }else{
                $record = new InventoryUpdate($this->input->post());
                $record->data['operator'] = $_SESSION['admin_name'];
                $record->save();
                $this->redirect("/inventory/record");
            }
        }
    }

    public function record_view(){
        if($this->input->get("id")){
            $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
            $this->render("inventory/record_view", compact("record"));
        }else{
            $this->redirect_return();
        }
    }

    public function record_edit(){
        $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
        if($record->status == "init"){
            if(!$this->input->post()) {
                $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
                $this->render("inventory/record_edit", compact("record"));
            }else{
                $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
                $record->bind($this->input->post());
                $record->save();
                $this->redirect_return();
            }

        }else{
            $this->redirect_return();
        }

    }

    public function confirm_paid(){
        $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
        if($record->status == "init"){
            $record->status = "confirmed";
            $record->save();
            $inventory = $this->inventory->find_one(['sku'=>$record->sku, 'warehouse'=>$record->warehouse]) ?: new Inventories(['sku'=>$record->sku, 'warehouse'=>$record->warehouse, "qty"=>0]);
            $inventory->qty+=$record->qty;
            $inventory->save();
        }
        $this->redirect("/inventory/record");
    }

    // 只有init状态的记录才可以删除
    public function record_delete(){
        $record = $this->inventory_update->find_one(['id'=>$this->input->get("id")]);
        if($record->status == "init"){
            $record->delete();
        }
        $this->redirect("/inventory/record");
    }

    public function download_inventory_example(){
        header("Content-Type: text/tsv");
        header("Content-Disposition:attachment;filename=inventory-example-".date("YmdHis").".csv");
        echo file_get_contents(DIR_TEMP."/inventory_example.csv");
    }
    public function upload_file(){

        if(isset($_FILES['file']) && !$_FILES['file']['error']){
            $file = new CSV($_FILES['file']['tmp_name'], ["header"=>1,"col_index"=>1]);
            foreach($file->read() as $line){
                $data =  new InventoryUpdate($line+['operator'=>$_SESSION['admin_name']]);
                $data->save();
            }
        }
        $this->redirect("/inventory/record");
    }

}
