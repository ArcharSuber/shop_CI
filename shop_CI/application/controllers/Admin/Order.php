<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends Common_Controller{
    public function add(){
        if(IS_GET){
            $this->load->view('Admin/order_add');
        }
        if(IS_POST){
            p($this->input->post());
        }
    }
    public function lists(){
        $this->load->view('Admin/order_lists');
    }

    /**
     * ajax 请求订单号
     */
    public function ajaxOrderSn(){
        echo str_pad(time().mt_rand(0,9999).mt_rand(0,999).mt_rand(0,999),20,"0",STR_PAD_RIGHT);
    }
}