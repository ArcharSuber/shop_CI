<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Node_model extends CI_Model{
    /**
     * 添加权限
     * @param $data
     * @return mixed
     */
   public function node_add($data){
        $this->db->insert('shop_node',$data);
       return $this->db->insert_id();
   }

    /**
     * 查询所有的权限
     * @return array
     */
    public function getdata(){
       return $this->db->get('shop_node')->result_array();
    }

    /**
     * 查询所有的node_id node_pid node_name
     * @return mixed
     */
    public function node_select(){
        return $this->db->select('node_id,node_pid,node_name')->get('shop_node')->result_array();
    }
}