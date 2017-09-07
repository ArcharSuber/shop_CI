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
	<span class="action-span"><a href="<?php echo site_url('Admin/Order/lists');?>?act=list">订单列表</a></span>
	<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 订单管理 </span><span class="action-span1" style="font-size: 12px; line-height: 20px;"> - 订单信息添加 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab body -->
    <div id="tabbody-div">
      <form action="<?php echo site_url('Admin/Admin/add');?>" method="post" name="theForm">
        <table width="35%" id="general-table" align="center" style="display: table;">
			<tr>
				<td class="label">订单号：</td>
				<td><input type="text" name="order_sn"><input type="button" value="获取订单号" id="order_sn"></td>
			</tr>
			<tr>
				<td class="label">用户ID：</td>
				<td><input type="text" name="user_id"></td>
			</tr>
			<tr>
				<td class="label">订单状态：</td>
				<td>
					<input type="radio" name="order_status" value="0">未确认
					<input type="radio" name="order_status" value="1">确认
					<input type="radio" name="order_status" value="2">已取消
					<input type="radio" name="order_status" value="3">无效
					<input type="radio" name="order_status" value="4">退货
				</td>
			</tr>
			<tr>
				<td class="label">配送情况：</td>
				<td>
					<input type="radio" name="shipping_status" value="0">未发货
					<input type="radio" name="shipping_status" value="1">已发货
					<input type="radio" name="shipping_status" value="2">已签收
					<input type="radio" name="shipping_status" value="3">配货中
					<input type="radio" name="shipping_status" value="4">退货
				</td>
			</tr>
			<tr>
				<td class="label">支付状态：</td>
				<td>
					<input type="radio" name="pay_status" value="0">未付款
					<input type="radio" name="pay_status" value="1">已付款
				</td>
			</tr>
			<tr>
				<td class="label">订单附言：</td>
				<td>
					<textarea name="message" id="message" cols="30" rows="10"></textarea>
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
		$("#order_sn").click(function(){
			$.ajax({url:"<?=site_url('Admin/Order/ajaxOrderSn')?>"+"?="+Math.random(),success:function(data){$("input[name='order_sn']").val(data)}})
		})
	})
</script>