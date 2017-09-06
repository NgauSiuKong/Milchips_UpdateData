<?php
    class functions
    { 
        //数据库操作对象
        protected $OPDatabaseObj;
        //初始化数据操作对象
        public function __construct($OPDatabaseObj)
        { 
            $this->OPDatabaseObj = $OPDatabaseObj;
        }
        //读取品牌表,实现键值对
        public function KVbrand()
        { 
            $sql = "SELECT brand_id AS id,brand_name AS name FROM t_brand";
            $arr = $this->OPDatabaseObj->getAllArray($sql);
            $KVbrand_arr = array();
            foreach($arr as $key => $val){ 
                $KVbrand_arr[$val['id']] = $val['name'];
            }
            return $KVbrand_arr;
        }
    }