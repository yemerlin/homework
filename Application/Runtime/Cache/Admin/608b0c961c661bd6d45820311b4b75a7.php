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



<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/merlin/index.php/Admin/Goods/edit/id/3.html" method="post">
        	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" size="60" value="<?php echo ($data['goods_name']); ?>" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                        <img src="/merlin/Public/Uploads/<?php echo ($data['m_logo']); ?>"/>
                    <td class="label">LOGO：</td>
                    <td>
                    <input type="file" name="logo" size="60" /></td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo ($data['market_price']); ?>" size="20" />
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ($data['shop_price']); ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="是" <?php if($data['is_on_sale']=='是'): ?>checked=checked<?php endif; ?> /> 是
                        <input type="radio" name="is_on_sale" value="否" <?php if($data['is_on_sale']=='否'): ?>checked=checked<?php endif; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo ($data['goods_desc']); ?></textarea>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="hidden" name="id" value="<?php echo ($data['id']); ?>" size="20"/>
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>


























<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>