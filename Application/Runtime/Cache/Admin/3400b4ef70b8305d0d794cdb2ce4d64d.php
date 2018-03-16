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


<div class="form-div">
    <form action="" name="searchForm">
    <img src="/merlin/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="brand_name" size="15" />
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>品牌编号</th>
                <th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌描述</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                <td class="first-cell" align="center">
                    <span><?php echo ($v["brand_id"]); ?><a href="" target="_brank"><img style="float: right" src="/merlin/Public/Uploads/<?php echo ($v['brand_logo']); ?>" width="16" height="16" border="0" /></a></span>
                    <!--<span><img src="" </span>-->
                </td>

                <td align="center"><?php echo ($v["brand_name"]); ?></td>
                <td align="center">
                    <a href="<?php echo ($v["brand_url"]); ?>" target="_brank"><?php echo ($v["brand_url"]); ?></a>
                </td>
                <td align="center"><img src="" /><?php echo ($v["brand_desc"]); ?></td>

                <td align="center">
                <a href="<?php echo U('edit?brand_id='.$v['brand_id']);?>" title="编辑">编辑</a> |
                <a href="<?php echo U('delete?brand_id='.$v['brand_id']);?>" title="编辑" onclick="return confirm('确认删除？')">移除</a>
                </td>
            </tr><?php endforeach; endif; ?>
            <table id="page-table" cellspacing="0">
                <tr>
                    <td width="80%">&nbsp;</td>
                    <td align="center" nowrap="true">
                        <?php echo ($show); ?>
                    </td>
                </tr>
            </table>
    </div>
</form>


<div id="footer">
    Merlin
</div>
</body>
</html>