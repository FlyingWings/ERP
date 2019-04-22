<div class="container">
    <div class="panel">
        <div class="panel-heading">

            <div class="col-md-12">

            </div>
        </div>
        <div class="panel-body">
            <form action="/listing/edit" method="post">
                <input type="hidden" value="<?=$listing->id?>" name="id">
                <table class="table">
                    <tr>
                        <td>产品SKU</td>
                        <td><input type="text" value="<?=$listing->sku?>" name="sku" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>产品主图链接</td>
                        <td><input type="text" value="<?=$listing->primary_image_path?>" name="primary_image_path" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>产品名称</td>
                        <td><input type="text" value="<?=$listing->name?>" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>产品SPU</td>
                        <td><input type="text" value="<?=$listing->spu?>" name="spu" class="form-control"></td>
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