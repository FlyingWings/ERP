<div class="container">
    <div class="panel">
        <div class="panel-heading">

                <div class="col-md-12">
                    <form action="/listing" method="get" style="display: inline-block" class="col-md-9">
                    <span>SPU</span> <input type="text" name="spu" value="<?=$spu?>" class="form-control normal-input-text">
                    <span>产品名</span> <input type="text" name="name" value="<?=$name?>" class="form-control normal-input-text">
                    <select name="status" onchange="this.form.submit()" class="form-control normal-input-text">
                        <option value="0">产品状态</option>
                        <option value="-1" <?=$status=='-1'? "selected" : ""?>>失效</option>
                        <option value="1" <?=$status=="1"?"selected" : ""?>>有效</option>
                    </select>

                    <input type="submit" value="提交" class="btn btn-sm btn-success">
                    <button class="btn-primary btn btn-sm" onclick="location.href='/listing?';">重置</button>

                    </form>

                    <form action="/listing/upload_file" method="post" enctype="multipart/form-data" style="display: inline-block;">
                        <span>导入文件</span>
                        <input type="file" name="file" value="wen" class="form-file normal-input-text">
                        <input type="submit" value="导入" class="btn btn-sm btn-success">
                        <a class="btn btn-warning btn-sm" href="/listing/download_sku_example">下载例子</a>
                    </form>

                </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>SKU</th>
                    <th>产品名</th>
                    <th>SPU</th>
                    <th colspan="2" style="text-align: center">操作</th>

                </tr>
                </thead>
                <?php foreach($listings as $listing):?>
                    <tr>
                        <td><img style="max-width: 100px;max-height: 100px;" src="<?=$listing->primary_image_path ?: "/files_folder/sku_image/{$listing->sku}.jpg"  ?>" alt="暂无"></td>
                        <td><?=$listing->sku?></td>
                        <td><?=$listing->name?></td>
                        <td><?=$listing->spu?></td>
                        <td>
                            <a class="btn btn-success btn-sm" href="/listing/edit?id=<?=$listing->id?>">更新SKU</a>
                            <a class="btn btn-sm btn-danger" onclick="delete_listing(<?=$listing->id?>)" href="#">删除SKU</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>


</div>
<script>
    function delete_listing(id){
        if(confirm("确认要删除这件产品么?")){
            location.href="/listing/delete?id="+id;
        }
    }
</script>