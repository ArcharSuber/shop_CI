<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
    /**
     * 查询登录人的数据
     * @param $data
     * @return mixed
     */
    public function login_do($data){
        $data['admin_pwd']=md5($data['admin_pwd']);
        $sql="select admin_id from `shop_admin` where admin_name=? and admin_pwd=?";
        return $this->db->query($sql,$data)->row_array();
    }

    /**
     * 修改最后一次登陆的时间和ip地址
     * @param $arr
     * @return mixed
     */
    public function login_update($arr,$id){
        $this->db->where("admin_id",$id)->update('shop_admin',$arr);
        return $this->db->affected_rows();
    }

    /**
     * 管理员添加
     * @param $data
     * @return mixed
     */
    public function login_add($data){
        $this->db->insert('shop_admin',$data);
        return $this->db->insert_id();
    }

    /**
     * 条件分页查询  返回数据 页码
     * @param array $data
     * @return array
     */
    public function getPageData($data=array('page'=>1,'keyword'=>"")){
        $num=$this->db
            ->or_like('admin_name',$data['keyword'])
            ->or_like('admin_tel',$data['keyword'])
            ->or_like('admin_sit_tel',$data['keyword'])
            ->or_like('admin_address',$data['keyword'])
            ->or_like('admin_email',$data['keyword'])
            ->select('count(admin_id) as num')
            ->get('shop_admin')->row_array();
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
            ->or_like('admin_name',$data['keyword'])
            ->or_like('admin_tel',$data['keyword'])
            ->or_like('admin_sit_tel',$data['keyword'])
            ->or_like('admin_address',$data['keyword'])
            ->or_like('admin_email',$data['keyword'])
            ->select('admin_id,admin_name,admin_sex,admin_age,admin_zu,admin_tel,admin_sit_tel,admin_address,admin_email,admin_add_time')
            ->get('shop_admin',$page_num,$page_num*(intval($data['page'])-1))
            ->result_array();
        //搜索后关键字变红
        foreach($arr as $k=>$v){
            $arr[$k]['admin_name']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['admin_name']);
            $arr[$k]['admin_tel']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['admin_tel']);
            $arr[$k]['admin_sit_tel']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['admin_sit_tel']);
            $arr[$k]['admin_address']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['admin_address']);
            $arr[$k]['admin_email']=str_replace($data['keyword'],"<font color='red'><strong>".$data['keyword']."</strong></font>",$v['admin_email']);
            $arr[$k]['admin_add_time']=date("Y-m-d H:i:s",$v['admin_add_time']);
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

    /**
     * 数据删除
     * @param $data
     * @return mixed
     */
    public function delData($data){
        $this->db->delete('shop_admin','admin_id in( '.$data["id"].')');
        return $this->db->affected_rows();
    }
}