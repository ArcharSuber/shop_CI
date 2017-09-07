<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends Common_Controller{
    /**
     * 主界面展示
     */
    public function show(){
        $this->load->view('Admin/index');
    }
    public function top(){
        $this->load->view("Admin/html/top");
    }
    public function main(){
        $this->load->view("Admin/html/main");
    }
    public function menu(){
        $this->load->view("Admin/html/menu");
    }
    public function drag(){
        $this->load->view("Admin/html/drag");
    }
}