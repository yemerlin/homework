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


DROP table if exists ye_brands;
create table ye_brands
(
  brand_id mediumint unsigned not null auto_increment comment 'id',
  brand_name VARCHAR(150) not null comment '品牌名称',
  brand_logo VARCHAR(150) not null DEFAULT '' comment '品牌图标',
  brand_url VARCHAR (150) not null DEFAULT '' comment '品牌网址',
  primary key(brand_id)
)engine=InnoDB DEFAULT charset=utf8 comment '品牌';

ALTER table ye_goods add brand_id mediumint not null DEFAULT '' comment 'brand_id';


