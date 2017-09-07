<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attribute_model extends CI_Model{
    /**
     * 商品属性添加
     * @param $data
     * @return mixed
     */
       public function attribute_add($data){
           $this->db->insert('shop_attribute',$data);
           return $this->db->insert_id();
       }

    /**
     * ajax 数据的查询
     * @param array $data
     * @return mixed
     */
    public function getData($data=array('page_num'=>10,'page'=>1,'type_id'=>0)){
        if($data['type_id']==0){
            $num=$this->db
                ->select("count(attr_id) as num")
                ->get('shop_attribute')
                ->row_array();
            $arr['data']=$this->db
                ->limit($data['page_num'],($data['page']-1)*$data['page_num'])
                ->get('shop_attribute')
                ->result_array();
        }else{
            $num=$this->db
                ->select("count(attr_id) as num")
                ->where("type_id =",$data['type_id'])
                ->get('shop_attribute')
                ->row_array();
            $arr['data']=$this->db
                ->where("type_id =",$data['type_id'])
                ->limit($data['page_num'],($data['page']-1)*$data['page_num'])
                ->get('shop_attribute')
                ->result_array();
        }
        $config=array(
            'num'=>$num['num'],
            'page_num'=>$data['page_num'],
            'page'=>$data['page']
        );
        $this->load->library('page/mypage',$config);
        $offset=array(
            'first'=>'首页',
            'last'=>'尾页',
            'left'=>'上一页',
            'right'=>'下一页'
        );
        foreach($arr['data'] as $k=>$val){
            $type_name=$this->db->query("select type_name from shop_type where type_id=".$val['type_id'])->row_array();
            $arr['data'][$k]['type_name']=$type_name['type_name'];
        }
        $this->mypage->SetConfig($offset);
        $arr['show']=$this->mypage->Jquerypage();
        $arr['page']=$data['page'];
        return $arr;
    }

    /**
     * 查询一条数据
     * @param $id
     * @return mixed
     */
    public function attr_select_one($id){
        return $this->db->where("attr_id",$id)->get('shop_attribute')->row_array();
    }

    /**
     * 根据ID修改一条数据
     * @param $data
     * @param $id
     * @return mixed
     */
    public function attribute_update($data,$id){
        $this->db->where('attr_id',$id)->update("shop_attribute",$data);
        return $this->db->affected_rows();
    }

    /**
     * 根据类型ID获得属性
     * @param $id
     * @return mixed
     */
    public function get_attrData($id){
        $data=$this->db->select('attr_id,attr_name,attr_input_type,attr_values')->where('type_id',$id)->get('shop_attribute')->result_array();
        foreach($data as $k=>$v){
            if(!$v['attr_input_type']==0||!$v['attr_input_type']==2){
                $data[$k]['attr_values']=explode(',',$v['attr_values']);
            }
        }
        return $data;
    }
}