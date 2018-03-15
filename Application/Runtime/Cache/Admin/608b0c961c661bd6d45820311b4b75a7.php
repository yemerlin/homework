<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo ($title_name); ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/merlin/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/merlin/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/merlin/Public/Admin/Styles/page.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/merlin/Public/Admin/Js/jquery-3.1.1.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('list');?>"><?php echo ($list_name); ?></a>
    </span>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"><a href="<?php echo U('add');?>">&nbsp;<?php echo ($add_name); ?></a></span>
    <div style="clear:both"></div>
</h1>



<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back" >会员价格</span>
            <span class="tab-back" >商品描述</span>
            <span class="tab-back" >商品属性</span>
            <span class="tab-back" >商品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/merlin/index.php/Admin/Goods/edit/id/21.html" method="post">
        	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            <table width="90%" class="tab_table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" size="60" value="<?php echo ($data['goods_name']); ?>" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">品牌名称：</td>
                    <td>
                        <select name="brand_id">
                                <option value="">请选择</option>
                            <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["brand_id"]); ?>" <?php if($data['brand_id'] == $v['brand_id']): ?>selected=selected<?php endif; ?> ><?php echo ($v["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
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
                        <input type="text" name="market_price" value="<?php echo ($data['market_price']); ?>" size="18" />
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ($data['shop_price']); ?>" size="18"/>
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
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <?php if(is_array($m_list)): foreach($m_list as $k=>$v): ?><tr>
                    <td class="label"><?php echo ($v["level_name"]); ?>：￥</td>
                    <td>
                        <input type="text" name="member_price[<?php echo ($v["level_id"]); ?>]"   value="<?php echo ($mp_data[$v['level_id']]); ?>" size="15"/>
                    </td>
                </tr><?php endforeach; endif; ?>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo ($data['goods_desc']); ?></textarea>
                    </td>
                </tr>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr><td>商品属性</td></tr>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr><td>商品相册</td></tr>
            </table>
            <div class="button-div">
                <input type="hidden" name="id" value="<?php echo ($data['id']); ?>" size="20"/>
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#tabbar-div p span").click(function(){
        var i=$(this).index();
        $(".tab-front").removeClass("tab-front").addClass("tab-back");
        $(this).removeClass("tab-back").addClass("tab-front");
        $(".tab_table").hide().eq(i).show();
    })
</script>


























<div id="footer">
    Merlin
</div>
</body>
</html>