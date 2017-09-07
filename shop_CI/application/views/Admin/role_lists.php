<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 角色列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/')?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/')?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url('public/')?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Role/add');?>?act=add">角色添加</a></span>
<span class="action-span1"><a href="#">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 角色列表 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>角色名称</th>
					<th>角色描述</th>
					<th>角色是否显示</th>
					<th>操作</th>
				</tr>
               <?php foreach($data as $val):?>
				<tr align="center">
					<td align="center" class="first-cell">
						<span><?=$val['role_name']?></span>
					 </td>
					<td align="center"><span><?=$val['role_desc']?></span></td>
                    <td>
						<?php if($val['role_status']==0):?>
							<img src="<?php echo base_url('public/')?>Admin/images/no.gif">
							<?php else: ?>
							<img src="<?php echo base_url('public/')?>Admin/images/yes.gif">
						<?php endif;?>
					</td>
					<td align="center">
						<a href="<?php echo site_url('Admin/Role/getNodes').'/'.$val['role_id']?>">赋权</a> |
						<a href="<?php echo site_url('Admin/Role/update/').$val['role_id']?>">编辑</a> |
						<a href="{:U('Node/del')}" title="移除" class="delete">移除</a>
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