<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Role extends Common_Controller{
    /**
     * 角色添加
     */
    public function add(){
        if(IS_GET){
            $this->load->model('Node_model','node');
            $data=getChildOrder($this->node->node_select());
            //p($data);
            $this->load->view('Admin/role_add',array('node'=>$data));
        }
        if(IS_POST){
            $data=$this->input->post(array('role_name','role_desc','role_status'));
            $this->load->model('Role_model','role');
            if($id=$this->role->role_add($data)){
                foreach($this->input->post(array('node_id'))['node_id'] as $k=>$v){
                    $arr[$k]['node_id']=$v;
                    $arr[$k]['role_id']=$id;
                }
                $this->load->model('Role_model','role');
                if($this->role->role_node_add($arr)){
                    echo "<script>alert('添加角色成功');location.href='".site_url('Admin/Role/lists')."'</script>";
                }
            }
        }
    }

    /**
     * 角色列表
     */
    public function lists(){
        $this->load->model('Role_model','role');
        $data=$this->role->role_select();
        $this->load->view('Admin/role_lists',array('data'=>$data));
    }
    /**
     * 给角色赋权
     */
    public function getNodes($role_id){
        if(IS_GET){
            $this->load->model('Role_model','role');
            $data=$this->role->getNodes($role_id);
            $this->load->model('Node_model','node');
            $node=getChildOrder($this->node->node_select());
            $this->load->view('Admin/role_getNodes',array('data'=>$data,'node'=>$node,'role_id'=>$role_id));
        }
        if(IS_POST){
            $data=$this->input->post();
            $this->load->model('Role_model','role');
            if($this->role->role_node_update($data)){
                echo "<script>alert('角色赋权成功');location.href='".site_url('Admin/Role/lists')."'</script>";
            }else{
                echo "<script>alert('角色赋权失败');location.href='".site_url('Admin/Role/lists')."'</script>";
            }
        }
    }

    /**
     * 角色修改
     */
    public function update($id){
        if(IS_GET){
            $this->load->model('Role_model','role');
            $role=$this->role->select_one($id);
            $this->load->view('Admin/role_update',array('role'=>$role));
        }
        if(IS_POST){
            $data=$this->input->post();
            $id=$data['role_id'];
            unset($data['role_id']);
            $this->load->model('Role_model','role');
            if($this->role->role_update($data,$id)){
                echo "<script>alert('修改成功');location.href='".site_url('Admin/Role/lists')."'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".site_url('Admin/Role/lists')."'</script>";
            }
        }
    }
}