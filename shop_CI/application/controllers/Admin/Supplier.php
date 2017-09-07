<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier extends Common_Controller{
    /**
     * 供货商添加
     */
    public function add(){
        if(IS_GET){
           $this->load->view('Admin/supplier_add');
        }
        if(IS_POST){
            $this->db->insert('shop_supplier',$this->input->post());
            if($this->db->insert_id()){
                redirect("Admin/Supplier/lists");
            }
        }
    }

    /**
     * 供货商列表
     */
    public function lists(){
        if(IS_GET){
            $data=$this->db->get('shop_supplier')->result_array();
            $this->load->view('Admin/supplier_lists',array('data'=>$data,'keyword'=>""));
        }
        if(IS_POST){
            $keyword=$this->input->post("keyword");
            $data=$this->db->or_like('supplier_name',$keyword)->or_like('supplier_desc',$keyword)->get('shop_supplier')->result_array();
            $this->load->view('Admin/supplier_lists',array('data'=>$data,'keyword'=>$keyword));
        }
    }

    /**
     * 列表修改
     * @param $id
     */
    public function update($id){
        if(IS_GET){
            $data=$this->db->where('supplier_id',$id)->get('shop_supplier')->row_array();
            $this->load->view('Admin/supplier_update',array('data'=>$data));
        }
        if(IS_POST){
            $data=$this->input->post();
            $id=$data['supplier_id'];
            unset($data['supplier_id']);
            $this->db->where('supplier_id',$id)->update("shop_supplier",$data);
            if($this->db->affected_rows()){
                echo "<script>alert('修改成功');location.href='".site_url('Admin/Supplier/lists')."'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".site_url('Admin/Supplier/update/').$id."'</script>";
            }
        }
    }
    /**
     * 列表删除
     */
    public function del($id){
        $this->db->where("supplier_id",$id)->delete('shop_supplier');
        if($this->db->affected_rows()){
            echo "<script>alert('删除成功');location.href='".site_url('Admin/Supplier/lists/')."'</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".site_url('Admin/Supplier/lists/')."'</script>";

        }
    }
}