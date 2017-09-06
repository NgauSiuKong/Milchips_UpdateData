<?php
    header('content-type:text/html;charset=utf-8');
	die("基本数据上传完毕,轻易不可运行");

    //Require Database Class
    date_default_timezone_set('Asia/Harbin');
    require "../Config/config.php";
    require "../Model/DatabaseOperate.class.php";
    require "../PHPExcel/PHPExcel/IOFactory.php";
    require "../Controller/Inphpexcel.class.php";
    require "../Controller/OpArr.class.php";
    require "../PHPExcel/PHPExcel.php";
    require "../Model/functions.class.php";
    $MDatabaseOperate = new DatabaseOperate(__MYSQL_HOST__,__MYSQL_USER__,__MYSQL_PASS__,__MYSQL_DBNAME__);
    //瀹炰緥鍖栨搷浣滅被

    $CInphpexcel = new Inphpexcel("../PHPExcel/PHPExcel/IOFactory.php","../File/format/prd_105.xlsx");
    $COpArr = new OpArr;
    $CFunctions = new functions($MDatabaseOperate);
    //瀵煎叆鏁版嵁
    $product_arr = $CInphpexcel->colrowCellInsert();
    
    //$product_arr = array_values($product_arr);
    $product_arr = $COpArr->opPrice($product_arr);
    $product_arr = $COpArr->currency($product_arr);
    $product_arr = $COpArr->rohs($product_arr);
    /*
    $sql = $COpArr->sqlAllProduct($product_arr);
    file_put_contents("./niushao.sql",$sql);
    */
    //鍑戝啗宸绔欑殑浠ｇ悊
    //$product_arr = $COpArr->KVproduct($product_arr);
    
    echo "<pre>";
        print_r($product_arr[0]);
    echo "</pre>";
    
    /*
    $sql = $COpArr->sqlAllProduct($product_arr);
    $row = $MDatabaseOperate->getAddId($sql);
    echo $row;
    */
    
    foreach($product_arr as $key => $val){ 
        $sql = $COpArr->sqlProduct($val);
        $row = $MDatabaseOperate->getAddId($sql);
        if($row){ 
            foreach($val['price'] as $k => $v){ 
                $product_id = $row;
                $sql_price = "insert into t_product_price (`product_id`,`purchase_quantity`,`sales_unitprice`,`currency_id`) values('{$row}','{$k}','{$v}','{$val['currency_id']}')";
                $row_price = $MDatabaseOperate->getAddId($sql_price);
                echo "product_price**********".$row_price."<br/>";
            }
        }
        echo "product********".$row."<hr/>";  
    }
    
    
















    /*
    //鏌ヨ揣甯?
    $currency = array();
    foreach($product_arr as $key => $val)
    { 
        $currency[] = $val[8];
    }
    echo "<pre>";
        print_r($currency);
    echo "</pre>";
    */
    /*
    $res = $COpArr->KVprice($product_arr[0]['price']);
    echo "<pre>";
        print_r($res);
    echo "</pre>";
    */
    /*
    echo "<pre>";
        print_r($product_arr[574]['price']);
    echo "</pre>";
    $res = $COpArr->KVprice($product_arr[574]['price']);
    echo "<pre>";
        print_r($res);
    echo "</pre>";

    $str = $res[1];
    echo $str;
    $arr = mb_strlen($str);
    print_r($arr);
    */
?>