<?php
//处理导入数组的类
class OpArr
{ 
    //处理||截开的价格，用数组形式表示
    //$arr 整体大数组
    public function opPrice($arr)
    { 
        foreach($arr as $key => $val){ 
            $arr[$key] = $this->subPrice($val);
        }
        return $arr;
    }
    //一维数组,处理||截开的价格，用数组形式表示
    public function subPrice($arr){ 
        $tmp_arr = explode("||",$arr[9]);
        $tmp_arr_kv = $this->KVprice($tmp_arr);
        $arr['price'] = $tmp_arr_kv;
        return $arr;
    }
    //把购买数量和单价做成键值对的形式
    public function KVprice($arr)
    { 
        foreach($arr as $key => $val){ 
            $arr[$key] = explode('+',$val);
        }
        $res = array();
        foreach($arr as $key => $val){ 
            //$res[$val[0]] = substr($val[1],3);
            $res[$val[0]] = $val[1];
        }
        return $res;   
    }
    //产品的KV格式和去重重排
    public function KVproduct($arr)
    { 
        $KVproduct = array();
        foreach($arr as $key => $val){ 
            $KVproduct[$key] = $val[0];
        }
        $KVproduct = array_unique($KVproduct); 
        $KVproduct = array_values($KVproduct);
        return $KVproduct;
    }
    //区分货币,去掉货币符号以及含铅量
    public function currency($arr){ 
        foreach($arr as $key => $val){ 
            if($val[8] == "RMB" || $val[8] == "CNY"){ 
                $arr[$key]['currency_id'] = 1;
            }elseif($val[8] == "USD"){ 
                $arr[$key]['currency_id'] = 2;
            }elseif($val[8] == "EUR"){ 
                $arr[$key]['currency_id'] = 3;
            }
        }
        return $arr;
    }
    //查产品的rohs
    public function rohs($arr)
    { 
        foreach($arr as $key => $val){ 
            if($val[4]){ 
                $arr[$key]['rohs'] = 1;
            }else{ 
                $arr[$key]['rohs'] = 2;
            }
        }
        return $arr;
    }
    //添加品牌id
    /*
    public function addBrand($brand_arr,$product_arr)
    { 
        foreach($product_arr as $key => $val){ 
            if(in_array($val[2],$brand_arr)){ 

            }
        }
    }
    */
    //按照数组生成产品的sql
    public function sqlProduct($arr)
    { 
        $sql = "insert into t_product 
        (`product_type`,`agent_name`,`brand_name`,`product_model`,`product_modelshort`,`product_name`,`currency_id`,`product_stocknum`,`product_memo`,`product_rohs`,`product_datasheet`,`product_createtime`) values('3','{$arr[1]}','{$arr[2]}','{$arr[0]}','".strtolower($arr[0])."','{$arr[0]}','{$arr['currency_id']}','{$arr[7]}','{$arr[3]}','{$arr['rohs']}','{$arr[5]}','".date("Y-m-d H:i:s")."')"; 
        return $sql;
    }
    //生成一句插入sql
    public function sqlAllProduct($product_arr)
    { 
        $sql1 = "insert into t_product 
        (`product_type`,`agent_name`,`brand_name`,`product_model`,`product_modelshort`,`product_name`,`currency_id`,`product_stocknum`,`product_memo`,`product_rohs`,`product_datasheet`,`product_createtime`) values ";
        foreach($product_arr as $key => $val){ 
            
            $sql2 .= "('3','{$val[1]}','{$val[2]}','{$val[0]}','".strtolower($val[0])."','{$val[0]}','{$val['currency_id']}','{$val[7]}','{$val[3]}','{$val['rohs']}','{$val[5]}','".date("Y-m-d H:i:s")."'),";
        }
        $sql = $sql1.$sql2;
        return $sql;
    }


}
?>
