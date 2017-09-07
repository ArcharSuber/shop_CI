<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="<?php echo base_url('public/Admin/styles/');?>general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('public/Admin/styles/');?>main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 要转移商品的列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
<span><input type="button" class="button" value="返回上层" onclick="return window.history.go(-1)"></span>
</div>

<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <!-- start goods list -->
	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
			<tbody>
				<tr>
					<th align="left"><input type="checkbox" id="all">编号</th>
					<th>商品名称</th>
					<th>货号</th>
					<th>价格</th>
					<th>上架</th>
					<th>精品</th>
					<th>新品</th>
					<th>热销</th>
					<th>推荐排序</th>
					<th>库存</th>
					<th>操作</th>
				</tr>
				<?php foreach($data as $k=>$v):?>
				<tr>
					<td><input type="checkbox" value="<?=$v['goods_id']?>"><?=$v['goods_id']?></td>
					<td class="first-cell"><span><?=$v['goods_name']?></span></td>
					<td><span><?=$v['goods_sn']?></span></td>
					<td align="right"><span><?=$v['shop_price']?></span></td>
					<td align="center">
						<?php if($v['is_on_sale']==1):?>
						<img src="<?php echo base_url('public/Admin/images/');?>yes.gif">
						<?php else:?>
						<img src="<?php echo base_url('public/Admin/images/');?>no.gif">
						<?php endif;?>
					</td>
					<td align="center">
						<?php if($v['is_best']==1):?>
							<img src="<?php echo base_url('public/Admin/images/');?>yes.gif">
						<?php else:?>
							<img src="<?php echo base_url('public/Admin/images/');?>no.gif">
						<?php endif;?>
					</td>
					<td align="center">
						<?php if($v['is_new']==1):?>
							<img src="<?php echo base_url('public/Admin/images/');?>yes.gif">
						<?php else:?>
							<img src="<?php echo base_url('public/Admin/images/');?>no.gif">
						<?php endif;?>
					</td>
					<td align="center">
						<?php if($v['is_hot']==1):?>
							<img src="<?php echo base_url('public/Admin/images/');?>yes.gif">
						<?php else:?>
							<img src="<?php echo base_url('public/Admin/images/');?>no.gif">
						<?php endif;?>
					</td>
					<td align="center"><span><?=$v['goods_order']?></span></td>
					<td align="right"><span><?=$v['goods_number']?></span></td>
					<td align="center">
						<a href="<?=site_url('Admin/Goods/goods_showInfo/').$v['goods_id']?>" target="_blank" title="查看"><img src="<?php echo base_url('public/Admin/images/');?>icon_view.gif" width="16" height="16" border="0"></a>
						<a href="<?=site_url('Admin/Goods/update/').$v['goods_id']?>" title="编辑"><img src="<?php echo base_url('public/Admin/images/');?>icon_edit.gif" width="16" height="16" border="0"></a>
						<a href="<?=site_url('Admin/Goods/Copy/').$v['goods_id']?>" title="复制"><img src="<?php echo base_url('public/Admin/images/');?>icon_copy.gif" width="16" height="16" border="0"></a>
						<a href="javascript:;" title="回收站"><img src="<?php echo base_url('public/Admin/images/');?>icon_trash.gif" width="16" height="16" border="0"></a>
						<a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="<?php echo base_url('public/Admin/images/');?>icon_docs.gif" width="16" height="16" border="0"></a>
					</td>
				</tr>
			<?php endforeach;?>
  </tbody>
 </table>
<!-- end goods list -->
</div>
<div>
</div>
</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - 
</div>
<script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</body>
</html>
<script>
	$(function(){
		$("#all").click(function(){
			$(":checkbox").prop("checked",$(this).prop("checked"))
		});
		$("#pageSize").blur(function(){
			$("#page_num").val($(this).val());
		})
	})
</script>