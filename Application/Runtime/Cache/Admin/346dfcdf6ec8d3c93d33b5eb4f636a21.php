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
        <form enctype="multipart/form-data" action="/merlin/index.php/Admin/Goods/add.html" method="post">
            <table width="90%" class="tab_table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="g_name" size="60" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">品牌名称：</td>
                    <td>
                        <select  name="brand_id">
                                <option value="">请选择</option>
                            <?php if(is_array($data)): foreach($data as $key=>$v): ?><option value="<?php echo ($v["brand_id"]); ?>"><?php echo ($v["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>

                </tr>
                <tr>
                    <td class="label">LOGO：</td>
                    <td><input type="file" name="logo" size="60" /></td>
                </tr>
                <tr>
                    <td class="label">市场售价:￥</td>
                    <td>
                        <input type="text" name="gm_price" value="0" size="18" />
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价:￥</td>
                    <td>
                        <input type="text" name="gs_price" value="0" size="18"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="gis_on_sale" value="是" checked="checked" /> 是
                        <input type="radio" name="gis_on_sale" value="否" /> 否
                    </td>
                </tr>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <?php if(is_array($level)): foreach($level as $key=>$v): ?><tr>
                    <td class="label"><?php echo ($v["level_name"]); ?>:￥</td>
                    <td><input type="text" name="member_price[<?php echo ($v["level_id"]); ?>]" size="15" /></td>
                </tr><?php endforeach; endif; ?>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <textarea id="goods_desc" name="g_desc"></textarea>
                    </td>
                </tr>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr><td>商品属性</td></tr>
            </table>
            <table width="90%" class="tab_table" align="center" style="display: none;">
                <tr><td>
                    <input id="p_btn" type="button" value="添加图片" />
                    <ul id="p_ul"></ul>
                </td></tr>
            </table>
            <div class="button-div">
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
    $("#p_btn").click(function(){
        var file="<li><input type='file' name='pic[]'/></li>";
        $("#p_ul").append(file);
    })
</script>



























<div id="footer">
    Merlin
</div>
</body>
</html>