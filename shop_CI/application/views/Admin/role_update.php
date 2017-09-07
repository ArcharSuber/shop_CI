<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 角色管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/')?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/')?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/')?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Role/lists');?>?act=list">角色列表</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 角色修改 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form method="post" name="theForm">
    <table cellspacing="1" cellpadding="3" width="100%">
      <tbody>
      <tr>
        <input type="hidden" value="<?=$role['role_id']?>" name="role_id">
      </tr>
      <tr>
        <td class="label">角色名称:</td>
        <td><input type="text" name="role_name" size="40" value="<?=$role['role_name']?>">
       </td>
      </tr>
      <tr>
        <td class="label">角色描述:</td>
        <td>
          <textarea name="role_desc" cols="30" rows="10"><?=$role['role_desc']?></textarea>
        </td>
      </tr>
      <tr>
        <td class="label">是否展示:</td>
        <td>
          <?php if($role['role_status']==0):?>
          <input type="radio" name="role_status" size="40" value="1">显示
          <input type="radio" name="role_status" size="40" value="0" checked>隐藏
          <?php else:?>
          <input type="radio" name="role_status" size="40" value="1" checked>显示
          <input type="radio" name="role_status" size="40" value="0">隐藏
          <?php endif;?>
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