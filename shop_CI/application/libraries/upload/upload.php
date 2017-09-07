<?php
header("content-type:text/html;charset=utf-8");
class upload{
    //定义错误的文本  静态属性s
    public static $error="";
    //定义属性
    public $type=array('image/jpg','image/jpeg','image/png','image/gif','image/bmp');
    public $max=2;//定义兆数
    public $max_size=2097152;
    //初始化规定文件的大小
    /*function __construct(){
        $this->max_size=1024*1024*$this->max;
    }*/
    /**
     * 定义单文件上传方法
     * @param $file
     * @return bool|string
     */
    function uploadImg($file,$save_path="./"){
        $res1=$this->check_type($file['type']);
        $res2=$this->check_error($file['error']);
        $res3=$this->check_size($file['size']);
        if($res1&&$res2&&$res3){
            //新路径
            $path=$this->getPath($file['name'],$save_path);
            //上传
            $res=move_uploaded_file($file['tmp_name'],$path);
            if($res){
                return $path;
            }
        }else{
            return false;
        }
    }
    /**
     * 验证文件的错误级别
     * @param $file_error
     * @return bool
     */
    function check_error($file_error){
        switch($file_error){
            case 0: return true;
            case 1: self::$error="上传的文件超过了php.ini中的设置";return false;
            case 2: self::$error="上传的文件超过了form表单中的设置";return false;
            case 3: self::$error="只有部分文件被上传";return false;
            case 4: self::$error="没有文件被上传";return false;
        }
    }
    /**
     * 验证文件的类型
     * @param $file_type
     * @return bool
     */
    function check_type($file_type){
        if(!in_array($file_type,$this->type)){
            self::$error="文件的格式支持图片的jpg、jpeg、png、gif、bmp的格式"; return false;
        }else{
            return true;
        }
    }
    /**
     * 验证文件的大小
     * @param $file_size
     * @return bool
     */
    function check_size($file_size){
        if($file_size > $this->max_size){
            self::$error="请上传".$this->max."M以内的文件";return false;
        }else{
            return true;
        }
    }
    function getPath($file_name,$save_path){
        //修改文件的名称  拼接当前的时间戳+4位的数字和字母随机数
        $arr=strtoupper("a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
        $data=explode(',',$arr);
        $file_type=substr($file_name,strrpos($file_name,'.')+1);
        $file_name=time()."_".rand(1,9).$data[rand(0,25)].rand(1,9).$data[rand(0,25)].'.'.$file_type;
        //文件上传的路径
        $path=$save_path.date('Y')."/".date('m')."/".date('d')."/";
        //检测文件上传的路径是否存在  不存在则创建
        if(!file_exists($path)){
            mkdir($path,0777,true);
        }
        $path=$path.$file_name;
        return $path;
    }
    /**
     * 定义下载方法
     * @param $path
     * @return int
     */
    function downLoad($path){
        //路径转化为文件名
        $path=basename($path);
        //文件类型
        header("content-type: image/jpeg");
        //激活一个下载的窗口  (文件名)
        header("content-Disposition: attachment; filename=$path");
       return  readfile($path);
    }

    /**
     * 多文件上传
     * @param $file
     * @return bool
     */
    function uploadMany($file,$save_path="./"){
        $m=0;
        foreach($file['name'] as $k=>$v){
            $res1=$this->check_type($file['type'][$k]);
            $res2=$this->check_error($file['error'][$k]);
            $res3=$this->check_size($file['size'][$k]);
            if($res1&&$res2&&$res3){
                //新路径
                $path[$k]=$this->getPath($file['name'][$k],$save_path);
                //上传
                $res=move_uploaded_file($file['tmp_name'][$k],$path[$k]);
                if($res){
                    $data['path'][$k]=$path[$k];
                    $m++;
                }
            }else{
                return false;
            }
        }
        if(count($data['path'])==$m){
            return $data;
        }
    }
}
?>
