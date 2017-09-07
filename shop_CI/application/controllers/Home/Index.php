<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function show(){
		$this->load->model('Cate_model','cate');
		$cate=getCateChildren($this->cate->cate_select());
		//print_r($cate);die;
		$this->load->view('Home/index',array('cate'=>$cate));
	}
}
