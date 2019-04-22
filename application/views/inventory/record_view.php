<div class="container">
    <div class="panel">
        <div class="panel-heading" style="margin-bottom: 20px">
            <div class="col-md-12">
                <a href="/inventory/record" class="btn btn-primary btn-sm">返回</a>
            </div>
        </div>
        <div class="panel-body">
            <form action="/inventory/record_new" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td>产品SKU</td>
                        <td><?=$record->sku?></td>
                    </tr>
                    <tr>
                        <td>产品数量</td>
                        <td><?=$record->qty?></td>

                    </tr>
                    <tr>
                        <td>产品价格</td>
                        <td>￥<?=$record->price?></td>

                    </tr>
                    <tr>
                        <td>渠道</td>
                        <td>
                            <?=InventoryUpdate::$CHANNELS[$record->channel]?>
                        </td>
                    </tr>
                    <tr>
                        <td>仓库</td>
                        <td><?=$record->warehouse?></td>
                    </tr>

                    <tr>
                        <td>相关文件记录</td>
                        <td><?php $files = explode(";", $record->files_related);$files=array_filter($files);
                            foreach($files as $file):?>
                            <a href="<?=trim($file)?>" target="_blank"><img style="max-height: 100px;max-width: 100px;" src="<?=trim($file)?>"></a>
                            <?php endforeach;?>
                        </td>
                    </tr>


                </table>
            </form>

        </div>
    </div>


</div>