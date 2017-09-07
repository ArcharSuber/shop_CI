<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Node extends Common_Controller{
    /**
     * 权限控制列表
     */
    public function lists(){
        $this->load->model('Node_model','node');
        $data=getNodeOrder($this->node->getdata());
        //p($data);
        $this->load->view('Admin/node_lists',array('list'=>$data));
    }

    /**
     * 权限控制添加
     */
    public function add(){
        if(IS_GET){
            $this->load->model('Node_model','node');
            $data=getNodeOrder($this->node->node_select());
            $this->load->view('Admin/node_add',array('node'=>$data));
        }
        if(IS_POST){
            $data=$this->input->post();
            $this->load->model('Node_model','node');
            if($this->node->node_add($data)){
                redirect("Admin/Node/lists");
            }else{
                echo "<script>alert('添加失败');</script>";
            }
        }
    }
}