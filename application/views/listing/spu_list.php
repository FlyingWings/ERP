<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <div class="col-md-12">
                <form action="/listing/spu" method="get" style="display: inline-block" class="col-md-9">
                    <span>SPU</span> <input type="text" name="spu" value="<?=$spu?>" class="form-control normal-input-text">
                    <span>产品名</span> <input type="text" name="name" value="<?=$name?>" class="form-control normal-input-text">

                    <input type="submit" value="提交" class="btn btn-sm btn-success">
                    <button class="btn-primary btn btn-sm" onclick="location.href='/listing/spu';">重置</button>

                </form>
                <form action="/listing/upload_file_spu" method="post" enctype="multipart/form-data" style="display: inline-block">
                    <span>导入文件</span>
                    <input type="file" name="file" value="wen" class="form-file normal-input-text">
                    <input type="submit" value="导入" class="btn btn-sm btn-success">
                    <a class="btn btn-warning btn-sm" href="/listing/download_spu_example">下载例子</a>

                </form>

            </div>
        </div>
        <div class="panel-body">

            <table class="table">
                <thead>
                <tr>
                    <th>SPU</th>
                    <th>SPU名</th>
                    <th colspan="2" style="text-align: center">操作</th>
                </tr>
                </thead>
                <?php foreach($spu_lists as $listing):?>
                    <tr>
                        <td><?=$listing->spu?></td>
                        <td><?=$listing->name?></td>
                        <td><a target="_blank" href="/listing?spu=<?=$listing->spu?>" class="btn btn-primary btn-sm">查看SKU</a></td>
                        <td><a class="btn btn-sm btn-danger" onclick="delete_spu(<?=$listing->id?>)" href="#">删除SPU</a></td>
                    </tr>
                <?php endforeach;?>
            </table>

        </div>

</div>
<script>
    function delete_spu(id){
        if(confirm("确认要删除这个SPU么?")){
            location.href="/listing/delete_spu?id="+id;
        }
    }
</script>