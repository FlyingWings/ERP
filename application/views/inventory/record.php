<div class="container">
    <div class="panel">
        <div class="panel-heading">

            <div class="col-md-12">
                <form action="/inventory/record" method="get" style="display: inline-block" class="col-md-9">
                    <span>SKU</span> <input type="text" name="sku" value="<?=$sku?>" class="form-control normal-input-text"><!--like 判断 -->
                    <select name="status" onchange="this.form.submit()" class="form-control normal-input-text">
                        <option value="0">库存变动状态</option>
                        <?php foreach (InventoryUpdate::$STATUS as $key=>$text):?>
                        <option value="<?=$key?>" <?=$status ==$key ? "selected":""?>><?=$text?></option>
                        <?php endforeach;?>
                    </select>

                    <input type="submit" value="提交" class="btn btn-sm btn-success">
                </form>
                <button class="btn-primary btn btn-sm" onclick="location.href='/inventory/record';">重置</button>

                <button class="btn-warning btn btn-sm" onclick="new_listing()">新增记录</button>

                <form action="/inventory/upload_file" method="post" enctype="multipart/form-data" style="display: inline-block;">
                    <span>导入文件</span>
                    <input type="file" name="file" value="wen" class="form-file normal-input-text">
                    <input type="submit" value="导入" class="btn btn-sm btn-success">
                    <a class="btn btn-warning btn-sm" href="/inventory/download_inventory_example">下载例子</a>
                </form>

            </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>价格</th>
                    <th>渠道</th>
                    <th>仓库</th>
                    <th>状态</th>
                    <th>操作者</th>
                    <th colspan="2" style="text-align: center">操作</th>
                </tr>
                </thead>
                <?php foreach($records as $record):?>
                    <tr>
                        <td><?=$record->sku?></td>
                        <td><?=$record->qty?></td>
                        <td><?=$record->price?></td>
                        <td><?=InventoryUpdate::$CHANNELS[$record->channel]?></td>
                        <td><?=$record->warehouse?></td>
                        <td><?=$record->status?></td>
                        <td><?=$record->operator?></td>
                        <td>
                            <?php if($record->status == "init"):?>
                            <a style="cursor: pointer" onclick="confirm_paid(<?=$record->id?>)" class="btn btn-success btn-sm">确认已付款</a>
                            <a href="/inventory/record_edit?id=<?=$record->id?>" class="btn btn-warning btn-sm">编辑记录</a>

                            <a STYLE="cursor: pointer" onclick="delete_listing(<?=$record->id?>)" class="btn btn-danger btn-sm">删除记录</a>

                            <?php endif;?>
                            <a target="_blank" href="/inventory/record_view?id=<?=$record->id?>" class="btn btn-primary btn-sm">查看</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>


</div>
<script>

    function confirm_paid(id){
        if(confirm("确认已付款并收到货?")){
            location.href="/inventory/confirm_paid?id="+id;
        }
    }
    function delete_listing(id){
        if(confirm("确认要删除这条记录么?")){
            location.href="/inventory/record_delete?id="+id;
        }
    }
    function new_listing() {
        location.href='/inventory/record_new';
    }
</script>