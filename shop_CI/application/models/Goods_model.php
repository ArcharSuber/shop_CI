<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_model extends CI_Model{
    /**
     * 商品添加
     * @param $data
     * @return mixed
     */
    public function goods_add($data){
        $this->db->insert('shop_goods',$data);
        return $this->db->insert_id();
    }

    /**
     * 根据商品ID添加商品属性
     * @param $data
     * @param $id
     * @return mixed
     */
    public function goods_attribute_add($data,$id){
        if(empty($data['attr_id'])){
            return false;
        }
        foreach($data['attr_id'] as $k=>$v){
            $arr[$k]['attr_id']=$v;
            $arr[$k]['attr_value']=$data['attr_value'][$k];
            $arr[$k]['goods_id']=$id;
        }
        return $this->db->insert_batch('shop_goods_attribute',$arr);
    }

    /**
     * 商品图片的添加
     * @param $data
     * @param $id
     * @return mixed
     */
   public function goods_images_add($data,$id){
       if(empty($data['img_path'])){
           return false;
       }
       foreach($data['img_path'] as $k=>$v){
           $arr[$k]['img_path']=$v;
           $arr[$k]['img_url']=$data['img_url'][$k];
           $arr[$k]['img_desc']=$data['img_desc'][$k];
           $arr[$k]['goods_id']=$id;
       }
       return $this->db->insert_batch('shop_goods_img',$arr);
   }
    /**
     * 查询一条数据
     * @param $id
     * @return mixed
     */
    public function goods_select_one($id){
        return $this->db->where('goods_id',$id)->get('shop_goods')->row_array();
    }

    /**
     * 查询列表数据
     * @return mixed
     */
    public function goods_select($data=array('page'=>1,'page_num'=>10,'cate_id'=>0,'brand_id'=>0,'intro_type'=>0,'supplier_id'=>0,'garbage_status'=>0,'is_on_sale'=>'','keyword'=>"")){
        $where=array();
        $reg="/^\d+$/";
        if(!$data['cate_id']==0){
            $where['cate_id']=$data['cate_id'];
        }
        if(!$data['brand_id']==0){
            $where['brand_id']=$data['brand_id'];
        }
        if(!$data['intro_type']==0){
            $where['intro_type']=$data['intro_type'];
        }
        if(!$data['supplier_id']==0){
            $where['supplier_id']=$data['supplier_id'];
        }
        if(preg_match($reg,$data['is_on_sale'])){
            $where['is_on_sale']=$data['is_on_sale'];
        }
        $str="";
        if($where){
            foreach($where as $k=>$v){
                if($k=="intro_type"){
                    $str.=$v."=1 and ";
                    continue;
                }
                $str.=$k."=".$v." and ";
            }
            $str=rtrim($str," and ");
        }
       if(!empty($str)){
           $num=$this->db
               ->select(" count(goods_id) as num ")
               ->or_like("goods_name",$data['keyword'])
               ->where($str)
               ->where('garbage_status',$data['garbage_status'])
               ->or_like("goods_sn",$data['keyword'])
               ->where($str)
               ->where('garbage_status',$data['garbage_status'])
               ->get('shop_goods')
               ->row_array();
           //echo $this->db->last_query();die;
           $arr['page_count']=ceil($num['num']/$data['page_num']);
           $arr['num']=$num['num'];
           $arr['page_num']=$data['page_num'];
           $arr['page']=$data['page'];
           $arr['data']=$this->db
               ->select('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_order,goods_number')
               ->limit($data['page_num'],($data['page']-1)*$data['page_num'])
               ->or_like("goods_name",$data['keyword'])
               ->where($str)
               ->where('garbage_status',$data['garbage_status'])
               ->or_like("goods_sn",$data['keyword'])
               ->where($str)
               ->where('garbage_status',$data['garbage_status'])
               ->get_where('shop_goods',$str)
               ->result_array();
       }else{
           $num=$this->db
               ->select(" count(goods_id) as num ")
               ->or_like("goods_name",$data['keyword'])
               ->where('garbage_status',$data['garbage_status'])
               ->or_like("goods_sn",$data['keyword'])
               ->where('garbage_status',$data['garbage_status'])
               ->get_where('shop_goods')
               ->row_array();
           $arr['page_count']=ceil($num['num']/$data['page_num']);
           $arr['num']=$num['num'];
           $arr['page_num']=$data['page_num'];
           $arr['page']=$data['page'];
           $arr['data']=$this->db
               ->select('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_order,goods_number')
               ->limit($data['page_num'],($data['page']-1)*$data['page_num'])
               ->or_like("goods_name",$data['keyword'])
               ->where('garbage_status',$data['garbage_status'])
               ->or_like("goods_sn",$data['keyword'])
               ->where('garbage_status',$data['garbage_status'])
               ->get_where('shop_goods')
               ->result_array();
       }
//        p($arr);
        return $arr;
    }

    /**
     * 商品头像上传
     * @param $file
     * @return string
     */
    public function goods_face_upload($file){
        $this->load->library('upload/upload');
        $save_path="./uploads/Goods_face/";
        $path=$this->upload->uploadImg($file,$save_path);
        return substr($path,2);
    }

    /**
     * 根据商品ID查询商品的图片
     * @param $id
     * @return mixed
     */
    public function goods_select_images($id){
        return $this->db->where("goods_id",$id)->get('shop_goods_img')->result_array();
    }

    /**
     * 商品图片上传
     * @param $file
     * @return bool
     */
    public function goods_images_upload($file){
        $this->load->library('upload/upload');
        $save_path="./uploads/Goods_images/";
        $data=$this->upload->uploadMany($file,$save_path);
        if(empty($data)){
            return false;
        }
        foreach($data['path'] as $k=>$v){
            $path[$k]=substr($v,2);
        }
        return $path;
    }

    /**
     * 商品属性的查询
     * @param $id
     * @return bool
     */
    public function goods_attribute_select($id){
        $data=$this->db->where("goods_id",$id)->get('shop_goods_attribute')->result_array();
        foreach($data as $k=>$v){
            $arr=$this->db->select("attr_name,attr_input_type")->where("attr_id",$v['attr_id'])->get('shop_attribute')->row_array();
            $data[$k]['attr_name']=$arr['attr_name'];
            $data[$k]['attr_input_type']=$arr['attr_input_type'];
            if($arr['attr_input_type']==1){
                $attr_values=$this->db->where("attr_id",$v['attr_id'])->select('attr_values')->get('shop_attribute')->row_array();
                $attr_value=$this->db->where("attr_id",$v['attr_id'])->select('attr_value')->get('shop_goods_attribute')->row_array();
                $arr=explode(",",$attr_values['attr_values']);
                foreach($arr as $key=>$val){
                    $flag=0;
                    if($attr_value['attr_value']==$val){
                        $flag=1;
                    }
                    $data[$k]['attr_values'][$key]['flag']=$flag;
                    $data[$k]['attr_values'][$key]['attr_value']=$val;
                }
            }
        }
        return $data;
    }

    /**
     * 删除一张商品图片
     * @param $id
     * @return mixed
     */
    public function goods_image_del($id){
        $this->db->where('img_id',$id)->delete('shop_goods_img');
        return $this->db->affected_rows();
    }

    /**
     * 修改图片的信息
     * @param $id
     * @param $name
     * @return mixed
     */
    public function goods_desc_update($id,$name){
        $arr=array(
            'img_desc'=>$name
        );
        $this->db->where("img_id",$id)->update('shop_goods_img',$arr);
        return $this->db->affected_rows();
    }

    /**
     * 商品表的修改
     * @param $id
     * @param $data
     * @return mixed
     */
    public function goods_update($id,$data){
        $this->db->where('goods_id',$id)->update('shop_goods',$data);
        return $this->db->affected_rows();
    }

    /**
     * 商品属性的修改
     * @param $id
     * @param $data
     * @return mixed
     */
    public function goods_attribute_update($id,$data){
        if($data['attr_id'][0]==0){
           return false;
        }
        $this->db->where("goods_id",$id)->delete('shop_goods_attribute');
        foreach($data['attr_id'] as $k=>$v){
            $arr[$k]['attr_id']=$v;
            $arr[$k]['attr_value']=$data['attr_value'][$k];
            $arr[$k]['goods_id']=$id;
        }
        return $this->db->insert_batch('shop_goods_attribute',$arr);
    }
    /**
     * 商品cate_id 的修改  商品的转移
     * @param $data
     * @return mixed
     */
    public function goods_cate_update($data){
        $strId=explode("-",$data['cate_str']);
        $this->db->where_in("goods_id",$strId)->update('shop_goods',array('cate_id'=>$data['cate_id']));
        return $this->db->affected_rows();
    }
    /**
     * 商品supplier_id 的修改  商品供货商的转移
     * @param $data
     * @return mixed
     */
    public function goods_supplier_update($data){
        $strId=explode("-",$data['supplier_str']);
        $this->db->where_in("goods_id",$strId)->update('shop_goods',array('supplier_id'=>$data['supplier_id']));
        return $this->db->affected_rows();
    }
    /**
     * 商品详情查询
     * @param $id
     * @return mixed
     */
    public function goodsSelectInfo($id){
        $data=$this->db->where("goods_id",$id)->get("shop_goods")->row_array();
        $attribute=$this->db->select('attr_id,attr_value')->where('goods_id',$id)->get('shop_goods_attribute')->result_array();
        foreach($attribute as $k=>$v){
            $arr=$this->db->select('attr_type,attr_input_type,attr_values')->where('attr_id',$v['attr_id'])->get('shop_attribute')->row_array();
            $attribute[$k]=array_merge($v,$arr);
        }
        $data['goods_attribute']=$attribute;
        $data['goods_images']=$this->db->select('img_id,img_desc,img_url,img_path')->where('goods_id',$id)->get('shop_goods_img')->result_array();
        return $data;
    }

    /**
     *商品下拉选项的修改
     * @param $id
     * @param $key
     * @param $value
     * @return mixed
     */
    public function goodsSelectUpdate($id,$key,$value){
        $id=explode(",",$id);
        $this->db->where_in("goods_id",$id)->update('shop_goods',array($key=>$value));
        return $this->db->affected_rows();
    }

    /**
     * 从回收站中删除
     * @param $id
     * @return mixed
     */
    public function goodsGarbageDel($id){
        $id=explode(",",$id);
        $this->db->where_in("goods_id",$id)->delete('shop_goods');
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
            ->where_in("goods_id",$arr)
            ->select('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_order,goods_number')
            ->get("shop_goods")
            ->result_array();
    }
}