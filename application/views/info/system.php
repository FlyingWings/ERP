<div class="container">
    <div class="panel">
        <div class="panel-heading" style="margin-bottom: 20px">

        </div>
        <div class="panel-body">
                <table class="table">
                    <tr><th colspan="2" align="center">订单状态</th> </tr>
                    <?php foreach($status_map as $line=>$value):?>
                    <tr><td><?=$line?></td><td><?=$value?></td></tr>
                    <?php endforeach;?>
                    <tr><th colspan="2" align="center">订单渠道（在库存变动记录中的channel这栏中填写)</th> </tr>
                    <?php foreach($channels as $line=>$value):?>
                        <tr><td><?=$line?></td><td><?=$value?></td></tr>
                    <?php endforeach;?>
                </table>

        </div>
    </div>


</div>