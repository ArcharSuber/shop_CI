<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_Controller extends CI_Controller{
     function __construct(){
         parent::__construct();
         $session=$this->session->userdata('user');
         if(!$session['id']||!$session['user']){
             echo "<script>alert('非法登录，请先登录');location.href='".site_url('Admin/Login/index')."'</script>";
         }
         $controller=$this->router->fetch_class();
         $action=$this->router->fetch_method();
         $sql="select concat(node_controller,'/',node_action) as node from `shop_node` where node_id in(select node_id from `shop_role_node` where role_id in (select role_id from `shop_admin_role` where admin_id=?))";
         $data=$this->db->query($sql,array($this->session->userdata('user')['id']))->result_array();
         foreach($data as $val){
             $arr[]=$val['node'];
         }
         if(in_array($controller,$this->config->item('COMMON_CONTROLLER'))){
             return true;
         }
         if(in_array($this->session->userdata('user')['user'],$this->config->item('SUPER_ADMIN'))){
             return true;
         }
         if(!in_array($controller.'/'.$action,$arr)){
             //echo "<script>alert('您没有权限访问');</script>";
             redirect('Admin/Index/show');
         }
    }
}