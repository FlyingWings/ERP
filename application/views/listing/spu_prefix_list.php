<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th>产品分类(SPU前缀)</th>
            <th>产品名</th>

        </tr>
        </thead>
        <?php foreach($spu_prefix_lists as $listing):?>
            <tr>
                <td><?=$listing->spu_prefix?></td>
                <td><?=$listing->name?></td>
            </tr>
        <?php endforeach;?>
    </table>

</div>