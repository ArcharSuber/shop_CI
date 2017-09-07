<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cate_model extends CI_Model{
    /**
     * 查询cate_id cate_name cate_path  字段
     * @return mixed
     */
    public function cate_select(){
        $sql="select cate_id,cate_path,cate_name,concat(cate_path,',',cate_id) as full_path from shop_cate order by full_path";
        return $this->db->query($sql)->result_array();
    }

    /**
     * 添加分类入库
     * @param $data
     * @return mixed
     */
    public function cate_add($data){
        $this->db->insert('shop_cate',$data);
        return $this->db->insert_id();
    }
    /**
     * 查询所有的分类 数组处理
     * @return mixed
     */
    public function cate_data(){
        $sql="select *,concat(cate_path,',',cate_id) as full_path from shop_cate order by full_path asc";
        $data=$this->db->query($sql)->result_array();
        //p($data);
        foreach($data as $k=>$v){
            $data[$k]['cate_time']=date("Y-m-d H:i:s",$v['cate_time']);
            if($pid=substr($v['cate_path'],strrpos($v['cate_path'],',')+1)){
                $data[$k]['pid']=$pid;
            }else{
                $data[$k]['pid']=0;
            }
            $num=$this->db->select('count(goods_id) as num')->where('cate_id',$v['cate_id'])->get('shop_goods')->row_array();
            $data[$k]['goods_num']=$num['num'];
            $data[$k]['cate_name']=str_repeat("★★★",substr_count($v['cate_path'],',')).$v['cate_name'];
            $data[$k]['cate_path']=str_replace(","," ",$v['cate_path']);
        }
        return $data;
    }

    /**
     * 查询一条数据
     * @param $id
     * @return mixed
     */
    public function cate_select_one($id){
        $data=$this->db->where("cate_id",$id)->get('shop_cate')->row_array();
        $arr=explode(',',$data['cate_path']);
        $data['pid']=$arr[count($arr)-1];
        return $data;
    }

    /**
     * 删除一条分类的数据
     * @param $id
     * @return mixed
     */
    public function cate_del($id){
        $this->db->where('cate_id',$id)->delete('shop_cate');
        return $this->db->affected_rows();
    }

    /**
     * 分类的修改
     * @param $id
     * @param $data
     * @return mixed
     */
    public function cate_update($id,$data){
        $this->db->where('cate_id',$id)->update('shop_cate',$data);
        return $this->db->affected_rows();
    }
    /**
     * 商品cate_id 的修改  商品的转移
     * @param $data
     * @return mixed
     */
    public function goods_cate_update($data){
        $strId=str_replace("-",",",$data['cate_str']);
        $this->db->where_in("cate_id",$strId)->update('shop_goods',array('cate_id'=>$data['cate_id']));
        return $this->db->affected_rows();
    }
    /**
     * 查询要转移的商品
     * @param $data
     * @return mixed
     */
    public function removeGoodsSelect($data){
        $arr=explode("-",$data);
        return $this->db
            ->where_in("cate_id",$arr)
            ->select('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_order,goods_number')
            ->get("shop_goods")
            ->result_array();
    }
}