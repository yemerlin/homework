<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心- <?php echo ($title_name); ?> </title>
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
    <span class="action-span1"><a href="<?php echo U('Index/index');?>">ECSHOP 管理中心&nbsp;</a></span>
    <span id="search_id" class="action-span1" style="border: 1px solid red;background: yellowgreen"><a href="<?php echo U('add');?>">&nbsp;<?php echo ($add_name); ?></a></span>
    <div style="clear:both"><?php echo ($title_name); ?></div>
</h1>


<div class="main-div">
    <form method="post" action="/merlin/index.php/Admin/Category/add.html"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">分类名称</td>
                <td>
                    <input type="text" name="cat_name" maxlength="60" value="" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">父级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">请选择</option>
                        <?php if(is_array($cats)): foreach($cats as $key=>$v): ?><option value="<?php echo ($v['cat_id']); ?>"><?php echo str_repeat('-',4*$v['level']);; echo ($v['cat_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                    <span class="require-field">*</span>
                </td>
            </tr>


            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>


<div id="footer">
    Merlin
</div>
</body>
</html>