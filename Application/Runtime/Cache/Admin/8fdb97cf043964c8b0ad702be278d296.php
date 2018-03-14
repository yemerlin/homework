<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加新商品 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/merlin/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/merlin/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/merlin/Public/Admin/Styles/page.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('list');?>">商品列表</a>
    </span>
    <span class="action-span1"><a href="<?php echo U('index/index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"><a href="<?php echo U('add');?>">&nbsp;添加新商品</a></span>
    <div style="clear:both"></div>
</h1>


<div class="form-div">
    <form action="/merlin/index.php/Admin/Goods/list" name="searchForm">
        <img src="/merlin/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="20" value="<?php echo I('get.keyword') ?>" /><br>
        &nbsp;　　 价　格:从<input  type="text" name="p_low" size=5 value="<?php echo I('get.p_low') ?>"/> 到<input type="text" name="p_high" size=5 value="<?php echo I('get.p_high')?>"/>
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <!--<th>货号</th>-->
                <th>本店价格</th>
                <th>市场价格</th>
                <th>是否上架</th>
                <th>是否放入回收站</th>
                <th>修改商品</th>
                <th>删除商品</th>
                <!--<th>精品</th>-->
                <!--<th>新品</th>-->
                <!--<th>热销</th>-->
                <!--<th>推荐排序</th>-->
                <!--<th>库存</th>-->
                <!--<th>操作</th>-->
            </tr>
        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                <td align="center"><?php echo ($v["id"]); ?></td>
                <td align="center" class="first-cell"><span><?php echo ($v["goods_name"]); ?></span></td>
                <td align="center"><span onclick=""><?php echo ($v["shop_price"]); ?></span></td>
                <td align="center"><span><?php echo ($v["market_price"]); ?></span></td>
                <td align="center"><span><?php echo ($v["is_on_sale"]); ?></span></td>
                <td align="center"><span><?php echo ($v["is_on_delete"]); ?></span></td>
                <td align="center"><span><a href="<?php echo U('edit?id='.$v['id']);?>">修改</a></span></td>
                <td align="center" onclick="return confirm('确认删除？')" ><span><a href="<?php echo U('delete?id='.$v['id']);?>">删除</a></span></td>
            </tr><?php endforeach; endif; ?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo ($showPage); ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>


<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>