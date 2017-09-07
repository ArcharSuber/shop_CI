<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Common_Controller{
    /**
     * 管理员列表
     */
    public function lists(){
        $this->load->model('Login_model','login');
        $arr=$this->login->getPageData();
        $this->load->view('Admin/admin_lists',array('data'=>$arr['data'],'show'=>$arr['show']));
    }
    /**
     * 管理员添加
     */
    public function add(){
        if(IS_GET){
            $this->load->model('Role_model','role');
            $role=$this->role->role_select($key=' role_status = ',$val='1');
            $this->load->view('Admin/admin_add',array('role'=>$role));
        }
        if(IS_POST){
            $data=$this->input->post();
            unset($data['pwd2']);
            $this->load->model('Role_model','role');
            $res=$this->role->admin_role_add($data['role_id']);
            if($res){
                unset($data['role_id']);
            }
            $data['admin_pwd']=md5($data['admin_pwd']);
            $data['admin_add_time']=time();
            $this->load->model('Login_model','login');
            if($this->login->login_add($data)){
                redirect('Admin/Admin/lists');
            }
        }
    }
    /**
     * ajax分页  返回数据
     */
    public function ajaxPage(){
        $data=$this->input->get();
        $this->load->model('Login_model','login');
        $arr=$this->login->getPageData($data);
        echo json_encode($arr);
    }

    /**
     * 数据删除
     */
    public function ajaxDel(){
        $data=$this->input->get();
        $this->load->model('Login_model','login');
        if($this->login->delData($data)) echo 0;
        else echo 1;
    }
    public function update($id){
        if(IS_GET){
            echo "开发比较费时，最后再做";
            echo $id;
        }
        if(IS_POST){

        }
    }
}