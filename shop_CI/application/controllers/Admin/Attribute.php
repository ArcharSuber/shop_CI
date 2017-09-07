<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attribute extends Common_Controller{
    /**
     * 属性添加
     */
    public function add(){
        if(IS_GET){
            $this->load->model('Type_model','type');
            $type=$this->type->get_typeData();
            $this->load->view('Admin/attribute_add',array('type'=>$type));
        }
        if(IS_POST){
            $this->load->model("Attribute_model",'attribute');
            $res=$this->attribute->attribute_add($this->input->post());
            if($res){
                echo "<script>alert('添加成功');location.href='".site_url('Admin/Attribute/lists')."'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='".site_url('Admin/Attribute/add')."'</script>";
            }
        }
    }

    /**
     * 默认展示页面
     * @param int $type_id
     */
    public function lists($type_id=0){
        if(IS_GET){
            $this->load->model("Attribute_model",'attribute');
            $config=array(
                'page'=>1,
                'page_num'=>10,
                'type_id'=>$type_id
            );
            $data=$this->attribute->getData($config);
            $this->load->model('Type_model','type');
            $data['type']=$this->type->get_typeData();
            //p($data);
            $this->load->view('Admin/attribute_lists',array('data'=>$data,'type_id'=>$type_id));
        }
    }

    /**
     * ajax 请求的数据返回
     */
    public function ajaxData(){
        $offset=$this->input->get();
        $offset['page_num']=10;
        $this->load->model("Attribute_model",'attribute');
        $data=$this->attribute->getData($offset);
        echo json_encode($data);
    }

    /**
     * 修改
     * @param $id
     */
    public function update($id){
        if(IS_GET){
            $this->load->model('Attribute_model','attr');
            $this->load->model('Type_model','type');
            $attr=$this->attr->attr_select_one($id);
            $type=$this->type->get_typeData();
            //p($attr);
            $this->load->view('Admin/attribute_update',array('attr'=>$attr,'type'=>$type));
        }
        if(IS_POST){
            $data=$this->input->post();
            $id=$data['attr_id'];
            unset($data['attr_id']);
            $this->load->model('Attribute_model','attr');
            if($this->attr->attribute_update($data,$id)){
                echo "<script>alert('修改成功');location.href='".site_url('Admin/Attribute/lists')."'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".site_url('Admin/Attribute/update/').$id."'</script>";
            }
        }
    }

}