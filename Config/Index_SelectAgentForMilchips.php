<?php
    header('content-type:text/html;charset=utf-8');
    require_once(__FILE_PATH__.'Config\\config.php');
    //关于自动加载
    require_once(__FILE_PATH__.'Model\\autoload.class.php');
    spl_autoload_register("autoload::loadPHPExcel");
    spl_autoload_register("autoload::loadPHPExcel_two");
    spl_autoload_register("autoload::loadController");
    spl_autoload_register("autoload::loadModel");
    
    
?>