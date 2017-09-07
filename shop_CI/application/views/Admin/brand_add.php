<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo site_url('Admin/Brand/lists')?>?act=list">商品品牌</a></span>
<span class="action-span1"><a href="{:U('Index/main')}?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <span><font color="red"><?php echo $error?></font></span>
<form method="post" action="" name="theForm" enctype="multipart/form-data">
<table cellspacing="1" cellpadding="3" width="100%">
  <tbody><tr>
    <td class="label">品牌名称</td>
    <td><input type="text" name="brand_name" maxlength="60" placeholder="数字字母下划线或汉字"></td>
  </tr>
  <tr>
    <td class="label">品牌网址</td>
    <td><input type="text" name="brand_url" maxlength="60" size="40" placeholder="如http://网址 不能为空"></td>
  </tr>
  <tr>
    <td class="label"><a href="#" title="点击此处查看提示信息">
        <img src="<?php echo base_url('public/');?>Admin/images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a>品牌LOGO</td>
    <td><input type="file" name="brand_logo" id="logo" size="45">    <br><span class="notice-span" style="display:block" id="warn_brandlogo">
        请上传图片，做为品牌的LOGO！        </span>
    </td>
  </tr>
  <tr>
    <td class="label">品牌描述</td>
    <td><textarea name="brand_desc" cols="60" rows="4" id="content"></textarea>
      <span>您还可以输入：<font color='red'><b id="sp_content">50</b></font>个字</span>
    </td>
  </tr>
  <tr>
    <td class="label">排序</td>
    <td><input type="text" name="brand_order" maxlength="40" size="15" placeholder="可填可不填哦~"></td>
  </tr>
  <tr>
    <td class="label">是否显示</td>
    <td><input type="radio" name="brand_show" value="1"> 是
      <input type="radio" name="brand_show" value="0" checked="checked"> 否        (当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌。)
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>
      <input type="submit" class="button" value=" 确定 ">
      <input type="reset" class="button" value=" 重置 ">
    </td>
  </tr>
</tbody></table>
</form>
</div>
</body>
</html>
<script>
  $(function(){
    /**
     * 内容
     */
    $("#content").keyup(function(){
      var content=$("#content").val();
      if(content.length<=50){
        $("#sp_content").html(50-content.length);
      }else{
        $("#content").val(content.substr(0,50));
      }
    });
    /*
    *定义对象属性来组织提交
    */
    var validata={
      checkName:false,
      checkUrl:false
    };
    /**
     * 品牌名称的失焦事件
     */
    $("input[name='brand_name']").blur(function(){
      var _this=$(this);
      var c_name=_this.val();
      if(c_name==""){
        _this.next().remove();
        _this.after("<font color='red'>*</font>");
        validata.checkName=false;
        return false;
      }else{
        //定义汉字字母下划线正则
        var reg1=/^[\u4e00-\u9fa5]+$/
        var reg2=/^\w+$/
        if(reg1.test(c_name)||reg2.test(c_name)){
          _this.next().remove();
          _this.after("<font color='green'>√</font>");
          validata.checkName=true;
          return true;
        }else{
          _this.next().remove();
          _this.after("<font color='red'>您输入的格式不对哦~</font>");
          validata.checkName=false;
          return false;
        }
      }
    });
    /**
     * 品牌网址的失焦事件
     */
    $("input[name='brand_url']").blur(function(){
      var _this=$(this);
      var url=_this.val();
      if(url==""){
        _this.next().remove();
        _this.after("<font color='red'>*</font>");
        validata.checkUrl=false;
        return false;
      }else{
        _this.next().remove();
        _this.after("<font color='green'>√</font>");
        validata.checkUrl=true;
        return true;
      }
    });
    /**
     * 表单阻止提交事件
     */
    $(":submit").click(function(){
      $("input[name='brand_name']").trigger("blur");
      $("input[name='brand_url']").trigger("blur");
      return validata.checkName&&validata.checkUrl;
    })
  })
</script>