<?php
class Listing extends Base_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $cond = $this->input->get() ?:[];

        $cond=array_filter($cond);
        $data['listings'] = $this->listings->find_all($cond, ['id'=>'DESC']);//dd($listings);
        $data['title'] = "产品管理";
        $data = $data+ $cond;
        $this->render("listing/index", $data);
    }
    public function spu_prefix_list(){
        if($this->require_auth("view_spu_prefix")){
            $spu_prefix_lists = $this->spu_prefix->find_all([]);
            $title = "产品分类管理";
            $this->render("listing/spu_prefix_list", compact("spu_prefix_lists", "title"));
        }

    }

    public function spu(){
       if($this->require_auth("view_spu")){
           $cond = $this->input->get() ?:[];

           $cond=array_filter($cond);
           $spu_lists = $this->spu->find_all($cond);
           $title = "产品SPU管理";
           $this->render("listing/spu_list", compact("spu_lists", "title"));
       }
    }


    public function upload_file(){

        if(isset($_FILES['file']) && !$_FILES['file']['error']){
            $file = new CSV($_FILES['file']['tmp_name'], ["header"=>1,"col_index"=>1]);
            foreach($file->read() as $line){
                $data = $this->listings->find_one($line) ?: new ListingItem($line);
                $data->save();
            }
        }
        $this->redirect("/listing");
    }

    public function upload_file_spu(){
        if(isset($_FILES['file']) && !$_FILES['file']['error']){
            $file = new CSV($_FILES['file']['tmp_name'], ["header"=>1,"col_index"=>1]);
            foreach($file->read() as $line){
                $line = array_map("trim", $line);
                if(empty($line['spu'])) continue;
                $data = $this->spu->find_one($line) ?: new SpuItem($line);
                $data->save();
            }
        }
        $this->redirect("/listing/spu");
    }

    public function delete(){
        $obj = $this->listings->find_one($this->input->get());
        $obj->delete();
        $this->redirect("/listing");
    }

    public function edit(){
        if(empty($this->input->post())){
            $id = $this->input->get("id");
            $listing = $this->listings->find_one(['id'=>$id]);
            $this->render("listing/edit_listing", compact("listing"));
        }else{
            $id = $this->input->post("id");
            $listing = $this->listings->find_one(['id'=>$id]);
            $listing->bind($this->input->post());
            $listing->save();
            $this->redirect("/listing/edit?id=".$id);
        }


    }

    public function delete_spu(){
        $obj = $this->spu->find_one($this->input->get());
        $obj->delete();
        $this->redirect("/listing/spu");
    }



    public function download_sku_example(){
        header("Content-Type: text/tsv");
        header("Content-Disposition:attachment;filename=sku-example-".date("YmdHis").".csv");
        echo file_get_contents(DIR_TEMP."/sku_example.csv");
    }

    public function download_spu_example(){
        header("Content-Type: text/tsv");
        header("Content-Disposition:attachment;filename=spu-example-".date("YmdHis").".csv");
        echo file_get_contents(DIR_TEMP."/spu_example.csv");
    }
}