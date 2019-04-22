<?php
class CSV{
    public $filename;

    public $columns;
    public $rows;

    static $DEFAULT_OPTIONS=array(
        'header'=>true,
        'length'=>4096,
        'delimiter'=>",",
        'enclosure'=>'"',
        'escape'=>'\\',
        'col_index'=>false,	// 使用column name作为下标，而不是数字列名
    );

    function __construct($filename, $options=array()){
        // 自动识别TSV和CSV
        $ext=@pathinfo($filename)['extension'];
        if($ext=='tsv'){
            self::$DEFAULT_OPTIONS['delimiter']="\t";
        }

        $this->options=array_merge(self::$DEFAULT_OPTIONS, $options);
        $this->columns=array();
        $this->rows=array();

        $this->filename=$filename;

        $this->_fh=fopen($this->filename, "r");
        if(!$this->_fh) throw new \Exception("Can't open CSV file: $this->filename");

        if($this->options['header']){
            // 读取首行，标题
            $this->columns=$this->parse_row();
        }
    }

    function __destruct(){
        // 正确关闭文件
        if($this->_fh){
            fclose($this->_fh);
            $this->_fh=null;
        }

        return true;
    }

    function parse_row($fh=null){
        return fgetcsv($fh ?: $this->_fh, $this->options['length'], $this->options['delimiter'], $this->options['enclosure'], $this->options['escape']);
    }

    function col($name){
        // Search for exact match
        foreach($this->columns as $i=>$col){
            if(strtolower($col)==strtolower($name)){
                return $i;
            }
        }

        // Search for rough match
        foreach($this->columns as $i=>$col){
            if(strpos(strtolower($col), strtolower($name))!==false){
                return $i;
            }
        }

        return $name;
    }

    function read($batch=false){
        while(!feof($this->_fh)){
            $r=$this->parse_row();
            if(!is_array($r)) continue;
            if($r==[null]) continue;

            if($this->options['col_index']){
                $nr=[];
                foreach($this->columns as $idx=>$col){
                    $nr[$col]=@$r[$idx];
                }
                $r=$nr;
            }

            if($batch){
                $this->rows[]=$r;
            }
            else{
                yield $r;
            }
        }
    }

    function write($table){
        $f=fopen($this->filename, "w");

        try{
            foreach($table as $row){
                fputcsv($f, $row, $this->options['delimiter'], $this->options['enclosure'], $this->options['escape']);
            }
        }
        finally{
            fclose($f);
        }
    }
}