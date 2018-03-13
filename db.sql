CREATE database ye;
use ye;
set names utf8;

DROP table if exists ye_goods;
CREATE table ye_goods
(
    id int unsigned not null auto_increment comment 'ID',
    goods_name VARCHAR(150) NOT NULL comment '商品名称',
    market_price decimal(10,2) not null comment '市场价格',
    shop_price decimal(10,2) not null comment '本店价格',
    goods_desc longtext comment '商品描述',
    is_on_sale enum('是','否') not NULL DEFAULT '是' comment '是否上架',
    is_on_delete enum('是','否') not null DEFAULT '否' comment '是否放到回收站',
    addtime int not null comment '添加时间',
    PRIMARY KEY (id),
    key shop_price(shop_price),
    KEY addtime(addtime),
    key is_on_sale(is_on_sale)
)engine=InnoDB DEFAULT charset=utf8 comment '商品';