<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h3>更新库存——<?=$listing->name?>——<?=$listing->sku?></h3>
        </div>
        <div class="panel-body">
            <form action="/inventory/insert_action" method="post">
                <input type="hidden" value="<?=$listing->id?>" name="listing_id">
                <input type="number" name="qty" class="form-control" placeholder="数量变动" required>
                <select name="channel" class="form-control" style="margin: 10px 0px 10px">
                    <option value="inbound_default">补货进仓</option>
                    <option value="pdd">拼多多出货</option>
                    <option value="1688">1688出货</option>
                </select>
                <input name="cost" class="form-control" placeholder="价格">
                <input type="submit" class="btn btn-success" value="保存">
            </form>
        </div>
    </div>
</div>