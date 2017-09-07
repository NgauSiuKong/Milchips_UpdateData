<?php
    class MilchipsData
    { 
        //二维数组变成一维数组
        public function ArrtransOne($arr)
        { 
            $one_array = array();
            foreach($arr as $key => $val){ 
                $one_array[$val['product_id']] = $val['product_model'];
            }
            $one_array = array_unique($one_array);
            //$arr = array_values($arr);
            return $one_array;
        }
        //查询产品信息的sql
        public function selProductSql($product_id)
        { 
            //$sql = "select tp.product_id,brand_name,product_model,product_modelshort,product_name,tp.currency_id,product_memo,product_rohs,product_datasheet,tpp.sales_unitprice,tpp.purchase_quantity from t_product tp left join t_product_price tpp on tp.product_id = tpp.product_id where tp.product_id = ".$id;
            $sql = "select product_id,brand_name,product_model,product_modelshort,product_name,currency_id,product_memo,product_rohs,product_datasheet from t_product where product_id = ".$product_id;
            return $sql;
        }
        //查询价格信息的sql语句
        public function selPriceSql($product_id)
        { 
            $sql = "select sales_unitprice,purchase_quantity from t_product_price where product_id = ".$product_id;
            return $sql;
        }
        //匹配给军工E站上传的数据
        public function milEdata($product,$price)
        { 
            $times = array(0.80,0.81,0.82,0.83,0.84,0.85,0.86,0.87,0.88,0.89,0.90);
            $price_one =array();
            foreach($price as $key => $val)
            {
                $price_one[$val['purchase_quantity']] = $times[rand(0,10)]*($val['sales_unitprice']);
            }
            $milEdata = $product[0];
            $milEdata['price'] = $price_one;
            return $milEdata;

        }
        //生成插入军工E站的sql
        public function milesqlProduct($arr)
        { 
            $sql = "insert into product_fu 
            (`product_type`,`agent_name`,`brand_name`,`product_model`,`product_modelshort`,`product_name`,`currency_id`,`product_stocknum`,`product_memo`,`product_rohs`,`product_datasheet`,`product_createtime`) values('3','军工E站','{$arr['brand_name']}','{$arr['product_model']}','{$arr['product_modelshort']}','{$arr['product_name']}','{$arr['currency_id']}','".rand(1,5000)."','{$arr['product_memo']}','{$arr['rohs']}','{$arr['product_datasheet']}','".date("Y-m-d H:i:s")."')"; 
            return $sql;
        }
    }