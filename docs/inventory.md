库存
===
1. 库存
    - sku
    - qty
    - warehouse
2. 库存更新
    - sku
    - price
    - warehouse
    - 状态

订单
=== 
1. outbound_orders
    - 收件人信息
    - 收件人地址
    - 订单ID
    - 平台信息
    - 卖家ID
2. outbound_order_items
    - sku
    - price
    - qty
    - 运费等
    
3. inbound_order
    - 来源
    - 时间等
    - 来源图
    
4. inbound_order_item
    - sku
    - qty
    - price
    - warehouse: 送到哪个仓库
    - 来源
    - 创建一个inventory_update, 并记录id
    
    