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
        public function selProductSql($id)
        { 
            //$sql = "select tp.product_id,brand_name,product_model,product_modelshort,product_name,tp.currency_id,product_memo,product_rohs,product_datasheet,tpp.sales_unitprice,tpp.purchase_quantity from t_product tp left join t_product_price tpp on tp.product_id = tpp.product_id where tp.product_id = ".$id;
            $sql = "select product_id,brand_name,product_model,product_modelshort,product_name,currency_id,product_memo,product_rohs,product_datasheet from t_product where product_id = ".$id;
            return $sql;
        }
        //查询价格信息的sql语句
        public function selPriceSql($product_id)
        { 
            $sql = "select product_id,sales_unitprice,purchase_quantity from t_product_price where product_id = ".$product_id;
            return $sql;
        }
    }