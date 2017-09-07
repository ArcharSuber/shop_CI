<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Type extends Common_Controller{
    /**
     * 类型添加
     */
    public function add(){
        if(IS_GET){
            $this->load->view('Admin/type_add');
        }
        if(IS_POST){
            $data=$this->input->post();
            $this->load->model('Type_model','type');
            $res=$this->type->type_add($data);
            if($res){
                echo "<script>alert('添加成功');location.href='".site_url('Admin/Type/lists')."'</script>";
            }
        }
    }

    /**
     * 类型列表
     */
    public function lists($page=1){
        if(IS_GET){
            $this->load->model('Type_model','type');
            $config=array(
                'page'=>$page,
                'page_num'=>10
            );
            $data=$this->type->type_select($config);
            //p($data);
            $this->load->view('Admin/type_lists',array('data'=>$data));
        }
    }

    /**
     * ajax数据
     */
    public function ajaxData(){
        $config=array(
            'page'=>$this->input->get('page'),
            'page_num'=>10
        );
        $this->load->model('Type_model','type');
        $data=$this->type->type_select($config);
        echo json_encode($data);
    }

    /**
     * 类型的修改
     * @param $id
     * @param $page
     */
    public function update($id,$page){
        if(IS_GET){
            $this->load->model('Type_model','type');
            $type=$this->type->type_select_one($id);
            $this->load->view('Admin/type_update',array('type'=>$type,'page'=>$page));
        }
        if(IS_POST){
            $data=$this->input->post();
            $id=$data['type_id'];
            $page=$data['page'];
            unset($data['page']);
            unset($data['type_id']);
            $this->load->model('Type_model','type');
            if($this->type->type_update($data,$id)){
                echo "<script>alert('修改成功');location.href='".site_url('Admin/Type/lists/').$page."'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".site_url('Admin/Type/lists/').$page."'</script>";
            }
        }
    }

    /**
     * ajax删除
     */
    public function del(){
        $id=$this->input->get("id");
        $this->load->model('Type_model','type');
        echo $this->type->type_del($id);
    }
}