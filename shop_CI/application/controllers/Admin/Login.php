<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('Admin/login');
	}

	/**
	 * 登录验证
	 */
	public function login_do(){
		if(!$this->code_check()){
			echo "<script>alert('验证码不正确!');location.href='".site_url('Admin/Login/index')."'</script>";die;
		}else{
			$this->load->model("Login_model",'login');
			//$res=$this->login->login_do($this->input->post(array('admin_name','admin_pwd')));
			if($res=$this->login->login_do($this->input->post(array('admin_name','admin_pwd')))){
				$data=array('id'=>$res['admin_id'],'user'=>$this->input->post('admin_name'));
				$this->session->set_userdata("user",$data);
				//$_SESSION['user']=$data;
				//获取并修改最后一次登录的时间和ip
				$this->load->model('Login_model','login');
				$arr=array(
					'admin_last_time'=>time(),
					'admin_ip'=>$this->input->ip_address()
				);
				$id=$data['id'];
				$this->login->login_update($arr,$id);
				redirect('Admin/Index/show');
			}else{
				echo "<script>alert('账号或密码不正确!');location.href='".site_url('Admin/Login/index')."'</script>";
			}
		}
	}
	/**
	 * 生成验证码图片的方法
	 */
	public function code(){
		$this->load->library('code/code');
		$word=$this->code->getCaptcha();
		$this->session->set_userdata("code",$word);
		$this->code->showImg();
	}
	/**
	 * 验证码验证的方法
	 */
	public function code_check(){
		$code1 = strtolower($this->input->post('code'));      //获取表单中用户输入的验证码值
		$code2 = strtolower($this->session->userdata('code'));   //获取事先保存于session的验证码值

		if($code1 != $code2){
			//如果不等则验证失败，输出验证失败信息（这里的代码根据你的情况写吧）
			return false;
		}else{
			return true;
		}
	}
}
