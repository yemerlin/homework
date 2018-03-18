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


create table ye_category
(
 cat_id mediumint unsigned not null auto_increment comment 'ID',
 cat_name VARCHAR(150) not null comment '分类名称',
 parent_id mediumint unsigned not null DEFAULT '0' comment '父类ID',
 PRIMARY KEY (cat_id)
)engine=InnoDB DEFAULT charset=utf8 comment '分类';


INSERT INTO `ye_category` (`cat_id`, `cat_name`, `parent_id`) VALUES
(1, '家用电器', 0),
(2, '手机、数码、京东通信', 0),
(3, '电脑、办公', 0),
(4, '家居、家具、家装、厨具', 0),
(5, '男装、女装、内衣、珠宝', 0),
(6, '个护化妆', 0),
(21, 'iphone', 2),
(8, '运动户外', 0),
(9, '汽车、汽车用品', 0),
(10, '母婴、玩具乐器', 0),
(11, '食品、酒类、生鲜、特产', 0),
(12, '营养保健', 0),
(13, '图书、音像、电子书', 0),
(14, '彩票、旅行、充值、票务', 0),
(15, '理财、众筹、白条、保险', 0),
(16, '大家电', 1),
(17, '生活电器', 1),
(18, '厨房电器', 1),
(19, '个护健康', 1),
(20, '五金家装', 1),
(22, '冰箱', 16);


CREATE TABLE ye_goods_cat
(
  gc_id mediumint unsigned not null auto_increment comment "ID",
  goods_id mediumint unsigned not null comment "商品id",
  cat_id mediumint unsigned not null comment "分类id",
  PRIMARY KEY (gc_id),
  key goods_id(goods_id),
  key cat_id(cat_id)
)engine=InnoDB DEFAULT charset=utf8 comment "商品-扩展分类";

