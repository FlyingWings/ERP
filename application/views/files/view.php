<div class="container">
    <div class="panel">
        <div class="panel-heading">

            <div class="col-md-12">
                <?php $temp = "";foreach($routes as $line):?>
                <a href="/files?path=<?=$temp."/".$line?>" style="margin-right:5px"><?=$line?></a>/
                <?php $temp.=$line;endforeach;?>

                <form action="/files/upload" method="post" enctype="multipart/form-data" style="display: inline-block;float:right">
                    <span>创建文件夹</span>
                    <input type="text" name="folder_name">
                    <input type="submit" value="创建" class="btn btn-sm btn-primary">

                    <span>上传文件</span>
                    <input type="hidden" name="routes" value="<?=implode("/",$routes)?>">

                    <input type="file" name="file" value="" class="form-file normal-input-text">
                    <input type="submit" value="上传" class="btn btn-sm btn-success">
                </form>

            </div>
        </div>
        <div class="panel-body">
            <div class="panel-heading">Directories</div>
            <?php $dirs = array_chunk(@$contents['dir'], 5);
            foreach($dirs as $dir):?>
                <div class="col-md-12" style="margin-bottom: 30px">
                    <?php foreach ($dir as $item):?>
                        <div class="col-md-2">
                            <a href="/files?path=/<?=$item['pos']?>">
                                <i class="fa fa-folder-o fa-3x"></i>
                                <span style="position: relative;left:-50px;top:20px"><?=$item['name']?></span>
                            </a>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php endforeach;?>

            <div class="panel-heading"  style="margin-top: 30px">Files</div>

            <?php $dirs = array_chunk($contents['file'], 5);
            foreach($dirs as $dir):?>
                <div class="col-md-12" style="margin-bottom: 30px">
                    <?php foreach ($dir as $item):?>
                        <div class="col-md-2">
                            <i class="fa fa-file fa-3x"></i>
                            <a target="_blank" href="/files_folder/<?=$item['pos']?>" ><?=$item['name']?></a>
                            <a target="_blank" style="cursor: pointer" onclick="delete_listing('<?=$item['pos']?>')"><i class="fa fa-remove"></i></a>

                            <a target="_blank" href="/files_folder/<?=$item['pos']?>"  download><i class="fa fa-download"></i></a>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>


</div>
<script>
    function delete_listing(pos){
        if(confirm("确认要删除本文件么?")){
            location.href="/files/delete?pos="+pos;
        }
    }
</script>