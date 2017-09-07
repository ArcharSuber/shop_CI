<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 类型管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/')?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Type/add')?>?act=add">新建商品类型</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品类型 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start goods type list -->
<div class="list-div" id="listDiv">

	<table width="100%" cellpadding="3" cellspacing="1" id="listTable">
		<tbody>
			<tr>
				<th>商品类型名称</th>
				<th>属性分组</th>
				<th>属性数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
            <?php foreach($data['data'] as $val):?>
			<tr>
				<td class="first-cell"><span><?=$val['type_name']?></span></td>
				<td><?=$val['type_group']?></td>
				<td align="right"><?=$val['attribute_num']?></td>
				<td align="center">
                  <?php if($val['type_status']==1):?>
                  <img src="<?php echo base_url('public/');?>Admin/images/yes.gif">
                <?php else:?>
                <img src="<?php echo base_url('public/');?>Admin/images/no.gif">
                <?php endif;?>
                </td>
				<td align="center">
				  <a href="<?=site_url('Admin/Attribute/lists/').$val['type_id']?>" title="属性列表">属性列表</a> |
				  <a href="<?=site_url('Admin/Type/update/').$val['type_id']."/".$data['page']?>" title="编辑">编辑</a> |
				  <a href="javascript:;" title="移除" class="delete" id="<?=$val['type_id']?>">移除</a>
				</td>
			</tr>
            <?php endforeach;?>
      <tr>
      <td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);">
             <div id="turn-page">
               <?=$data['show']?>
             </div>
      </td>
    </tr>
  </tbody>
    </table>

</div>
<!-- end goods type list -->
</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>
</body>
</html>
<script>
  $(function(){
    $(".page").live("click",function(){
        var page=$(this).attr("id").substring(1);
      $.ajax({
          url:"<?php echo site_url('Admin/Type/ajaxData')?>",
          type: "get",
        dataType:"json",
          data:{page:page},
        success:function(data){
          var str='<table width="100%" cellpadding="3" cellspacing="1" id="listTable"><tbody><tr><th>商品类型名称</th><th>属性分组</th><th>属性数</th><th>状态</th><th>操作</th></tr>';
          $.each(data['data'],function(k,v){
            var Attributeurl="<?=site_url('Admin/Attribute/lists/')?>"+v['type_id'];
            var Updateurl="<?=site_url('Admin/Type/update/')?>"+v['type_id']+"/"+data['page'];
            str+='<tr><td class="first-cell"><span>'+v['type_name']+'</span></td><td>'+v['type_group']+'</td><td align="right">'+v['attribute_num']+'</td><td align="center">';
            if(v['type_status']==1){
              str+='<img src="<?php echo base_url('public/');?>Admin/images/yes.gif">';
            }else{
              str+='<img src="<?php echo base_url('public/');?>Admin/images/no.gif">';
            }
            str+='</td><td align="center"><a href="'+Attributeurl+'" title="属性列表">属性列表</a> | <a href="'+Updateurl+'" title="编辑">编辑</a> | <a href="javascript:;" title="移除" class="delete" id="'+v['type_id']+'">移除</a></td></tr>'
          });
          str+='<td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);"><div id="turn-page">'+data['show']+'</div></td></tr></tbody></table>';
          $("#listDiv").html(str)
        }
      })
    });
      $(".delete").live("click",function(){
            var id=$(this).attr("id");
          var _this=$(this);
            if($(this).parents("tr").children("td").eq(2).html()==0){
                if(confirm("确认删除?")){
                    $.ajax({
                        url:"<?=site_url('Admin/Type/del')?>",
                        type:"get",
                        data:{id:id},
                        success: function(msg){
                            if(msg==1){
                                _this.parents("tr").remove();
                            }
                        }
                    })
                }
            }else{
                alert("该类型下含有属性，请不要删除！")
            }
      });
  })
</script>