<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Role_model extends CI_Model{
    /**
     * 添加角色
     * @param $data
     * @return mixed
     */
   public function role_add($data){
       $this->db->insert('shop_role',$data);
       return $this->db->insert_id();
   }

    /**
     * 角色-权限派生表中添加数据
     * @param $arr
     * @return mixed
     */
    public function role_node_add($arr){
        return $this->db->insert_batch('shop_role_node',$arr);
    }

    /**
     * 查询所有的角色
     * @return mixed
     */
    public function role_select($key='1 = ',$val='1'){
        return $this->db->where($key,$val)->get('shop_role')->result_array();
    }
    /**
     * 根据角色ID查询出角色名称和以前的权限
     * @param $role_id
     */
    public function getNodes($role_id){
        $arr=$this->db->select('role_name')->where('role_id = ',$role_id)->get('shop_role')->row_array();
        $res=$this->db->where('role_id = ',$role_id)->select('node_id')->get('shop_role_node')->result_array();
        if($res){
            foreach($res as $k=>$v){
                $arr['node_id'][]=$v['node_id'];
            }
        }else{
            $arr['node_id'][]=array();
        }
        return $arr;
    }

    /**
     * 角色赋权
     * @param $data
     * @return bool
     */
    public function role_node_update($data){
        $res=$this->db->where('role_id = ',$data['role_id'])->delete('shop_role_node');
        foreach($data['node_id'] as $k=>$v){
            $arr[$k]['node_id']=$v;
            $arr[$k]['role_id']=$data['role_id'];
        }
        $res2=$this->db->insert_batch('shop_role_node',$arr);
        return $res||$res2;
    }

    /**
     * 管理员-角色派生表的添加
     * @param $role_id
     * @return mixed
     */
    public function admin_role_add($role_id){
        foreach($role_id as $k=>$v){
            $arr[$k]['role_id']=$v;
            $arr[$k]['admin_id']=$this->session->userdata("user")['id'];
        }
        return $this->db->insert_batch('shop_admin_role',$arr);
    }

    /**
     * 查询一条数据
     * @param $id
     * @return mixed
     */
    public function select_one($id){
        return $this->db->where('role_id',$id)->get('shop_role')->row_array();
    }

    /**
     * 修改一条数据
     * @param $data
     * @param $id
     * @return mixed
     */
    public function role_update($data,$id){
        $this->db->where('role_id',$id)->update('shop_role',$data);
        return $this->db->affected_rows();
    }
}