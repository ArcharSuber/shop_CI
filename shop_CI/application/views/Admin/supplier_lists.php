<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='<?php echo base_url('public/');?>Admin/styles/general.css' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url('public/');?>Admin/styles/main.css' rel='stylesheet' type='text/css' />
    <script type='text/javascript' src='<?php echo base_url('public/');?>jquery-1.8.3.min.js'></script>
</head>
<body>

<h1>
<span class='action-span'><a href="<?php echo site_url('Admin/Supplier/add')?>?act=add">添加供货商</a></span>
<span class='action-span1'><a href='?act=main'>SHOP 管理中心</a> </span><span id='search_id' class='action-span1'> - 供货商列表 </span>
<div style='clear:both'></div>
</h1>

<div class='form-div'>
    <form action="" method="post">
    <img src='<?php echo base_url('public/');?>Admin/images/icon_search.gif' width='26' height='22' border='0' alt='SEARCH'>
     <input type='text' name='keyword' size='15' placeholder="请输入关键字" value="<?=$keyword?>">
    <input type='submit' value=' 搜索 ' class='button' id="search">
    </form>
</div>

<form method='post' action='' name='listForm'>
<!-- start brand list -->
<div class='list-div' id='listDiv'>
  <table cellpadding='3' cellspacing='1'>
    <thead>
		<tr>
			<th>供货商名称</th>
			<th>供货商描述</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
        </thead>
      <tbody id="tbody">
       <?php foreach($data as $val):?>
         <tr>
             <td align='center' ><?=$val['supplier_name']?></td>
            <td align='center' ><?=$val['supplier_desc']?></td>
			<td align='center'>
                <?php if($val['supplier_show']==1):?>
               <img src='<?php echo base_url('public/');?>Admin/images/yes.gif'>
                    <?php else: ?>
               <img src='<?php echo base_url('public/');?>Admin/images/no.gif'>
               <?php endif;?>
            </td>
			<td align='center'>
				<a href='<?=site_url('Admin/Supplier/update/').$val['supplier_id']?>' title='编辑'>编辑</a> |
				<a href='<?=site_url('Admin/Supplier/del/').$val['supplier_id']?>' title='编辑' class='delete' id='{$v.b_id}'>移除</a>
			</td>
		</tr>
       <?php endforeach;?>
        </tbody>
  </table>
<!-- end brand list -->
</div>
</form>


<div id='footer'>
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>
</body>
</html>