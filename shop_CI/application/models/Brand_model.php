<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand_model extends CI_Model{
    /**
     * 品牌添加
     * @param $data
     * @return mixed
     */
    public function brand_add($data){
        $this->db->insert('shop_brand',$data);
        return $this->db->insert_id();
    }

    /**
     * 查询品牌的ID 和名称
     * @return mixed
     */
    public function brand_select(){
        return $this->db->select("brand_id,brand_name")->get('shop_brand')->result_array();
    }
    /**
     * 根据条件 返回数据-页码展示-当前页码
     * @param array $data
     * @return array
     */
    public function getData($data=array('page'=>1,'keyword'=>"")){
        $num=$this->db
            ->or_like('brand_name',$data['keyword'])
            ->select('count(brand_id) as num')
            ->get('shop_brand')->row_array();
        //echo $this->db->last_query();die;
        $page_num=10;
        // p($num);
        $config=array(
            'num'=>$num['num'],
            'page_num'=>$page_num,
            'page'=>$data['page']
        );
        $this->load->library('page/mypage',$config);
        $arr=$this->db
            ->or_like('brand_name',$data['keyword'])
            ->get('shop_brand',$page_num,$page_num*(intval($data['page'])-1))
            ->result_array();
        //p($arr);
        //搜索后关键字变红
        foreach($arr as $k=>$v){
            $arr[$k]['brand_name']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['brand_name']);
            $arr[$k]['brand_time']=date("Y-m-d H:i:s",$v['brand_time']);
        }
        $setconfig=array(
            'first'=>'首页',
            'last'=>'尾页',
            'left'=>'上一页',
            'right'=>'下一页'
        );
        $this->mypage->SetConfig($setconfig);
        $show=$this->mypage->Jquerypage();
        return array('data'=>$arr,'show'=>$show,'page'=>$data['page']);
    }
}