<?php
    header('content-type:text/html;charset=utf-8');
    date_default_timezone_set('Asia/Harbin');
	$item_path = dirname(dirname(__FILE__))."\\";
    define('__FILE_PATH__',$item_path);
    //导入入口文件
    require_once(__FILE_PATH__.'Config\Index_SelectAgentForMilchips.php');

    $MDatabaseOperate = new DatabaseOperate(__MYSQL_HOST__,__MYSQL_USER__,__MYSQL_PASS__,__MYSQL_DBNAME__);
    $COpArr = new OpArr;
    $MMilchipsData = new MilchipsData;
    /*
    $sql = "select product_model,product_id from t_product where product_id>856230 group by product_model order by product_id limit 50000,10000";
    $arr = $MDatabaseOperate->getAllArray($sql);
    */
    $MDB = DB::getIntance();
    $tmp_prdct_sql = "select product_id from tmp_product limit 10000";
    $tmp_prdct = $MDB->getAll($tmp_prdct_sql);
    $sql = "";
    $product_info = array();
    foreach($tmp_prdct as $key => $val){ 
        //查询详细信息
        $product_info = $MDB->getAll($MMilchipsData->selProductSql($val['product_id']));
        //查询价格
        $product_price = $MDB->getAll($MMilchipsData->selPriceSql($val['product_id']));
        $mile_Data = $MMilchipsData->milEdata($product_info,$product_price);
        $sql = $MMilchipsData->milesqlProduct($mile_Data);
        $id = $MDatabaseOperate->getAddId($sql);
        echo $id."<hr>";
    }
    //$arr = $MMilchipsData->ArrtransOne($arr);
    /*
    var_dump(count($arr));
    
    echo "<pre>";
        print_r($arr);
    echo "</pre>";
    */
    /*
    $tmp2 = "";
    foreach($arr as $key => $val){ 
        $tmp1 = "insert into tmp_product (`product_id`,`product_model`) values";
        $tmp2 .= "('{$val['product_id']}','{$val['product_model']}'),"; 
    }
    
    $sql = rtrim($tmp1.$tmp2,',');

    $row = $MDatabaseOperate->getRows($sql);
    echo $row;
    */
    /*
    $tmp_prdct_sql = "select product_id from tmp_product limit 0,500";
    $tmp_prdct = $MDatabaseOperate->getAllArray($tmp_prdct_sql);
    echo "<pre>";
        print_r($tmp_prdct);
    echo "</pre>";
    */
    /*
    $product_arr = array();
    foreach($arr as $key => $val){ 
        $sql_tmp = $MMilchipsData->selProductSql($val['product_id']);
        $product_arr[] = $MDatabaseOperate->getOneArray($sql_tmp);
    }
    echo "<pre>";
        print_r($product_arr);
    echo "</pre>";
    */
    /*
    $sql_tmp = $MMilchipsData->selProductSql(859681);
    $arr_tmp = $MDatabaseOperate->getOneArray($sql_tmp);
    echo "<pre>";
        print_r($arr_tmp);
    echo "</pre>";

    $sql_price = $MMilchipsData->selPriceSql(859681);
    $arr_price = $MDatabaseOperate->getAllArray($sql_price);
    echo "<pre>";
        print_r($arr_price);
    echo "</pre>";
    */
    /*
    $arr_tmp = $MDatabaseOperate->getOneArray($sql_tmp);
    var_dump($arr_tmp);
    */
    /*
    $sql_product = "select * from t_product where product_id = 859681";
    $arr_product = $MDatabaseOperate->getAllArray($sql_product);
    echo "<pre>";
        print_r($arr_product);
    echo "</pre>";
    */