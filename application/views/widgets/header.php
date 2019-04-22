<html>
    <head>
        <meta charset="utf-8">
        <title><?=@$title ?: "康蒂斯ERP"?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/main.css?time=<?=time()?>">
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    </head>
    <body>

    <nav style="margin-bottom: 10px">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="/">首页</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">产品信息</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/listing">产品SKU列表</a>
                    <a class="dropdown-item" href="/listing/spu">产品SPU列表</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/listing/spu_prefix_list">产品分类</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">订单信息</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/inbound_order">入库订单</a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="/outbound_order/pdd">拼多多订单</a>
                    <a class="dropdown-item" href="/outbound_order/ali1688">1688订单</a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?=$title=="库存记录"?"active":""?>"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">库存信息</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/inventory">库存列表</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/inventory/record">库存变动记录</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/files">文件管理</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/info">相关信息</a>
            </li>

            <li class="nav-item">
                <a class="nav-lin disabled" href="#"></a>
            </li>
        </ul>
    </nav>
