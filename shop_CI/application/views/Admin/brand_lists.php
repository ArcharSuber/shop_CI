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
<span class='action-span'><a href="<?php echo site_url('Admin/Brand/add')?>?act=add">添加品牌</a></span>
<span class='action-span1'><a href='?act=main'>SHOP 管理中心</a> </span><span id='search_id' class='action-span1'> - 商品品牌 </span>
<div style='clear:both'></div>
</h1>

<div class='form-div'>
    <img src='<?php echo base_url('public/');?>Admin/images/icon_search.gif' width='26' height='22' border='0' alt='SEARCH'>
     <input type='text' name='brand_name' size='15' placeholder="请输入品牌名称">
    <input type='button' value=' 搜索 ' class='button' id="search">
</div>

<form method='post' action='' name='listForm'>
<!-- start brand list -->
<div class='list-div' id='listDiv'>
  <table cellpadding='3' cellspacing='1'>
    <thead>
		<tr>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
        </thead>
      <tbody id="tbody">
       <?php foreach($data['data'] as $val):?>
        <tr>
			<td class='first-cell'>
                <span style='float:right'>
                       <a href="<?=base_url($val['brand_logo'])?>" target='_brank'>
                           <img src='<?=base_url($val['brand_logo'])?>' width='16' height='16' border='0' alt='品牌LOGO'>
                       </a>
                </span>
			<span title='点击修改内容'><?=$val['brand_name']?></span>
			</td>
            <td>
                <a href='<?=$val['brand_url']?>' target='_brank'><?=$val['brand_url']?></a>
            </td>
            <td align='left' ><?=$val['brand_desc']?></td>
            <td align='right'>
                <span><?=$val['brand_order']?></span>
            </td>
			<td align='center'>
                <?php if($val['brand_show']==1):?>
               <img src='<?php echo base_url('public/');?>Admin/images/yes.gif'>
                    <?php else: ?>
               <img src='<?php echo base_url('public/');?>Admin/images/no.gif'>
               <?php endif;?>
            </td>
			<td align='center'>
				<a href='#' title='编辑'>编辑</a> |
				<a href='javascript:;' title='编辑' class='delete' id='{$v.b_id}'>移除</a>
			</td>
		</tr>
       <?php endforeach;?>
        </tbody>
    <tr>
		<td align='right' nowrap='true' colspan='6'>
            <div id='turn-page'>
                <?=$data['show']?>
                <input type='hidden' value='<?=$data['page']?>' id='page'>
             </div>
      </td>
    </tr>
  </table>
<!-- end brand list -->
</div>
</form>


<div id='footer'>
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>
</body>
</html>
<script>
    $(function(){
        /**
         * 定义字符串拼接的方法
         */
        function main(data){
            var str="";
            var url="<?=base_url();?>";
            $.each(data,function(k,v){
                str+="<tr><td class='first-cell'><span style='float:right'><a href='"+url+v['brand_logo']+"' target='_brank'><img src='"+url+v['brand_logo']+"' width='16' height='16' border='0' alt='品牌LOGO'></a></span>";
                str+="<span title='点击修改内容'>"+v['brand_name']+"</span></td><td><a href='"+v['brand_url']+"' target='_brank'>"+v['brand_url']+"</a>";
                    str+="</td><td align='left' >"+v['brand_desc']+"</td><td align='right'><span>"+v['brand_order']+"</span></td><td align='center'>";
                    if(v['brand_show']==1){
                        str+="<img src='<?php echo base_url('public/');?>Admin/images/yes.gif'>";
                    }else{
                        str+="<img src='<?php echo base_url('public/');?>Admin/images/no.gif'>";
                    }
                    str+="</td><td align='center'><a href='#' title='编辑'>编辑</a> | <a href='javascript:;' title='编辑' class='delete' id='{$v.b_id}'>移除</a></td></tr>";
            });
            return str;
        }
        /**
         * 定义页码接收函数
         */
        function page_do(show,page){
            return show+"<input type='hidden' value='"+page+"' id='page'>";
        }
        /**
         *定义ajax请求方法
         */
        function ajax(page,key){
            $.ajax({
                url: "<?php echo site_url('Admin/Brand/ajaxData')?>",
                type: "get",
                dataType: "json",
                data: {page:page,keyword:key},
                success:function(msg){
                    $("#tbody").html(main(msg['data']));
                    $("#turn-page").html(page_do(msg['show'],msg['page']));
                }
            })
        }
        /**
         * 页码点击事件
         */
        $(document).on("click",".page",function(){
            var page=$(this).attr("id").substring(1);
            var key=$("input[name='brand_name']").val();
            ajax(page,key);
        });
        /**
         * 搜索从第一页开始
         */
        $("#search").click(function(){
           var page=1;
            var key=$("input[name='brand_name']").val();
            ajax(page,key);
        });
        /**
         * 搜索按钮点击事件
         */
        $(":button").click(function(){
            var key=$("input[name='brand_name']").val();
            var page=1;
            ajax(page,key);
        });
        /**
         * ajax无刷新删除
         */
        $(document).on("click",".delete",function(){
            if(confirm("确认删除?")){
                var id=$(this).attr("id");
                var key=$("input[name='brand_name']").val();
                var page=$("#page").val();
                $.ajax({
                    url: "__URL__/del_one",
                    type: "get",
                    dataType: "json",
                    data: {page:page,key:key,id:id},
                    success:function(msg){
                        $("#tbody").html(main(msg['data']));
                        $("#turn-page").html(page_do(msg['show'],msg['page']));
                    }
                })
            }

        })
    })
</script>