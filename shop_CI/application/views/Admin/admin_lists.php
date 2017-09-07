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
<span class="action-span"><a href="<?php echo site_url('Admin/Admin/add');?>?act=add">添加管理员</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限管理 </span><span class="action-span1" style="font-size: 12px; line-height: 20px;"> - 管理员列表 </span>
<div style="clear:both"></div>
</h1>
<div class="form-div">
  <img src="<?php echo base_url('public/Admin/images/');?>icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
  搜索关键字：<input type="text" name="keyword" id="keyword" placeholder="姓名/手机号/座机号/住址/邮箱" style="width: 200px"><input type="button" value="搜索" id="search">
</div>
<div class="list-div" id="listDiv">
  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th><input type="checkbox"  id="all">ID </th>
			<th>管理员名称</th>
			<th>性别</th>
			<th>年龄</th>
			<th>族籍</th>
			<th>手机号</th>
			<th>座机号</th>
			<th>住址</th>
			<th>邮箱</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
<?php foreach($data as $val):?>
        <tr>
			<td nowrap="true" valign="top"><input value="<?=$val['admin_id']?>" name="a_id[]" type="checkbox"><span><?=$val['admin_id']?></span></td>
            <td class="first-cell" nowrap="true" valign="top"><span><?=$val['admin_name']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_sex']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_age']?>岁</span></td>
            <td valign="top"><span><?=$val['admin_zu']?>族</span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_tel']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_sit_tel']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_address']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_email']?></span></td>
            <td nowrap="true" valign="top"><span><?=$val['admin_add_time']?></span></td>
			<td nowrap="true" valign="top">
				<a href="<?=site_url('Admin/Admin/update/').$val['admin_id']?>" title="编辑"><img src="<?php echo base_url('public/Admin/images/');?>icon_edit.gif" border="0" height="16" width="16"></a>
				<a href="javascript:;" title="注销" class="one_del"><img src="<?php echo base_url('public/Admin/images/');?>icon_drop.gif" border="0" height="16" width="16"></a>
			</td>
		</tr>
<?php endforeach;?>
        <tr>
            <td><input type="button" id="btnSubmit" value="删除" class="button" disabled="true"></td>
            <td colspan="10">
                <input type="hidden" value="1" id="page">
                <?php echo $show?>
            </td>
        </tr>
      </tbody></table>
</div>
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
      /**
       * 复选框的全选全不选
       */
      $(document).on("click","#all",function(){
          $(":checkbox").attr("checked",$(this).prop("checked"))
      });
      /**
       * 复选框选中状态下  disabled移除
       */
      $(document).on("click",":checkbox",function(){
          var flag=0;
          var _a=$(":checkbox");
         for(var n=1;n<_a.length;n++){
             if(_a.eq(n).attr("checked")){
                 flag=1;
             }
         }
          if(flag==1){
              $("#btnSubmit").removeAttr("disabled")
          }else{
              $("#btnSubmit").attr("disabled","true")
          }
      });
      //定义拼写字符串函数
      function getListPageStr(data){
          var str="<table cellpadding='3' cellspacing='1'><tbody><tr><th><input type='checkbox'  id='all'>ID </th><th>管理员名称</th><th>性别</th><th>年龄</th><th>族籍</th><th>手机号</th><th>座机号</th><th>住址</th><th>邮箱</th><th>添加时间</th><th>操作</th></tr>";
          $.each(data['data'],function(k,v){
              var url="<?=site_url('Admin/Admin/update/')?>"+v['admin_id'];
              str+="<tr><td nowrap='true' valign='top'><input value='"+v['admin_id']+"' name='a_id[]' type='checkbox'>";
              str+="<span>"+v['admin_id']+"</span></td>";
              str+="<td class='first-cell' nowrap='true' valign='top'><span>"+v['admin_name']+"</span></td>";
              str+="<td nowrap='true' valign='top'><span>"+v['admin_sex']+"</span></td><td nowrap='true' valign='top'><span>"+v['admin_age']+"岁</span></td>";
              str+="<td valign='top'><span>"+v['admin_zu']+"族</span></td><td nowrap='true' valign='top'><span>"+v['admin_tel']+"</span></td>";
              str+="<td nowrap='true' valign='top'><span>"+v['admin_sit_tel']+"</span></td><td nowrap='true' valign='top'><span>"+v['admin_address']+"</span></td>";
              str+="<td nowrap='true' valign='top'><span>"+v['admin_email']+"</span></td><td nowrap='true' valign='top'><span>"+v['admin_add_time'];
              str+='</span></td><td nowrap="true" valign="top">';
              str+='<a href="'+url+'" title="编辑"><img src="<?php echo base_url('public/Admin/images/');?>icon_edit.gif" border="0" height="16" width="16"></a><a href="javascript:;" title="注销" class="one_del"><img src="<?php echo base_url('public/Admin/images/');?>icon_drop.gif" border="0" height="16" width="16"></a></td></tr>'
          });
          str+="<tr><td><input type='button' id='btnSubmit' value='删除' class='button' disabled='true'></td><td colspan='10'><input type='hidden' value='"+data['page']+"' id='page'>"+data['show']+"</td></tr></tbody></table>";
          return str;
      }
      /**
       *传页码  接收表格
       */
        $(document).on("click",".page",function(){
            var _this=$(this);
            var page=_this.attr("id").substring(1);
            var keyword=$("#keyword").val();
            $.ajax({
                url: "<?php echo site_url('Admin/Admin/ajaxPage');?>",
                type: "get",
                dataType: "json",
                data: {page:page,keyword:keyword},
                success:function(data){
                   var str=getListPageStr(data);
                    $("#listDiv").html(str);
                    //居中对齐
                    var _this=$("td");
                    for(var i=0;i<_this.length;i++){
                        _this.eq(i).attr("align","center")
                    }
                }
            })
        });
      /**
       * 点击搜索按钮  获取关键字 从第一页显示
       */
      $(document).on("click","#search",function(){
          var keyword=$(this).prev().val();
          var page=1;
          $.ajax({
              url: "<?php echo site_url('Admin/Admin/ajaxPage');?>",
              type: "get",
              dataType: "json",
              data: {page:page,keyword:keyword},
              success:function(data){
                  var str=getListPageStr(data);
                  $("#listDiv").html(str);
                  //居中对齐
                  var _this=$("td");
                  for(var i=0;i<_this.length;i++){
                      _this.eq(i).attr("align","center")
                  }
              }
          })
      });
      /**
       * jQuery删除单条数据
       */
      $(document).on("click",".one_del",function(){
          if(confirm("确认删除？")){
              var _this=$(this);
              var id=_this.parent().parent().children().eq(0).children().eq(1).html();
              var page=$("#page").val();
              var keyword=$("#keyword").val();
              $.ajax({
                  url: "<?php echo site_url('Admin/Admin/ajaxDel');?>",
                  type: "get",
                  data: {id:id,page:page,keyword:keyword},
                  success: function (error) {
                      if(error==0){
                          _this.parents("tr").remove();
                      }
                  }
              })
          }
      });
      /**
       * jQuery删除多条数据
       */
      $(document).on("click","#btnSubmit",function(){
          if(confirm("确认删除所选中的？")){
              var id="";
              for(var y=1;y<$(":checkbox").length;y++){
                  if($(":checkbox").eq(y).attr("checked")){
                      id+=$(":checkbox").eq(y).val()+","
                  }
              }
              id=id.substring(0,id.length-1);
              var page=$("#page").val();
              var keyword=$("#keyword").val();
              $.ajax({
                  url: "<?php echo site_url('Admin/Admin/ajaxDel');?>",
                  type: "get",
                  data: {id:id,page:page,keyword:keyword},
                  success: function (msg) {
                      if(msg==0){
                          $("tr").each(function(){
                              if($(this).children("td").eq(0).find(":checkbox").prop("checked")){
                                  $(this).remove();
                              }
                          })
                      }
                  }
              })
          }
      })
  })
</script>