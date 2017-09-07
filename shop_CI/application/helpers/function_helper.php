<?php
//打印函数
function p($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";die;
}
/**
 * 定义权限控制的下拉菜单分级处理 2级 不要用递归
 */
function getNodeOrder($data){
    $arr=array();
    foreach($data as $k=>$v){
        if($v['node_pid']==0){
            $v['deep']=0;
            $arr[]=$v;
            unset($data[$k]);
            foreach($data as $kk=>$vv){
                if($vv['node_pid']==$v['node_id']){
                    $vv['deep']=1;
                    $arr[]=$vv;
                    unset($data[$kk]);
                }
            }
        }
    }
    return $arr;
}

/**
 * 定义权限控制的子级的处理 2级 不用递归
 */
function getChildOrder($data){
    $arr=array();
    foreach($data as $k=>$v){
        if($v['node_pid']==0){
            unset($data[$k]);
            foreach($data as $kk=>$vv){
                if($vv['node_pid']==$v['node_id']){
                    $v['child'][]=$vv;
                    unset($data[$kk]);
                }
            }
            $arr[]=$v;
        }
    }
    return $arr;
}
/**
 * 无限极分类 全路径处理  多级递归处理
 */
function getCateChildren($data,$pid=0){
    $arr=array();
    foreach($data as $k=>$v){
        $v['pid']=substr($v['cate_path'],strrpos($v['cate_path'],',')+1);
        if(!$v['pid']){
            $v['pid']=0;
        }
        if($v['pid']==$pid){
            unset($data[$k]);
            if(getCateChildren($data,$v['cate_id'])){
                $v['children']=getCateChildren($data,$v['cate_id']);
            }else{
                $v['children']=array();
            }
            $arr[]=$v;
        }
    }
    return $arr;
}