<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Cate/lists')?>?act=list">商品分类</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加商品分类 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="" method="post" name="theForm">
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">分类名称:</td>
				<td><input type="text" name="cate_name" maxlength="20" size="27" placeholder="字母数字下划线或汉字"></td>
			</tr>
			<tr>
				<td class="label">上级分类:</td>
				<td>
					<select name="cate_path" class="select">
						<option value="0">顶级分类</option>
						<?php foreach($cate as $val):?>
							<option value="<?=$val['full_path']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;",substr_count($val['full_path'],',')).$val['cate_name']?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>

			<tr id="measure_unit">
				<td class="label">数量单位:</td>
				<td><input type="text" name="cate_dan" size="12" placeholder="请输入单位"></td>
			</tr>
			<tr>
				<td class="label">排序:</td>
				<td><input type="text" name="cate_order" size="15" placeholder="可填可不填哦"></td>
			</tr>

			<tr>
				<td class="label">是否显示:</td>
				<td><input type="radio" name="cate_show" value="1" checked > 是<input type="radio" name="cate_show" value="0"> 否  </td>
			</tr>
			<tr>
				<td class="label">是否显示在导航栏:</td>
				<td><input type="radio" name="cate_nav" value="1" checked> 是  <input type="radio" name="cate_nav" value="0"> 否    </td>
			</tr>
      <tr>
        <td class="label">分类描述:</td>
        <td>
          <textarea name="cate_content" rows="6" cols="48" id="content"></textarea>
			<span>您还可以输入：<font color='red'><b id="sp_content">50</b></font>个字</span>
        </td>
      </tr>
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
  </form>
</div>
</div>
</body>
</html>
<script>
	$(function(){
		/**
		 * 定义对象属性来阻止表单提交
		 */
		 var validata={
				checkName:false,
				checkDan:false,
		};
		/**
		 * 分类名称的失焦事件
		 */
		$("input[name='cate_name']").blur(function(){
			var _this=$(this);
			var cate_name=_this.val();
			if(cate_name==""){
				validata.checkName=false;
				_this.next().remove();
				_this.after("<font color='red'>*</font>");
			}else{
				//定义汉字字母下划线正则
				var reg1=/^[\u4e00-\u9fa5]+$/
				var reg2=/^\w+$/
				if(reg1.test(cate_name)||reg2.test(cate_name)){
					validata.checkName=true;
					_this.next().remove();
					_this.after("<font color='green'>√</font>");
				}else{
					validata.checkName=false;
					_this.next().remove();
					_this.after("<font color='red'>您输入的格式不对哦~</font>");
				}
			}
		});
		/**
		 * 数量单位失焦事件
		 */
		$("input[name='cate_dan']").blur(function(){
			var _this=$(this);
			var cate_dan=_this.val();
			if(cate_dan==""){
				validata.checkDan=false;
				_this.next().remove();
				_this.after("<font color='red'>*</font>");
			}else{
				//定义汉字正则
				var reg=/^[\u4e00-\u9fa5]+$/
				if(reg.test(cate_dan)){
					validata.checkDan=true;
					_this.next().remove();
					_this.after("<font color='green'>√</font>");
				}else{
					validata.checkDan=false;
					_this.next().remove();
					_this.after("<font color='red'>必须为汉字哦~</font>");
				}
			}
		});
		/**
		 * 内容
		 */
		$("#content").keyup(function(){
			var content=$("#content").val();
			if(content.length<=50){
				$("#sp_content").html(50-content.length);
			}else{
				$("#content").val(content.substr(0,50));
			}
		});
		$(":submit").click(function(){
			$("input[name='cate_name']").trigger("blur");
			$("input[name='cate_dan']").trigger("blur");
			if(validata.checkName&&validata.checkDan){
				return true;
			}else{
				return false;
			}
		})
	})
</script>