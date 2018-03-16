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

create table ye_member_level
(
	level_id mediumint unsigned not null auto_increment comment 'id',
	level_name varchar(30) not null comment '级别名称',
	jifen_bottom mediumint unsigned not null comment '积分下限',
	jifen_top mediumint unsigned not null comment '积分上限',
	primary key (level_id)
)engine=InnoDB default charset=utf8 comment '会员级别';

create table ye_member_price
(
	member_price decimal(10,2) not null comment '会员价格',
	level_id mediumint unsigned not null comment '级别Id',
	goods_id mediumint unsigned not null comment '商品Id',
	key level_id(level_id),
	key goods_id(goods_id)
)engine=InnoDB default charset=utf8 comment '会员价格';


create table ye_goods_pic
(
  pic_id mediumint unsigned not null auto_increment comment 'ID',
  goods_id mediumint unsigned not null  comment '商品id',
  pic VARCHAR(150) not null DEFAULT '' comment '原图',
  s_pic VARCHAR(150) not null DEFAULT '' comment '小图',
  m_pic VARCHAR(150) not null DEFAULT '' comment '中图',
  l_pic VARCHAR(150) not null DEFAULT '' comment '大图',
  primary KEY (pic_id),
  KEY goods_id(goods_id)
)engine=InnoDB DEFAULT charset=utf8 comment '商品相册';


