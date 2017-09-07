<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="<?php echo base_url('public/Admin/styles/');?>general.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('public/Admin/styles/');?>main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>utils.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>selectzone.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>colorselector.js"></script>
</head>
<body>
<h1>
	<span class="action-span"><a href="<?php echo site_url('Admin/Goods/lists');?>">商品列表</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 商品添加 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab">通用信息</span>
<!--		  <span id="detail-tab" class="tab-back">详细描述</span>-->
		<span class="tab-back" id="mix-tab">其他信息</span>
		<span class="tab-back" id="properties-tab">商品属性</span>
		<span class="tab-back" id="gallery-tab">商品相册</span>
      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="" method="post" name="theForm">
		 <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center" style="display: table;">
			<tbody>
				<tr>
					<td class="label">商品名称：</td>
					<td><input type="text" name="goods_name" value="" size="30"><span class="require-field">*</span></td>
				</tr>
				<tr>
					<td class="label">商品货号： </td>
					<td><input type="text" name="goods_sn" value="" size="20"><span id="goods_sn_notice"></span><br>
					<span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
			</tr>
			<tr>
				<td class="label">商品分类：</td>
				<td>
					<select name="cate_id">
						<option value="0">请选择...</option>
						<?php foreach($cate as $val):?>
							<option value="<?=$val['cate_id']?>"><?=str_repeat("&nbsp;&nbsp;",substr_count($val['cate_path'],",")).$val['cate_name']?></option>
						<?php endforeach;?>
					</select>
                 </td>
			</tr>
			<tr>
				<td class="label">商品品牌：</td>
				<td>
					<select name="brand_id">
						<option value="0">请选择...</option>
						<?php foreach($brand as $val):?>
							<option value="<?=$val['brand_id']?>"><?=$val['brand_name']?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
            <tr>
				<td class="label">选择供货商：</td>
				<td>
					<select name="supplier_id" id="supplier_id">
						<option value="0">不指定供货商属于本店商品</option>
						<?php foreach($suppliers as $val):?>
						<option value="<?=$val['supplier_id']?>"><?=$val['supplier_name']?></option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
            <tr>
				<td class="label">本店售价：</td>
				<td><input type="text" name="shop_price" value="" size="20">
				<input type="button" value="按市场价计算">
				<span class="require-field">*</span></td>
			</tr>
			<tr>
            <td class="label">会员价格：</td>
            <td><input type="text" name="user_price" value="" size="20"></td>
          </tr>

          <tr>
            <td class="label">市场售价：</td>
            <td><input type="text" name="market_price" value="" size="20">
              <input type="button" value="取整数">
            </td>
          </tr>
          <tr>
            <td class="label"><label for="is_promote">促销价：</label></td>
            <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="" size="20"></td>
          </tr>
          <tr id="promote_4">
            <td class="label" id="promote_5">促销日期：</td>
            <td id="promote_6">
              <input name="promote_start_date" type="text" id="promote_start_date" size="12" value="" readonly="readonly"> - <input name="promote_end_date" type="text" id="promote_end_date" size="12" value="" readonly="readonly">
            </td>
          </tr>
          <tr>
            <td class="label">上传商品头像图片：</td>
            <td>
              <input type="file" name="goods_img" size="35">
                              <a href="#" target="_blank"><img src="<?php echo base_url('public/Admin/images/');?>yes.gif" border="0"></a>
                            <br><input type="text" size="40" value="" style="color:#aaa;" placeholder="商品图片外部URL" onfocus="if (this.value == ''){this.value='http://';this.style.color='#000';}" name="goods_img_url">
            </td>
          </tr>
        </tbody>
		</table>
        <!-- 详细描述 -->
<!--        <table width="90%" id="detail-table" style="display: none;">-->
<!--          <tbody><tr>-->
<!--            <td><input type="hidden" id="goods_desc" name="goods_desc" value="" style="display:none"><input type="hidden" id="goods_desc___Config" value="" style="display:none"><iframe id="goods_desc___Frame" src="../includes/fckeditor/editor/fckeditor.html?InstanceName=goods_desc&amp;Toolbar=Normal" width="100%" height="320" frameborder="0" scrolling="no" style="margin: 0px; padding: 0px; border: 0px; background-color: transparent; background-image: none; width: 100%; height: 320px;"></iframe></td>-->
<!--          </tr>-->
<!--        </tbody></table>-->

        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display: none;" align="center">
                    <tbody><tr>
            <td class="label">商品重量：</td>
            <td><input type="text" name="goods_weight" value="" size="20"> <select name="weight_unit">
					<option value="">请选择单位</option><option value="千克">千克</option><option value="克">克</option></select></td>
          </tr>
		  <tr>
            <td class="label"><a href="#" title="点击此处查看提示信息"><img src="<?php echo base_url('public/Admin/images/');?>notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>
<!--            <td><input type="text" name="goods_number" value="4" size="20" readonly="readonly" /><br />-->
            <td><input type="text" name="goods_number" value="" size="20"><br>
            <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
          </tr>
          <tr>
            <td class="label">库存警告数量：</td>
            <td><input type="text" name="warn_number" value="" size="20"></td>
          </tr>
		<tr>
			<td class="label">商品排序：</td>
			<td><input type="text" name="goods_order" value="" size="20"></td>
		</tr>
		  <tr>
            <td class="label">加入推荐：</td>
            <td>
				<input type="checkbox" name="is_best" value="1" >精品
				<input type="checkbox" name="is_new" value="1" >新品
				<input type="checkbox" name="is_hot" value="1" >热销
			</td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2">上架：</td>
            <td id="alone_sale_3">
				<input type="checkbox" name="is_on_sale" value="1" > 打勾表示允许销售，否则不允许销售。
			</td>
          </tr>
          <tr>
            <td class="label">能作为普通商品销售：</td>
            <td>
				<input type="checkbox" name="is_alone_sale" value="1" > 打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。
			</td>
          </tr>
          <tr>
            <td class="label">是否为免运费商品</td>
            <td>
				<input type="checkbox" name="is_shipping" value="1"> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。
			</td>
          </tr>
          <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="goods_desc" cols="40" rows="3"></textarea></td>
          </tr>
          <tr>
            <td class="label">
            <a href="#" title="点击此处查看提示信息"><img src="<?php echo base_url('public/Admin/images/');?>notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商家备注： </td>
            <td><textarea name="seller_note" cols="40" rows="3"></textarea><br>
            <span class="notice-span" style="display:block" id="noticeSellerNote">仅供商家自己看的信息</span></td>
          </tr>
        </tbody>
		</table>

        <!-- 商品属性 -->
         <table width="90%" id="properties-table" style="display: none;" align="center">
			<tbody>
				<tr>
					<td class="label">商品类型：</td>
					<td>
						<select name="type_id">
							<option value="0">请选择商品类型</option>
							<?php foreach($type as $val):?>
								<option value="<?=$val['type_id']?>"><?=$val['type_name']?></option>
							<?php endforeach;?>
						</select><br>
						<span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
					</td>
				</tr>
				<tr>
				<td id="tbody-goodsAttr" colspan="2" style="padding:0">
					<table width="100%" id="attrTable">
						<tbody>
						<input type="hidden" name="attr_id_list[]" value="0">
						<input type="hidden" name="attr_value_list[]" value="0">
						</tbody>
						</table>
					</td>
			 </tr>
        </tbody>
	</table>
        
        <!-- 商品相册 -->
        <table width="90%" id="gallery-table" style="display: none;" align="center">
          <tbody>
		  <tr>
            <td>

		  </td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td>
              <a href="javascript:;" class="img_add">[+]</a>
              图片描述 <input type="text" name="img_desc[]" size="20">
              上传文件 <input type="file" name="goods_images[]">
              <input type="text" size="40" value="" placeholder="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == ''){this.value='http://';this.style.color='#000';}" name="img_url[]">
            </td>
          </tr>
        </tbody></table>

        <div class="button-div">
                    <input type="submit" value=" 确定 " class="button" onclick="validate('32')">
          <input type="reset" value=" 重置 " class="button">
        </div>
      </form>
    </div>
</div>


<div id="footer">
	版权所有 &copy; 2006-2013 
</div>
<script src="<?=base_url('/public/js/jquery-1.10.2.js');?>"></script>
<link href="<?= base_url('/public/css/ui-lightness/jquery-ui-1.10.4.custom.css');?>" rel="stylesheet">
<script src="<?=base_url('/public/js/jquery-ui-1.10.4.custom.js');?>"></script>
<script>
	$( "#promote_start_date" ).datepicker();
	$( "#promote_start_date" ).datepicker(
		"option", "dateFormat","yy-mm-dd"
	);
	$( "#promote_end_date" ).datepicker();
	$( "#promote_end_date" ).datepicker(
		"option", "dateFormat","yy-mm-dd"
	);
</script>
<script type="text/javascript" src="<?php echo base_url('public/Admin/js/');?>tab.js"></script>
<script>
	$(function(){
		$("select[name='type_id']").change(function(){
			var id=$(this).val();
			$.ajax({
				url:"<?=site_url('Admin/Goods/getAttribute/')?>"+id,
				type: "get",
				dataType:"json",
				success:function(data){
					if(data.length==0){
						$('#attrTable tbody').html("<tr><td colspan='2' align='left'>该类型下还没有属性</td></tr>")
					}else{
						var str="";
						$.each(data,function(k,v){
							if(v['attr_input_type']==0){
								str+="<tr><td class='label'>"+v['attr_name']+":</td><td><input type='hidden' name='attr_id_list[]' value='"+v['attr_id']+"'><input type='text' name='attr_value_list[]'/></td></tr>"
							}
							if(v['attr_input_type']==1){
								str+="<tr><td class='label'>"+v['attr_name']+":</td><td><input type='hidden' name='attr_id_list[]' value='"+v['attr_id']+"'><select name='attr_value_list[]'><option value=''>请选择属性值</option>";
								$.each(v['attr_values'],function(kk,vv){
									str+="<option value='"+vv+"'>"+vv+"</option>";
								});
								str+="</select></td></tr>";
							}
							if(v['attr_input_type']==2){
								str+="<tr><td class='label'><input type='button' value='[+]' class='add' /> "+v['attr_name']+":</td><td><input type='hidden' name='attr_id_list[]' value='"+v['attr_id']+"'><input type='text' name='attr_value_list[]' /></td></tr>";
							}
						});
						$("#attrTable tbody").html(str)
					}
				}
			})
		});
		$(".img_add").click(function(){
			var clone=$(this).parents('tr').clone();
			clone.children("td").find("a").replaceWith('<a class="img_del" href="javascript:;">[-]</a>');
			$("#gallery-table tbody").append(clone)
		});
		$(document).on("click",".img_del",function(){
			$(this).parents("tr").remove();
		})
	})
</script>
</body>
</html>