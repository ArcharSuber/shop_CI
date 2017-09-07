<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Type_model extends CI_Model{
    /**
     * 类型的添加
     * @param $data
     * @return mixed
     */
    public function type_add($data){
        $this->db->insert('shop_type',$data);
        return $this->db->insert_id();
    }

    /**
     * 查询列表的 数据
     * @return mixed
     */
    public function type_select($data=array('page'=>1,'page_num'=>10)){
        $num=$this->db->select(" count(type_id) as num ")->get('shop_type')->row_array();
        $config=array(
            'page_num'=>$data['page_num'],
            'num'=>$num['num'],
            'page'=>$data['page']
        );
        $this->load->library('page/mypage',$config);
        $arr['data']=$this->db->limit($data['page_num'],($data['page']-1)*$data['page_num'])->get('shop_type')->result_array();
        foreach($arr['data'] as $k=>$v){
            $num=$this->db->select("count(attr_id) as num")->where('type_id',$v['type_id'])->get('shop_attribute')->row_array();
            $arr['data'][$k]['attribute_num']=$num['num'];
        }
        $offset=array(
            'first'=>'首页',
            'last'=>'尾页',
            'left'=>'上一页',
            'right'=>'下一页'
        );
        $this->mypage->SetConfig($offset);
        $arr['show']=$this->mypage->Jquerypage();
        $arr['page']=$data['page'];
        return $arr;
    }

    /**
     * 查询启用的类型ID 和名称
     * @return mixed
     */
    public function get_typeData(){
        return $this->db->select('type_id,type_name')->where('type_status =',1)->get('shop_type')->result_array();
    }

    /**
     * 查询一条数据
     * @param $id
     * @return mixed
     */
    public function type_select_one($id){
        return $this->db->where('type_id',$id)->get('shop_type')->row_array();
    }

    /**
     * 根据ID修改一条数据
     * @param $data
     * @param $id
     * @return mixed
     */
    public function type_update($data,$id){
        $this->db->where('type_id',$id)->update('shop_type',$data);
        return $this->db->affected_rows();
    }

    /**
     * 删除一条类型数据
     * @param $id
     * @return mixed
     */
    public function type_del($id){
        $this->db->where('type_id',$id)->delete('shop_type');
        return $this->db->affected_rows();
    }
}