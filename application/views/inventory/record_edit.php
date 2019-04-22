<div class="container">
    <div class="panel">
        <div class="panel-heading" style="margin-bottom: 20px">

            <div class="col-md-12">
                <a href="/inventory/record" class="btn btn-primary btn-sm">返回</a>
            </div>
        </div>
        <div class="panel-body">
            <form action="/inventory/record_edit" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?=$record->id?>" name="id">
                <table class="table">
                    <tr>
                        <td>产品SKU</td>
                        <td><input type="text" value="<?=$record->sku?>" name="sku" class="form-control" placeholder="例如：DK19001-WHITE-S"></td>
                    </tr>
                    <tr>
                        <td>产品数量</td>
                        <td><input type="number" value="<?=$record->qty?>" name="qty" class="form-control" required placeholder="进货为正数，出货为负数"></td>
                    </tr>
                    <tr>
                        <td>产品价格</td>
                        <td><input type="text" value="<?=$record->price?>" name="price" class="form-control" required min="0"></td>
                    </tr>
                    <tr>
                        <td>渠道</td>
                        <td>
                            <select name="channel" class="form-control">
                                <?php foreach(InventoryUpdate::$CHANNELS as $k=>$v):?>
                                    <option value="<?=$k?>" <?=$k== $record->channel? "selected":""?> ><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>仓库</td>
                        <td><input type="text" name="warehouse" class="form-control" value="<?=$record->warehouse?>" required ></td>
                    </tr>

                    <tr>
                        <td>相关文件(以分号分割)</td>
                        <td><textarea name="files_related" class="form-control" required style="min-height: 100px;" ><?=$record->files_related?></textarea></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-success"  value="更新">
                            <input type="button" class="btn btn-danger"  value="删除" onclick="delete_listing(<?=$listing->id?>)">

                        </td>
                    </tr>
                </table>
            </form>

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