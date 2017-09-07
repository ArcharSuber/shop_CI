<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 权限列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/Admin/')?>styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/Admin/')?>styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url('public/');?>/jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Node/add');?>?act=add">权限添加</a></span>
<span class="action-span1"><a href="#">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限列表 </span>
<div style="clear:both"></div>
</h1>

<form method="post" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr pid="0">
					<th>权限名称</th>
					<th>控制器名称</th>
					<th>方法名称</th>
					<th>操作</th>
				</tr>
                <?php foreach($list as $v):?>
				<tr align="center" pid="<?=$v['node_pid']?>" id="<?=$v['node_id']?>" class="0">
					<td align="left" class="first-cell">
						<img src="<?php echo base_url('public/Admin/')?>images/btn_maximize.gif" class="icon_0_1" width="9" height="9" border="0" style="margin-left:0em">
						<span><?=str_repeat('※☽☺☾',$v['deep']).$v['node_name']?></span>
					 </td>
					<td width="10%" align="right"><span><?=$v['node_controller']?></span></td>
                    <td><span><?=$v['node_action']?></span></td>
					<td width="24%" align="center">
						<a href="#">编辑</a> |
						<a href="#" title="移除" class="delete">移除</a>
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
		 * 只展示顶级分类
		 */
		$("tr[pid!='0']").hide();
		/**
		 * 点击加号和减号
		 */
		$(".icon_0_1").toggle(function(){
			$("tr[pid="+$(this).parents("tr").attr("id")+"]").show().addClass($(this).parents("tr").attr("class")+" "+$(this).parents("tr").attr("id"));
			$(this).attr("src","<?php echo base_url('public/Admin/')?>images/btn_minimize.gif")
		},function(){
			$("."+$(this).parents("tr").attr("id")).hide();
			$(this).attr("src","<?php echo base_url('public/Admin/')?>images/btn_maximize.gif")
		});
	})
</script>