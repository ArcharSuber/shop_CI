<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 属性管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/Admin/styles/');?>general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/Admin/styles/');?>main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Attribute/add')?>?act=add">添加属性</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
    <img src="<?php echo base_url('public/Admin/images/');?>icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    按商品类型显示：<select name="type_id">
      <option value="0">所有商品类型</option>
      <?php foreach($data['type'] as $val):?>
          <?php if($type_id==$val['type_id']):?>
      <option value="<?=$val['type_id']?>" selected><?=$val['type_name']?></option>
              <?php else:?>
              <option value="<?=$val['type_id']?>"><?=$val['type_name']?></option>
              <?php endif;?>
      <?php endforeach;?>
    </select>
</div>

<div class="list-div" id="listDiv">
  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr id="head">
			<th><input type="checkbox" id="all">编号 </th>
			<th>属性名称</th>
			<th>商品类型</th>
			<th>属性值的录入方式</th>
			<th>可选值列表</th>
			<th>排序</a></th>
			<th>操作</th>
		</tr>
        <tr id="clone" style="display: none">
            <td align="right" nowrap="true" valign="top" id="attrId"><span></span></td>
            <td nowrap="true" valign="top" id="attrName"><span></span></td>
            <td class="first-cell" nowrap="true" valign="top" id="goodsType"><span></span></td>
            <td nowrap="true" valign="top" id="typeInput"><span></span></td>
            <td nowrap="true" valign="top" id="attrValues">
              <span>
              </span>
            </td>
            <td valign="top" id="attrOrder"><span></span></td>
            <td align="center" nowrap="true" valign="top" id="attrLink">
                <a href="#" title="编辑"><img src="<?php echo base_url('public/Admin/images/');?>icon_edit.gif" border="0" height="16" width="16"></a>
                <a href="javascript:;" title="移除"><img src="<?php echo base_url('public/Admin/images/');?>icon_drop.gif" border="0" height="16" width="16"></a>
            </td>
        </tr>
        <?php foreach($data['data'] as $v):?>
        <tr class="clone">
			<td nowrap="true" valign="top"><span><input value="<?=$v['attr_id']?>" name="attr_id[]" type="checkbox"><?=$v['attr_id']?></span></td>
			<td class="first-cell" nowrap="true" valign="top"><span><?=$v['attr_name']?></span></td>
			<td nowrap="true" valign="top"><span><?=$v['type_name']?></span></td>
			<td nowrap="true" valign="top">
              <span>
                  <?php if($v['attr_input_type']==0):?>
                     手工录入
                    <?php elseif($v['attr_input_type']==1):?>
                    从列表中选择
                    <?php else:?>
                    多行文本框
                    <?php endif;?>
              </span>
            </td>
			<td valign="top"><span><?=$v['attr_values']?></span></td>
			<td align="right" nowrap="true" valign="top"><span><?=$v['attr_order']?></span></td>
			<td align="center" nowrap="true" valign="top">
				<a href="<?=site_url('Admin/Attribute/update/').$v['attr_id']?>" title="编辑"><img src="<?php echo base_url('public/Admin/images/');?>icon_edit.gif" border="0" height="16" width="16"></a>
				<a href="javascript:;" title="移除"><img src="<?php echo base_url('public/Admin/images/');?>icon_drop.gif" border="0" height="16" width="16"></a>
			</td>
		</tr>
    <?php endforeach;?>
        <tr id="showPage">
          <td colspan="7" align="center"><?=$data['show']?></td>
        </tr>
      </tbody>
  </table>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>
<script>
  $(function(){
    var _this=$("td");
    for(var i=0;i<_this.length;i++){
      _this.eq(i).attr("align","center")
    }
    $("#all").click(function(){
      $(":checkbox").prop("checked",$(this).prop("checked"))
    });
      function getPageData(data){
          $.each(data['data'],function(k,v){
              var consValue=$("#clone").clone().addClass("clone").removeAttr("id").css("display","");//循环克隆
              $("#attrId",consValue).find("span").html('<input value="'+v['attr_id']+'" name="attr_id[]" type="checkbox">'+v['attr_id']);
              $("#attrName",consValue).find("span").html(v['attr_name']);
              $("#goodsType",consValue).find("span").html(v['type_name']);
              if(v['attr_input_type']==0){
                  var name="手工录入"
              }else if(v['attr_input_type']==1){
                  var name="从列表中选择"
              }else{
                  var name="多行文本框"
              }
              $("#typeInput",consValue).find("span").html(name);
              $("#attrValues",consValue).find("span").html(v['attr_values']);
              $("#attrOrder",consValue).find("span").html(v['attr_order']);
              var link="<?=site_url('Admin/Attribute/update/')?>"+v['attr_id'];
              $("#attrLink",consValue).find("a").eq(0).attr("href",link);
              if($(".clone").length==0){
                  $("#clone").after(consValue)
              }else{
                  $(".clone").last().after(consValue)
              }
          });
      }
      function sendAjax(page,type_id){
          $.ajax({
              url :"<?=site_url('Admin/Attribute/ajaxData')?>",
              data:{page:page,type_id:type_id},
              type:"get",
              dataType:"json",
              success:function(data){
                  if(data['data'].length==0){
                      $(".clone").remove();
                      $("#clone").show();
                      $("#showPage td").html(data['show'])
                  }else{
                      $(".clone").remove();
                      getPageData(data);
                      $("#showPage").find("td").html(data['show'])
                  }
              }
          })
      }
    $(".page").live("click",function(){
        $("#clone").hide();
      var page=$(this).attr("id").substring(1);
      var type_id=$("select[name='type_id']").val();
      sendAjax(page,type_id);
    });
      $("select[name='type_id']").change(function(){
          $("#clone").hide();
            var type_id=$(this).val();
            var page=1;
            sendAjax(page,type_id);
      });

  })
</script>