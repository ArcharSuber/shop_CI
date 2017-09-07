<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 转移商品 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Goods/removeGoodsLists/').$str?>">转移商品列表</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品转移 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
	<form method="post">
		<input type="hidden" value="<?=$str?>" name="cate_str">
		<table>
			<tr>
				<td class="label">请选择转移的分类:</td>
				<td>
					<select name="cate_id" class="select">
						<option value="0">----请选择分类----</option>
						<?php foreach($cate as $val):?>
							<option value="<?=$val['cate_id']?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;",substr_count($val['full_path'],',')).$val['cate_name']?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">商品总数量:</td>
				<td>
					<span><?=$num?></span>
				</td>
			</tr>
			<tr>
				<td class="label"><input type="submit" value="转移"></td>
				<td>
					<input type="button" onclick="return window.history.go(-1)" value="返回">
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>