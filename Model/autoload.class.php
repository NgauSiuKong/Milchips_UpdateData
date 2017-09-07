<?php
//自动加载类
    class autoload
    { 
        public $ModelPath = 'D:\install\wamp\www\Milchips_UpdateData\Model\\';
        public $ControllerPath = 'D:\install\wamp\www\Milchips_UpdateData\Controller\\';
        public $PHPExcelPath = 'D:\install\wamp\www\Milchips_UpdateData\PHPExcel\\';
        public $path = 'D:\install\wamp\www\Milchips_UpdateData\\';
        //$path项目目录
        /*
        public function __construct()
        { 
            $this->path = "D:\install\wamp\www\Milchips_UpdateData\\";
            $this->ModelPath = $this->path.'\\'.'Model\\';
            $this->ControllerPath = $this->path.'\\'.'Controller\\';
            $this->PHPExcelPath = $this->path.'\\'.'PHPExcel'.'\\';
        }
        */
        public static function loadModel($class)
        { 
            $file_name = $class.".class.php";
            $file_path = 'D:\install\wamp\www\Milchips_UpdateData\Model\\'.$file_name;
            if(!is_file($file_path)){ 
                //echo (''.$file_path.',此Model类不存在');
            }
            include_once($file_path);
        }
        public static function loadController($class)
        { 
            $file_name = $class.".class.php";
            $file_path = 'D:\install\wamp\www\Milchips_UpdateData\Controller\\'.$file_name;
            if(!is_file($file_path)){ 
                //echo (''.$file_path.',此Controller类不存在');
            }
            include_once($file_path);
        }
        public static function loadPHPExcel($class)
        { 
            $file_name = $class.'.php';
            $file_path = 'D:\install\wamp\www\Milchips_UpdateData\PHPExcel\\'.$file_name;
            if(!is_file($file_path)){ 
                //echo (''.$class.',此PHPExcel类不存在');
            }
            include_once($file_path);
        }
        public static function loadPHPExcel_two($class)
        { 
            $file_name = $class.'.php';
            $file_path = 'D:\install\wamp\www\Milchips_UpdateData\PHPExcel\\'.'PHPExcel\\'.$file_name;
            if(!is_file($file_path)){ 
                //echo (''.$class.',此PHPExcel_two类不存在');
            }
            include_once($file_path);
        }
    }