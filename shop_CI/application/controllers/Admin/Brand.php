<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand extends Common_Controller{
    /**
     * 商品品牌添加
     */
  public function add(){
      if(IS_GET){
          $this->load->view('Admin/brand_add',array('error'=>""));
      }
      if(IS_POST){
          $data=$this->input->post();
          $data['brand_time']=time();
          //$file=$_FILES['brand_logo'];
          $path=$this->do_upload('brand_logo');
          $data['brand_logo']=$path;
          $this->load->model('Brand_model','brand');
          if($this->brand->brand_add($data)){
              echo "<script>alert('品牌添加成功');location.href='".site_url('Admin/Brand/lists')."'</script>";
          }else{
              echo "<script>alert('品牌添加失败');location.href='".site_url('Admin/Brand/add')."'</script>";
          }
      }
  }

    /**
     * 商品列表展示
     */
    public function lists(){
        $this->load->model('Brand_model','brand');
        $data=$this->brand->getData();
        //p($data);
        $this->load->view('Admin/brand_lists',array('data'=>$data));
    }

    /**
     * 文件上传
     * @param $file_name
     * @return mixed
     */
    public function do_upload($file_name)
    {
        $config['upload_path'] = './uploads/Brand/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2097152;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_name)) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('Admin/brand_add', array('error' => $error['error']));
        } else {
            $data = array('upload_data' => $this->upload->data());
            //p($data);
            return "uploads/Brand/".$data['upload_data']['file_name'];
        }
    }

    /**
     * ajax 返回数据   分页
     */
    public function ajaxData(){
        $data=$this->input->get();
        //p($data);
        $this->load->model('Brand_model','brand');
        $arr=$this->brand->getData($data);
        echo json_encode($arr);
    }
}