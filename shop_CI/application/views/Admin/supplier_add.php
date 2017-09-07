<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 供货商管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Supplier/lists')?>?act=list">供货商列表</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加供货商 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
<form method="post" action="" name="theForm">
<table cellspacing="1" cellpadding="3" width="100%">
  <tbody><tr>
    <td class="label">供货商名称</td>
    <td><input type="text" name="supplier_name" maxlength="60" placeholder="数字字母下划线或汉字"></td>
  </tr>
  <tr>
    <td class="label">供货商描述</td>
    <td><textarea name="supplier_desc" cols="60" rows="4" id="content"></textarea>
      <span>您还可以输入：<font color='red'><b id="sp_content">50</b></font>个字</span>
    </td>
  </tr>
  <tr>
    <td class="label">是否显示</td>
    <td><input type="radio" name="supplier_show" value="1" checked="checked"> 是
      <input type="radio" name="supplier_show" value="0"> 否
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>
      <input type="submit" class="button" value=" 确定 ">
      <input type="reset" class="button" value=" 重置 ">
    </td>
  </tr>
</tbody></table>
</form>
</div>
</body>
</html>
<script>
  $(function(){
    /**
     * 内容
     */
    $("#content").keyup(function() {
      var content = $("#content").val();
      if (content.length <= 50) {
        $("#sp_content").html(50 - content.length);
      } else {
        $("#content").val(content.substr(0, 50));
      }
    })
    });
</script>