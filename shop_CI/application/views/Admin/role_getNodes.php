<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 角色管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url('public/');?>Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/');?>Admin/styles/main.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('public/');?>jquery-1.8.3.min.js"></script>
</head>
<body>

<h1>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 角色赋权 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form action="" method="post" name="theForm">
    <input type="hidden" name="node_id" value="{$node_id}">
    <table cellspacing="1" cellpadding="3" width="100%">
      <tbody>
      <tr>
        <input type="hidden" name="role_id" value="<?=$role_id?>">
      </tr>
      <tr>
        <td class="label">角色名称:</td>
        <td><input type="text" name="node_name" size="40" value="<?=$data['role_name']?>" disabled>
       </td>
      </tr>
      <tr>
        <td class="label">权限控制：</td>
        <td>
          <table>
            <?php foreach($node as $v):?>
              <tr>
                <td align="right" style="padding-right: 150px;">
                   <?php if(in_array($v['node_id'],$data['node_id'])):?>
                       <?=$v['node_name']?>
                       <input type="checkbox" class="parent" value="<?=$v['node_id']?>" name="node_id[]" checked>
                    <?php else:?>
                       <?=$v['node_name']?>
                       <input type="checkbox" class="parent" value="<?=$v['node_id']?>" name="node_id[]">
                   <?php endif;?>
                </td>
                <?php foreach($v['child'] as $val):?>
                  <td width="100px">
                  <?php if(in_array($val['node_id'],$data['node_id'])):?>
                    <?=$val['node_name']?>
                    <input type="checkbox" class="child" value="<?=$val['node_id']?>" name="node_id[]" checked>
                    <?php else:?>
                    <?=$val['node_name']?>
                    <input type="checkbox" class="child" value="<?=$val['node_id']?>" name="node_id[]">
                    <?php endif;?>
                  </td>
                <?php endforeach;?>
              </tr>
            <?php endforeach;?>
          </table>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <input type="submit" value=" 确定 " class="button">
          <input type="button" value=" 返回 " class="button">
        </td>
      </tr>
    </tbody></table>
  </form>
</div>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>
</body>
</html>
<script>
  $(function(){
    /**
     * 父选子
     */
    $(".parent").click(function(){
        $(this).parent().siblings("td").children().prop("checked",$(this).prop("checked"))
    });
    /**
     * 子选父
     */
    $(".child").click(function(){
        if($(this).prop("checked")){
          $(this).parent().siblings().find(".parent").prop("checked",true)
        }else{
          if($(this).parent().siblings().find(".child:checked").size()==0){
            $(this).parent().siblings().find(".parent").prop("checked",false)
          }
        }
    });
    /**
     * 返回
     */
    $("input[type='button']").click(function(){
      window.history.go(-1)
    })
  })
</script>