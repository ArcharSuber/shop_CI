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
	<span class="action-span"><a href="<?php echo site_url('Admin/Order/add');?>">添加订单信息</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="<?php echo base_url('public/Admin/images/');?>icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
	<!-- 关键字 -->
		关键字 <input type="text" name="keyword" size="15" placeholder="">
		<input type="submit" value=" 搜索 " class="button">
  </form>
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
				<?php foreach($goods['data'] as $k=>$v):?>
				<tr id="<?=$v['goods_id']?>" class="boboTr">
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
						<a href="javascript:void(0)" class="garbage" title="回收站"><img src="<?php echo base_url('public/Admin/images/');?>icon_trash.gif" width="16" height="16" border="0"></a>
<!--						<a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="--><?php //echo base_url('public/Admin/images/');?><!--icon_docs.gif" width="16" height="16" border="0"></a>          -->
					</td>
				</tr>
			<?php endforeach;?>
  </tbody>
 </table>
<!-- end goods list -->

	<!-- 分页 -->
	<table id="page-table" cellspacing="0">
		<tbody>
			<tr>
				<td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
					<!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
					<div id="turn-page">
						总计  <span id="totalRecords"><?=$goods['num']?></span>个记录分为 <span id="totalPages"><?=$goods['page_count']?></span>页当前第 <span id="pageCurrent"><?=$goods['page']?></span>
						页，每页 <input type="text" size="3" id="pageSize" value="<?=$goods['page_num']?>">
						<span id="page-link">
							<a href="javascript:;" id="pageFirst">第一页</a>
							<a href="javascript:;" id="pagePrev">上一页</a>
							<a href="javascript:;" id="pageNext">下一页</a>
							<a href="javascript:;" id="pageLast">最末页</a>
							<a href="javascript:;" id="selectChange" style="text-decoration: none"><input type="button" class="button" value="跳转到"></a>
							<select id="gotoPage">
								<?php for($i=1;$i<=$goods['page_count'];$i++):?>
									<?php if($goods['page']==$i):?>
								<option value="<?=$i;?>" selected><?=$i;?></option>
										<?php else:?>
										<option value="<?=$i;?>"><?=$i;?></option>
										<?php endif;?>
									<?php endfor;?>
							</select>
						</span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</form>
<form action="" method="post">
<div>
	<input type="hidden" name="id">
	<select name="type" id="selAction">
		<option value="">请选择...</option>
		<option value="garbage">放入回收站</option>
		<option value="on_sale">上架</option>
		<option value="not_on_sale">下架</option>
		<option value="best">精品</option>
		<option value="not_best">取消精品</option>
		<option value="new">新品</option>
		<option value="not_new">取消新品</option>
		<option value="hot">热销</option>
		<option value="not_hot">取消热销</option>
		<option value="move_to">转移到分类</option>
		<option value="supplier_move_to">转移到供货商</option>
	</select>
	<a href="javascript:;" style="text-decoration: none"><input type="submit" value=" 确定 " id="btnSubmit" class="button" disabled="true"></a>
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
		});
		$("#pageFirst").click(function(){
			var cate_id=$("select[name='cate_id']").val();
			var brand_id=$("select[name='brand_id']").val();
			var intro_type=$("select[name='intro_type']").val();
			var supplier_id=$("select[name='supplier_id']").val();
			var is_on_sale=$("select[name='is_on_sale']").val();
			var keyword=$("input[name='keyword']").val();
			var page=1;
			var page_num=$("#pageSize").val();
			$(this).attr("href","<?=site_url('Admin/Goods/lists?cate_id=')?>"+cate_id+"&brand_id="+brand_id+"&intro_type="+intro_type+"&supplier_id="+supplier_id+"&is_on_sale="+is_on_sale+"&keyword="+keyword+"&page="+page+"&page_num="+page_num);
		});
		$("#pageLast").click(function(){
			var cate_id=$("select[name='cate_id']").val();
			var brand_id=$("select[name='brand_id']").val();
			var intro_type=$("select[name='intro_type']").val();
			var supplier_id=$("select[name='supplier_id']").val();
			var is_on_sale=$("select[name='is_on_sale']").val();
			var keyword=$("input[name='keyword']").val();
			var page=$("#totalPages").html();
			var page_num=$("#pageSize").val();
			$(this).attr("href","<?=site_url('Admin/Goods/lists?cate_id=')?>"+cate_id+"&brand_id="+brand_id+"&intro_type="+intro_type+"&supplier_id="+supplier_id+"&is_on_sale="+is_on_sale+"&keyword="+keyword+"&page="+page+"&page_num="+page_num);
		});
		$("#pagePrev").click(function(){
			var cate_id=$("select[name='cate_id']").val();
			var brand_id=$("select[name='brand_id']").val();
			var intro_type=$("select[name='intro_type']").val();
			var supplier_id=$("select[name='supplier_id']").val();
			var is_on_sale=$("select[name='is_on_sale']").val();
			var keyword=$("input[name='keyword']").val();
			var page=$("#pageCurrent").html();
			if(page>1){
				page--;
			}
			var page_num=$("#pageSize").val();
			$(this).attr("href","<?=site_url('Admin/Goods/lists?cate_id=')?>"+cate_id+"&brand_id="+brand_id+"&intro_type="+intro_type+"&supplier_id="+supplier_id+"&is_on_sale="+is_on_sale+"&keyword="+keyword+"&page="+page+"&page_num="+page_num);
		});
		$("#pageNext").click(function(){
			var cate_id=$("select[name='cate_id']").val();
			var brand_id=$("select[name='brand_id']").val();
			var intro_type=$("select[name='intro_type']").val();
			var supplier_id=$("select[name='supplier_id']").val();
			var is_on_sale=$("select[name='is_on_sale']").val();
			var keyword=$("input[name='keyword']").val();
			var page=$("#pageCurrent").html();
			var page_last=parseInt($("#totalPages").html());
			if(page < page_last){
				page++;
			}
			var page_num=$("#pageSize").val();
			$(this).attr("href","<?=site_url('Admin/Goods/lists?cate_id=')?>"+cate_id+"&brand_id="+brand_id+"&intro_type="+intro_type+"&supplier_id="+supplier_id+"&is_on_sale="+is_on_sale+"&keyword="+keyword+"&page="+page+"&page_num="+page_num);
		});
		$("#gotoPage").change(function(){
			var cate_id=$("select[name='cate_id']").val();
			var brand_id=$("select[name='brand_id']").val();
			var intro_type=$("select[name='intro_type']").val();
			var supplier_id=$("select[name='supplier_id']").val();
			var is_on_sale=$("select[name='is_on_sale']").val();
			var keyword=$("input[name='keyword']").val();
			var page=$(this).val();
			var page_num=$("#pageSize").val();
			$("#selectChange").attr("href","<?=site_url('Admin/Goods/lists?cate_id=')?>"+cate_id+"&brand_id="+brand_id+"&intro_type="+intro_type+"&supplier_id="+supplier_id+"&is_on_sale="+is_on_sale+"&keyword="+keyword+"&page="+page+"&page_num="+page_num);
		});
		$(".garbage").click(function(){
			var id=$(this).parents('tr').attr("id");
			if(confirm('确认放入回收站?')){
				$.ajax({
					url:"<?=site_url('Admin/Goods/GarbageIn')?>",
					type:"get",
					data:{goods_id:id},
					success:function(msg){
						if(msg=="success"){
							$("#"+id).remove();
						}
					}
				})
			}
		});
		$("#selAction").change(function(){
			var id=[];
			$.each($(":checkbox").not($("#all")),function(k,v){
				if($(this).prop("checked")){
					id.push($(this).val())
				}
			});
			id=id.join("-");
			$("input[name='id']").val(id);
			if(id.length){
				$("#btnSubmit").attr("disabled",false);
			}
		})
	})
</script>