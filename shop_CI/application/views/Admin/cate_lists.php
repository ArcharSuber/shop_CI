<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 商品分类 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Cate/add')?>?act=add">添加分类</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品分类 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>分类名称</th>
					<th>商品数量</th>
					<th>数量单位</th>
					<th>导航栏</th>
					<th>是否显示</th>
					<th>排序</th>
                    <th>添加时间</th>
					<th>操作</th>
				</tr>
               <?php foreach($data as $val):?>
				<tr align="center" class="all_tr">
					<td align="left" class="first-cell">
						<img src="<?php echo base_url('public/');?>Admin/images/btn_maximize.gif" class="icon_0_1" width="9" height="9" border="0" style="margin-left:0em">
						<img src="<?php echo base_url('public/');?>Admin/images/btn_minimize.gif" class="icon_0_2" width="9" height="9" border="0" style="margin-left:0em;display: none;">
						<!--重点引入 id class pid三个属性-->
						<span id="<?=$val['cate_id']?>" class="<?=$val['cate_path']?>" pid="<?=$val['pid']?>"><?=$val['cate_name']?></span>

					 </td>
					<td width="5%"><?=$val['goods_num']?></td>
					<td width="5%"><span><?=$val['cate_dan']?></span></td>
					<td width="5%">
                        <?php if($val['cate_nav']==0):?>
                        <img src="<?php echo base_url('public/');?>Admin/images/no.gif">
                            <?php else:?>
                            <img src="<?php echo base_url('public/');?>Admin/images/yes.gif">
                        <?php endif;?>
                    </td>
					<td width="5%">
						<?php if($val['cate_show']==0):?>
                            <img src="<?php echo base_url('public/');?>Admin/images/no.gif">
						<?php else:?>
                            <img src="<?php echo base_url('public/');?>Admin/images/yes.gif">
						<?php endif;?>
                    </td>
					<td width="5%" align="right"><span><?=$val['cate_order']?></span></td>
                    <td><span><?=$val['cate_time']?></span></td>
					<td width="24%" align="center">
						<a href="javascript:void(0)" class="remove">转移商品</a> |
						<a href="javascript:void(0)" class="update">编辑</a> |
						<a href="javascript:void(0)" title="移除" class="delete">移除</a>
					</td>
				</tr>
                <?php endforeach;?>
	</tbody>
  </table>
</div>
</form>
  </table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>
<script>
	$(function(){
		/**
		 * 只显示顶级的分类
		 */
		$(".icon_0_1").parents(".all_tr").not($(".icon_0_1").siblings("span[pid='0']").parents("tr")).hide()
		/**
		 * 点击加号图片展示子集分类
		 */
		$(document).on("click",".icon_0_1",function(){
			var id=$(this).siblings("span").attr("id");
			$("span[pid='"+id+"']").parents("tr").show();
			$(this).hide().next().show()
		});
		/**
		 * 点击减号图片收缩该分类下的所有子集分类
		 */
		$(document).on("click",".icon_0_2",function(){
			var id=$(this).siblings("span").attr("id");
			$("."+id).parents("tr").hide();
			$(this).hide().prev().show()
		});
		/**
		 * 分类的节点删除 如果该分类下有子分类则不允许删除  否则删除
		 */
		$(".delete").click(function(){
			var _this=$(this);
			var goods_num=$(this).parents("tr").children().eq(1).html();
			var id=$(this).parents("tr").children("td:first").children("span").attr("id");
			if($("."+id).length){
				alert("该分类下有子类\n\t不允许删除！")
			}else{
				if(goods_num!=0){
					alert("该分类下含有商品！为了商品的安全，请先将商品进行转移！");
				}else{
					if(confirm("确认删除此分类？")){
						$.ajax({
							type: "get",
							url : "<?php echo site_url('Admin/Cate/del')?>",
							data: "id="+id,
							success: function(msg){
								if(msg=="success"){
									_this.parents("tr").remove();
								}
							}
						})
					}else{
						return false;
					}
				}
			}
		});
		/**
		 *分类的修改  如果该分类下有分类不允许修改  否则修改
		 */
		$(".update").click(function(){
			var id=$(this).parents("tr").children("td:first").children("span").attr("id");
			if($("."+id).length){
				alert("该分类下有子类\n\t不允许编辑！")
			}else{
				$(this).attr("href","<?=site_url('Admin/Cate/update/')?>"+id)
			}
		});
		$(".remove").click(function(){
			var id=$(this).parents("tr").children("td:first").children("span").attr("id");
			var span=$("."+id);
			var long_id=[id];
			$.each(span,function(){
				long_id.push($(this).attr("id"))
			});
			var str=long_id.join("-");
			$(this).attr("href","<?=site_url('Admin/Cate/cateRemove/')?>"+str)
		})
	})
</script>