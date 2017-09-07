<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url(); ?>public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url();?>public/jquery-1.8.3.min.js"></script>
<style type="text/css">
body {
  color: white;
}
</style>

</head>
<body style="background: #278296">
<form action="<?php echo site_url('Admin/Login/login_do')?>" method="post">
  <table cellspacing="0" cellpadding="0" style="margin-top: 100px" align="center">
  <tr>
    <td><img src="<?php echo base_url();?>public/Admin/images/login.png" width="178" height="256" border="0" alt="ECSHOP" /></td>
    <td style="padding-left: 50px">
      <table>
      <tr>
        <td>管理员姓名：</td>
        <td><input type="text" name="admin_name" /></td>
      </tr>
      <tr>
        <td>管理员密码：</td>
        <td><input type="password" name="admin_pwd" /></td>
      </tr>
      <tr>
        <td>验证码：</td>
        <td><input type="text" name="code" class="capital" /></td>
      </tr>
      <tr>
      <td colspan="2" align="right"><img src="<?php echo site_url('Admin/login/code')?>" title="看不清？点击换张试试！" id="code" alt="无法加载验证码">
      </td>
      </tr>
        <tr>
          <td colspan="2"><span style="font-size: 10px;color: yellow">仅限于后台管理人员登录  闲等人请不要进入！！！</span></td>
        </tr>
      <tr><td>&nbsp;</td><td><input type="submit" value="进入管理中心" class="button" /></td></tr>
      </table>
    </td>
  </tr>
  </table>
</form>
</body>
<script>
  $(function(){
    $("#code").click(function(){
      $(this).attr("src","<?php echo site_url('Admin/login/code')?>?="+Math.random())
    })
  })
</script>