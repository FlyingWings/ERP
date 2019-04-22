<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19-3-3
 * Time: 下午12:11
 */
class Files extends Base_Controller{
    public function __construct()
    {
        parent::__construct();
    }



    public function index(){
        $path = $this->input->get("path");
        if(!is_dir(APP_ROOT."files_folder/$path/")){
            mkdir(APP_ROOT."files_folder/$path/", 0775);
        }
        $routes = explode("/", $path);
        $routes=array_filter($routes);
        array_unshift($routes, "/");


        $contents = scandir(APP_ROOT."files_folder/$path");
        $this->render("files/view", ['contents'=>self::read_files("/$path/", $contents), 'routes'=>$routes]);
    }

    protected static function read_files($prefix, $contents){
        $clean_file = ['dir'=>[], 'file'=>[]];
        foreach($contents as $line){
            if($line == "." || $line == "..") continue;
            if(is_dir(APP_ROOT."/files_folder/".$prefix.$line)){
                $pos = implode("/",array_filter(explode("/", $prefix.$line)));
                $clean_file['dir'][]= ['name'=>$line, 'pos'=>$pos];
            }else{
                $pos = implode("/",array_filter(explode("/", $prefix.$line)));

                $clean_file['file'][]=['name'=>$line, 'pos'=>$pos];
            }
        }
        return $clean_file;
    }

    public function upload(){
        if(isset($_FILES['file']) && !$_FILES['file']['error']){
            $route = $this->input->post("routes");
            move_uploaded_file($_FILES['file']['tmp_name'], APP_ROOT."/files_folder".$route."/".$_FILES['file']['name']);
        }elseif($this->input->post("folder_name")){
            $route = $this->input->post("routes");

            mkdir(APP_ROOT."/files_folder".$route."/".$this->input->post("folder_name"), 0755);
        }
        $this->redirect("/files?path=$route");
    }

    public function delete(){
        $pos = $this->input->get("pos");
        unlink(APP_ROOT."/files_folder/$pos");
        $this->redirect_return();
    }
}