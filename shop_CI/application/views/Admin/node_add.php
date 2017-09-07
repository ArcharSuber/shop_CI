<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 权限管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/Admin')?>/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/Admin')?>/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Node/lists');?>?act=list">权限列表</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限添加 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form method="post" name="theForm">
    <table cellspacing="1" cellpadding="3" width="100%">
      <tbody>
      <tr>
        <td class="label">权限父级:</td>
        <td>
          <select name="node_pid">
          <option value="0">顶级权限</option>
          <?php foreach($node as $v):?>
            <option value="<?=$v['node_id']?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['deep']).$v['node_name']?></option>
            <?php endforeach;?>
        </select>
        </td>
      </tr>
      <tr>
        <td class="label">权限名称:</td>
        <td><input type="text" name="node_name" size="40">
       </td>
      </tr>
      <tr>
        <td class="label">控制器名称:</td>
        <td><input type="text" name="node_controller" size="40">
          </td>
      </tr>
      <tr>
        <td class="label">方法名称:</td>
        <td><input type="text" name="node_action" size="40">
          </td>
      </tr>
      <tr>
        <td class="label">是否展示:</td>
        <td>
          <input type="radio" name="node_status" size="40" value="1">显示
          <input type="radio" name="node_status" size="40" value="0">隐藏
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <input type="submit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
        </td>
      </tr>
    </tbody></table>
  </form>
</div>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>