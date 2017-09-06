<?php
//phpexcel操作类
class opphpexcel
{

    protected $Obj_in_PHPExcel;
    protected $Obj_out_PHPExcel;
    //构造方法实例化导入phpexcel插件以及实例化操作类保存在属性中
    //$path_in,导入工具  $path_out,导出工具
    public function __construct($path_in,$path_out)
    { 
        //必须传参
        if(empty($path_in) || empty($path_out)){ 
            echo "实例化对象发生错误,构造函数传参为空";
            die();
        }
        //文件是否存在
        if(!file_exists($path_in) || !file_exists($path_out)){ 
            echo "传入的路径有误，请细心检查";
            
            die()
        }
        //导入
        require_once $path_in;
        //实例化
        $this->Obj_in_PHPExcel =  PHPExcel_IOFactory::load($fileName);
        $this->Obj_out_PHPExcel = 
    }
}
?>
