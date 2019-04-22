<div class="container">
    <div class="panel-heading">
        <div class="col-md-12" style="display: inline-block;">
            <form action="/inventory" method="get" style="display: inline-block" class="col-md-9">
                <span>SKU</span> <input type="text" name="sku" value="<?=$sku?>" class="form-control normal-input-text">
                <select name="warehouse" onchange="this.form.submit()" class="form-control normal-input-text" style="margin-right: 20px">
                    <option value="0">仓库位置</option>
                    <?php foreach($warehouses as $line):?>
                    <option value="<?=$line?>" <?=$line == $warehouse ?"selected" : ""?>><?=$line?></option>
                    <?php endforeach;?>
                </select>


                <input type="submit" value="提交" class="btn btn-sm btn-success">
                <button class="btn-primary btn btn-sm" onclick="location.href='/inventory?';">重置</button>

            </form>

        </div>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>SKU</th>
                <th>Qty</th>
                <th>仓库位置</th>
            </tr>
            </thead>
            <?php foreach($inventories as $record):?>
                <tr>
                    <td><?=$record->sku?></td>
                    <td><?=$record->qty?></td>
                    <td><?=$record->warehouse?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>


</div>