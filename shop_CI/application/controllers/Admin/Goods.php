<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods extends Common_Controller{
    /**
     * 商品添加
     */
   public function add(){
       if(IS_GET){
           $this->load->model("Cate_model","cate");
           $this->load->model("Brand_model","brand");
           $this->load->model("Type_model","type");

           $cate=$this->cate->cate_select();
           $brand=$this->brand->brand_select();
           $type=$this->type->get_typeData();
           //p($goods);
           $suppliers=$this->db->select("supplier_id,supplier_name")->where('supplier_show',1)->get('shop_supplier')->result_array();
           $this->load->view('Admin/goods_add',array('cate'=>$cate,'brand'=>$brand,'type'=>$type,'suppliers'=>$suppliers));
       }
       if(IS_POST){
           $data=$this->input->post();
           $file=$_FILES['goods_img'];
           $this->load->model('Goods_model','goods');
           $path=$this->goods->goods_face_upload($file);
           $data['goods_img']=$path;
           $goods_images=$_FILES['goods_images'];
           $path=$this->goods->goods_images_upload($goods_images);
           $data['img_path']=$path;
           $goods_attribute=array(
               'attr_id'=>$data['attr_id_list'],
               'attr_value'=>$data['attr_value_list']
           );
           unset($data['attr_id_list']);
           unset($data['attr_value_list']);
           $goods_images=array(
               'img_desc'=>$data['img_desc'],
               'img_url'=>$data['img_url'],
               'img_path'=>$data['img_path']
           );
           unset($data['img_desc']);
           unset($data['img_path']);
           unset($data['img_url']);
           $this->load->model('Goods_model','goods');
           $data['promote_start_date']=strtotime($data['promote_start_date']);
           $data['promote_end_date']=strtotime($data['promote_end_date']);
           $goods_id=$this->goods->goods_add($data);
           if(!$goods_attribute['attr_id'][0]==0){
               $this->goods->goods_attribute_add($goods_attribute,$goods_id);
           }
           $this->goods->goods_images_add($goods_images,$goods_id);
           echo "<script>alert('商品添加成功');location.href='".site_url('Admin/Goods/lists')."'</script>";
       }
   }

    /**
     * 商品列表
     */
    public function lists(){
        if(IS_GET){
            $data=$this->input->get();
            if(empty($data)){
                $config=array(
                    'page'=>1,
                    'page_num'=>10,
                    'cate_id'=>0,
                    'brand_id'=>0,
                    'intro_type'=>0,
                    'is_on_sale'=>"",
                    'supplier_id'=>0,
                    'garbage_status'=>0,
                    'keyword'=>""
                );
            }else{
                $config=$data;
                if(empty($config['page_num'])){
                    $config['page_num']=10;
                }
                $config['garbage_status']=0;
                //p($config);
            }
            $this->load->model("Cate_model","cate");
            $this->load->model("Brand_model","brand");
            $this->load->model("Goods_model","goods");
            $cate=$this->cate->cate_select();
            $brand=$this->brand->brand_select();
            $goods=$this->goods->goods_select($config);
            //p($goods);
            $suppliers=$this->db->select("supplier_id,supplier_name")->where('supplier_show',1)->get('shop_supplier')->result_array();
            $this->load->view('Admin/goods_lists',array('cate'=>$cate,'brand'=>$brand,'suppliers'=>$suppliers,'goods'=>$goods,'config'=>$config));
        }
        if(IS_POST){
            $data=$this->input->post();
            if(isset($data['cate_str'])){
                $array=$this->input->post();
                $this->load->model('Goods_model','goods');
                if($this->goods->goods_cate_update($array)){
                    echo "<script>alert('转移成功');location.href='".site_url('Admin/Goods/lists')."'</script>";die;
                }else{
                    echo "<script>alert('转移失败');location.href='".site_url('Admin/Goods/lists')."'</script>";die;
                }
            }
            if(isset($data['supplier_str'])){
                $array=$this->input->post();
                $this->load->model('Goods_model','goods');
                if($this->goods->goods_supplier_update($array)){
                    echo "<script>alert('转移成功');location.href='".site_url('Admin/Goods/lists')."'</script>";die;
                }else{
                    echo "<script>alert('转移失败');location.href='".site_url('Admin/Goods/lists')."'</script>";die;
                }
            }
            $arr['id']=str_replace("-",",",$data['id']);
            switch($data['type']){
                case "move_to":
                    $this->load->model('Cate_model','cate');
                    $cate=$this->cate->cate_select();
                    $num=count(explode("-",$data['id']));
                    $this->load->view('Admin/goods_remove',array('str'=>$data['id'],'cate'=>$cate,'num'=>$num));
                    break;
                case "garbage":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'garbage_status',1);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "on_sale":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_on_sale',1);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "not_on_sale":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_on_sale',0);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "best":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_best',1);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "not_best":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_best',0);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "new":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_new',1);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "not_new":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_new',0);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "hot":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_hot',1);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "not_hot":
                    $this->load->model('Goods_model',"goods");
                    $this->goods->goodsSelectUpdate($arr['id'],'is_hot',0);
                    header("location:".site_url('Admin/Goods/lists'));
                    break;
                case "supplier_move_to":
                    $suppliers=$this->db->select('supplier_id,supplier_name')->where('supplier_show',1)->get('shop_supplier')->result_array();
                    $num=count(explode("-",$data['id']));
                    $this->load->view('Admin/supplier_remove',array('str'=>$data['id'],'suppliers'=>$suppliers,'num'=>$num));
                    break;
            }
        }
    }

    /**
     * 商品修改
     * @param $id
     */
    public function update($id){
        if(IS_GET){
            $this->load->model("Cate_model","cate");
            $this->load->model("Brand_model","brand");
            $this->load->model("Type_model","type");
            $this->load->model('Goods_model','goods');

            $cate=$this->cate->cate_select();
            $brand=$this->brand->brand_select();
            $type=$this->type->get_typeData();
            $goods=$this->goods->goods_select_one($id);
            $goods['promote_start_date']=date('Y-m-d',$goods['promote_start_date']);
            $goods['promote_end_date']=date('Y-m-d',$goods['promote_end_date']);
            $goods_images=$this->goods->goods_select_images($id);
            $goods_attribute=$this->goods->goods_attribute_select($id);
            $suppliers=$this->db->select("supplier_id,supplier_name")->where('supplier_show',1)->get('shop_supplier')->result_array();
            $this->load->view('Admin/goods_update',array('cate'=>$cate,'brand'=>$brand,'type'=>$type,'suppliers'=>$suppliers,'goods'=>$goods,'goods_images'=>$goods_images,'goods_attribute'=>$goods_attribute));
        }
        if(IS_POST){
            $data=$this->input->post();
            $file=$_FILES['goods_img'];
            $this->load->model('Goods_model','goods');
            $path=$this->goods->goods_face_upload($file);
            if(!empty($path)){
                $data['goods_img']=$path;
            }
            $goods_images=$_FILES['goods_images'];
            $path=$this->goods->goods_images_upload($goods_images);
            $data['img_path']=$path;
            $goods_attribute=array(
                'attr_id'=>$data['attr_id_list'],
                'attr_value'=>$data['attr_value_list']
            );
            unset($data['attr_id_list']);
            unset($data['attr_value_list']);
            $goods_images=array(
                'img_desc'=>$data['img_desc'],
                'img_url'=>$data['img_url'],
                'img_path'=>$data['img_path']
            );
            unset($data['img_desc']);
            unset($data['img_path']);
            unset($data['img_url']);
            $this->load->model('Goods_model','goods');
            $data['promote_start_date']=strtotime($data['promote_start_date']);
            $data['promote_end_date']=strtotime($data['promote_end_date']);
            $id=$data['goods_id'];
            unset($data['goods_id']);
            $this->goods->goods_update($id,$data);
            $this->goods->goods_attribute_update($id,$goods_attribute);
            $this->goods->goods_images_add($goods_images,$id);
            echo "<script>alert('商品修改成功');location.href='".site_url('Admin/Goods/lists')."'</script>";
        }
    }

    /**
     *  ajax 请求放入回收站
     */
    public function GarbageIn(){
        $goods_id=$this->input->get("goods_id");
        if(is_array($goods_id)){
            $goods_id=implode(",",$goods_id);
        }
        $this->load->model('Goods_model','goods');
        if($this->goods->goodsSelectUpdate($goods_id,'garbage_status',1)){
            echo "success";
        }else{
            echo "error";
        }
    }
    /**
     * ajax请求获得该类型的属性
     * @param $id
     */
    public function getAttribute($id){
        $this->load->model('Attribute_model','attr');
        $attribute=$this->attr->get_attrData($id);
        //p($attribute);
        echo json_encode($attribute);
    }

    /**
     * ajax删除商品图片
     * @param $id
     */
    public function ajax_ImageDel($id){
        $this->load->model("Goods_model",'goods');
        if($this->goods->goods_image_del($id)) echo 1;else echo 0;
    }
    /**
     * ajax修改商品描述
     * @param $id
     */
    public function ajax_DescUpdate($id){
        $name=$this->input->get("name");
        $this->load->model('Goods_model',"goods");
        if($this->goods->goods_desc_update($id,$name)) echo 1;else echo 0;
    }
    /**
     * 商品详情查看
     * @param $id
     */
    public function goods_showInfo($id){
        $this->load->model('Goods_model','goods');
        p($this->goods->goodsSelectInfo($id));
    }
    /**
     * 商品转移列表
     * @param $str
     */
    public function removeGoodsLists($str){
        $this->load->model('Goods_model','goods');
        $data=$this->goods->removeGoodsSelect($str);
        $this->load->view('Admin/goods_remove_lists',array('data'=>$data));
    }
}