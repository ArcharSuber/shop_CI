<?php
header("content-type:text/html;charset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');
class mypage{
    public $num;
    public $page_num;
    public $page_count;
    public $page;
    public $onclick="page";
    public $jquery="p";
    public $page_start_end=2;
    public $config;
    public $href;
    /**
     * 初始化总数据和每页显示的数据，默认为10条
     * @param $num
     * @param int $page_num
     */
    function __construct($config=array('num'=>0,'page_num'=>10,'page'=>1)){
        $this->num=intval($config['num']);
        $this->page_num=$config['page_num'];
        $this->page=$config['page'];
    }

    /**
     * 分页
     * @return string
     */
    function show()
    {
        $str="";
        //计算总页数
        $this->page_count = $page_count = ceil($this->num / $this->page_num);
        //当前页码前显示的页码  当前页码后显示的页码 页码的处理
        $start=$this->page-$this->page_start_end<1?1:$this->page-$this->page_start_end;
        $end=$this->page+$this->page_start_end>$page_count?$page_count:$this->page+$this->page_start_end;
        for ($i = $start; $i <= $end; $i++) {
            $str .= "<a href='?".$this->onclick."=" . $i . "'>" . $i . "</a>&nbsp;";
        }
        //上一页
        if($this->page>=1){
            $pagv=$this->page-1<1?1:$this->page-1;
            $pagv="<a href='?".$this->onclick."=".$pagv."'>".$this->config['left']."</a>";
        }
        //下一页
        if($this->page<=$page_count){
            $next=$this->page+1>$page_count?$page_count:$this->page+1;
            $next="<a href='?".$this->onclick."=".$next."'>".$this->config['right']."</a>";
        }
        //首页
        $first=1;
        $first="<a href='?".$this->onclick."=".$first."'>".$this->config['first']."</a>";
        //尾页
        $last=$this->page_count;
        $last="<a href='?".$this->onclick."=".$last."'>".$this->config['last']."</a>";
        return $first." ".$pagv." ".$str." ".$next." ".$last." "."<span style='font-size:12px;'>(第".$this->page."页/共".$page_count."页)</span><b>共".$this->num."条数据记录</b>";
    }

    /**
     * 设置函数
     * @param $config
     */
    function SetConfig($config){
       $this->config=$config;
    }

    /**
     * Ajax分页
     * @return string
     */
    function Ajaxpage(){
        $str="";
        //计算总页数
        $this->page_count = $page_count = ceil($this->num / $this->page_num);
        //当前页码前显示的页码  当前页码后显示的页码 页码的处理
        $start=$this->page-$this->page_start_end<1?1:$this->page-$this->page_start_end;
        $end=$this->page+$this->page_start_end>$page_count?$page_count:$this->page+$this->page_start_end;
        for ($i = $start; $i <= $end; $i++) {
            $str .= "<a href='javascript:;' onclick='".$this->onclick."(".$i.")'>" . $i . "</a>&nbsp;";
        }
        //上一页
        $pagv=$this->page-1<1?1:$this->page-1;
        $pagv="<a href='javascript:;' onclick='".$this->onclick."(".$pagv.")'>".$this->config['left']."</a>";
        //下一页
        $next=$this->page+1>$page_count?$page_count:$this->page+1;
        $next="<a href='javascript:;' onclick='".$this->onclick."(".$next.")'>".$this->config['right']."</a>";
        //首页
        $first=1;
        $first="<a href='javascript:;' onclick='".$this->onclick."(".$first.")'>".$this->config['first']."</a>";
        //尾页
        $last=$this->page_count;
        $last="<a href='javascript:;' onclick='".$this->onclick."(".$last.")'>".$this->config['last']."</a>";
        return $first." ".$pagv." ".$str." ".$next." ".$last." "."<span style='font-size:12px;'>(第".$this->page."页/共".$page_count."页)</span><b>共".$this->num."条数据记录</b>";
    }
    /**
     * jQuery的搜索分页
     * @return string
     */
    function Jquerypage(){
        $str="";
        //计算总页数
        $this->page_count = $page_count = ceil($this->num / $this->page_num);
        //当前页码前显示的页码  当前页码后显示的页码 页码的处理
        $start=$this->page-$this->page_start_end<1?1:$this->page-$this->page_start_end;
        $end=$this->page+$this->page_start_end>$page_count?$page_count:$this->page+$this->page_start_end;
        for ($i = $start; $i <= $end; $i++) {
            $str .= "<a href='javascript:;' id='".$this->jquery.$i."' class='".$this->onclick."'>" . $i . "</a>&nbsp;";
        }
        //上一页
        $pagv=$this->page-1<1?1:$this->page-1;
        $pagv="<a href='javascript:;' id='".$this->jquery.$pagv."' class='".$this->onclick."'>".$this->config['left']."</a>";
        //下一页
        $next=$this->page+1>$page_count?$page_count:$this->page+1;
        $next="<a href='javascript:;' id='".$this->jquery.$next."' class='".$this->onclick."'>".$this->config['right']."</a>";
        //首页
        $first=1;
        $first="<a href='javascript:;' id='".$this->jquery.$first."' class='".$this->onclick."'>".$this->config['first']."</a>";
        //尾页
        $last=$this->page_count;
        $last="<a href='javascript:;' id='".$this->jquery.$last."' class='".$this->onclick."'>".$this->config['last']."</a>";
        return $first." ".$pagv." ".$str." ".$next." ".$last." "."<span style='font-size:12px;'>(第".$this->page."页/共".$page_count."页)</span><b>共".$this->num."条数据记录</b>";
    }
}
/*$obj=new Page(100,5);
$config=array(
    'left'=>'<<',
    'right'=>'>>'
);
$obj->SetConfig($config);
echo $obj->show();*/
?>