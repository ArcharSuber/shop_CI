<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cate extends Common_Controller{
    /**
     * 商品添加
     */
   public function add(){
       if(IS_GET){
           $this->load->model('Cate_model','cate');
           $cate=$this->cate->cate_select();
           $this->load->view('Admin/cate_add',array('cate'=>$cate));
       }
       if(IS_POST){
            $data=$this->input->post();
             $data['cate_time']=time();
           //p($data);
           $this->load->model('Cate_model','cate');
           if($this->cate->cate_add($data)){
               echo "<script>alert('添加成功');location.href='".site_url('Admin/Cate/lists')."'</script>";
               //redirect("Admin/Cate/lists");
           }
       }
   }

    /**
     * 列表展示
     */
    public function lists(){
        $this->load->model('Cate_model','cate');
        $data=$this->cate->cate_data();
        $this->load->view('Admin/cate_lists',array('data'=>$data));
    }

    /**
     * 分类的修改 如该分类下有商品 不能修改
     * @param $id
     */
    public function update($id){
        if(IS_GET){
            $num=$this->db->select('count(goods_id) as num')->where('cate_id',$id)->get('shop_goods')->row_array();
            if(!$num['num']==0){
                echo "<script>alert('该分类下含有商品！为了商品的安全，请先将商品进行转移！');location.href='".site_url('Admin/Cate/lists')."'</script>";
            }else{
                $this->load->model('Cate_model','cate');
                $cate=$this->cate->cate_select();
                $one_cate=$this->cate->cate_select_one($id);
                //p($cate);
                $this->load->view('Admin/cate_update',array('cate'=>$cate,'one_cate'=>$one_cate));
            }
        }
        if(IS_POST){
            $data=$this->input->post();
            $id=$data['cate_id'];
            unset($data['cate_id']);
            $this->load->model('Cate_model','cate');
            if($this->cate->cate_update($id,$data)){
                echo "<script>alert('修改成功');location.href='".site_url('Admin/Cate/lists')."'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".site_url('Admin/Cate/update/').$id."'</script>";
            }
        }
    }
    /**
     * 分类的删除 如该分类下有商品 不能删除
     */
    public function del(){
        $id=$this->input->get("id");
        $this->load->model('Cate_model','cate');
        if($this->cate->cate_del($id)){
            echo "success";
        }else{
            echo "error";
        }
    }

    /**
     * 商品转移
     * @param $id
     */
    public function cateRemove($id=0){
        if(IS_GET){
            $arr=explode("-",$id);
            $this->load->model('Cate_model','cate');
            $cate=$this->cate->cate_select();
            $num=$this->db->select('count(goods_id) as num')->where_in("cate_id",$arr)->get('shop_goods')->row_array();
            $this->load->view('Admin/cate_remove',array('str'=>$id,'cate'=>$cate,'num'=>$num['num']));
        }
        if(IS_POST){
            $data=$this->input->post();
            //p($data);
            $this->load->model('Cate_model','cate');
            $res=$this->cate->goods_cate_update($data);
            if($res){
                echo "<script>alert('转移成功');location.href='".site_url('Admin/Cate/lists')."'</script>";
            }else{
                echo "<script>alert('转移失败');location.href='".site_url('Admin/Cate/lists')."'</script>";
            }
        }
    }
    /**
     * 商品转移列表
     * @param $str
     */
    public function removeGoodsLists($str){
        $this->load->model('Cate_model','cate');
        $data=$this->cate->removeGoodsSelect($str);
        $this->load->view('Admin/goods_remove_lists',array('data'=>$data));
    }
}