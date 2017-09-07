<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="<?php echo base_url('public/Admin/styles/');?>general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('public/Admin/styles/');?>main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>utils.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>selectzone.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>colorselector.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
	<span class="action-span"><a href="<?php echo site_url('Admin/Admin/lists');?>?act=list">管理员列表</a></span>
	<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 权限管理 </span><span class="action-span1" style="font-size: 12px; line-height: 20px;"> - 管理员添加 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab body -->
    <div id="tabbody-div">
      <form action="<?php echo site_url('Admin/Admin/add');?>" method="post" name="theForm">
        <table width="35%" id="general-table" align="center" style="display: table;">
				<tr>
					<td class="label">管理员：</td>
					<td><input type="text" name="admin_name" placeholder="请输入姓名2-3位汉字" id="account"></td>
				</tr>
				<tr>
					<td class="label">密码： </td>
					<td><input type="password" name="admin_pwd" placeholder="请输入密码" id="pwd"><br></td>
			</tr>
			<tr>
				<td class="label">确认密码：</td>
				<td><input type="password" name="pwd2" placeholder="请输入确认密码" id="pwd2"></td>
			</tr>
			<tr>
				<td class="label">性别：</td>
				<td>&nbsp;&nbsp;<input type="radio" name="admin_sex" value="男" class="sex">&nbsp;&nbsp;男
					&nbsp;&nbsp;<input type="radio" name="admin_sex" value="女" class="sex">&nbsp;&nbsp;女&nbsp;&nbsp;<span color='gray' id="sex">*</span>
				</td>
			</tr>
            <tr>
				<td class="label">年龄：</td>
				<td><input type="text" name="admin_age" style="width: 80px;" placeholder="请输入年龄" id="age">岁&nbsp;&nbsp;<span color='gray' id="sp_age">*</span></td>
			</tr>
            <tr>
				<td class="label">族别：</td>
				<td><input type="text" name="admin_zu" style="width: 80px;" placeholder="请输入族籍" id="a_zu">族&nbsp;&nbsp;<span color='gray' id="sp_zu">*</span>
				</td>
			</tr>
			<tr>
            <td class="label">手机号：</td>
            <td><input type="text" name="admin_tel" placeholder="请输入手机号11位" id="a_tel"></td>
          </tr>

          <tr>
            <td class="label">座机号：</td>
            <td><input type="text" name="admin_sit_tel" placeholder="座机号如010-12345678" id="sit">
            </td>
          </tr>
          <tr>
            <td class="label"> 住址：</td>
            <td id="promote_3"><input type="text" name="admin_address" placeholder="请输入住址" id="address"></td>
          </tr>
          <tr id="promote_4">
            <td class="label" id="promote_5">邮箱：</td>
            <td id="promote_6">
              <input type="text" name="admin_email" placeholder="xin123@qq.com|cn|edu" id="email">
            </td>
          </tr>
			<tr id="promote_5">
				<td class="label" id="promote_5">角色：</td>
				<td id="promote_6">
					<?php foreach($role as $val):?>
						<input type="checkbox" value="<?=$val['role_id']?>" name="role_id[]"><span style="color: red"><strong><?=$val['role_name']?></strong></span>
					<?php endforeach;?>
				</td>
			</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value=" 添加 " class="button">
						<input type="reset" value=" 重置 " class="button"></td>
				</tr>
		</table>
      </form>
    </div>
</div>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - 
</div>
</body>
</html>
<script>
	$(function(){
		var validata={
			checkName:false,
			checkPwd:false,
			checkPwd2:false,
			checkSex:false,
			checkAge:false,
			checkZu:false,
			checkTel:false,
			checkSit:false,
			checkAddress:false,
			checkEmail:false
		};
		/**
		 * 名字失焦事件
		 */
		$("#account").blur(function(){
			var _this=$(this);
			var name=_this.val()
			//定义正则
			var han=/^[\u4e00-\u9fa5]{2,3}$/;
			if(name==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else if(!han.test(name)){
				_this.next().remove();
				_this.after("<span class='require-field'>2-3位汉字</span>")
			}else{
				validata.checkName=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 密码失焦事件
		 */
		$("#pwd").blur(function(){
			var _this=$(this);
			var pwd=_this.val();
			if(pwd==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else{
				validata.checkPwd=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 确认密码失焦事件
		 */
		$("#pwd2").blur(function(){
			var _this=$(this);
			var pwd2=_this.val();
			var pwd=$("#pwd").val();
			if(pwd2==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else if(pwd2!=pwd){
				_this.next().remove();
				_this.after("<span class='require-field'>密码不一致</span>")
			}else{
				validata.checkPwd2=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 性别点击事件
		 */
		$(".sex").click(function(){
			validata.checkSex=true;
			$("#sex").css("color","green");
			$("#sex").html("√")
		});
		/**
		 * 年龄失焦事件
		 */
		$("#age").blur(function(){
			var age=$("#age").val()
			//定义正则
			var reg=/^\d{1,3}$/
			if(age==""){
				$("#sp_age").css("color","red");
				$("#sp_age").html("*");
			}else if(!reg.test(age)){
				$("#sp_age").css("color","red");
				$("#sp_age").html("您的年龄在3位数字以内哦")
			}else{
				validata.checkAge=true;
				$("#sp_age").css("color","green");
				$("#sp_age").html("√")
			}
		});
		/**
		 * 族籍失焦事件
		 */
		$("#a_zu").blur(function(){
			var zu=$("#a_zu").val();
			//定义正则
			var reg=/^[\u4e00-\u9fa5]{1,}$/
			if(zu==""){
				$("#sp_zu").css("color","red");
				$("#sp_zu").html("*");
			}else if(!reg.test(zu)){
				$("#sp_zu").css("color","red");
				$("#sp_zu").html("族籍全为汉字哦")
			}else{
				validata.checkZu=true;
				$("#sp_zu").css("color","green");
				$("#sp_zu").html("√")
			}
		});
		/**
		 * 手机号失焦事件
		 */
		$("#a_tel").blur(function(){
			var _this=$(this);
			var tel=$("#a_tel").val();
			//定义正则
			var reg=/^\d{11}$/
			if(tel==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else if(!reg.test(tel)){
				_this.next().remove();
				_this.after("<span class='require-field'>11位纯数字</span>")
			}else{
				validata.checkTel=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 座机号失焦事件
		 */
		$("#sit").blur(function(){
			var _this=$(this);
			var tel=$("#sit").val();
			//定义正则
			var reg=/^\d{3}-\d{8}$/
			if(tel==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else if(!reg.test(tel)){
				_this.next().remove();
				_this.after("<span class='require-field'>格式必须为010-12345678的格式</span>")
			}else{
				validata.checkSit=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 住址失焦事件
		 */
		$("#address").blur(function(){
			var _this=$(this);
			var address=$("#address").val();
			if(address==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else{
				validata.checkAddress=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 邮箱失焦事件
		 */
		$("#email").blur(function(){
			var _this=$(this);
			var email=$("#email").val();
			//定义正则
			var reg=/^\w+@\w+(\.)(com|cn|edu)$/;
			if(email==""){
				_this.next().remove();
				_this.after("<span class='require-field'>*</span>")
			}else if(!reg.test(email)){
				_this.next().remove();
				_this.after("<span class='require-field'>邮箱格式不正确</span>")
			}else{
				validata.checkEmail=true;
				_this.next().remove();
				_this.after("<span style='color: green'>√</span>")
			}
		});
		/**
		 * 提交点击事件
		 */
		$(":submit").click(function(){
			$("#account").trigger("blur");
			$("#pwd").trigger("blur");
			$("#pwd2").trigger("blur");
			$("#age").trigger("blur");
			$("#a_zu").trigger("blur");
			$("#a_tel").trigger("blur");
			$("#sit").trigger("blur");
			$("#address").trigger("blur");
			$("#email").trigger("blur");
			if(validata.checkName&&validata.checkPwd&&validata.checkPwd2&&validata.checkSex&&validata.checkAge&&validata.checkZu&&validata.checkTel&&validata.checkSit&&validata.checkAddress&&validata.checkEmail){
				return true;
			}else{
				return false;
			}
		})
	})
</script>