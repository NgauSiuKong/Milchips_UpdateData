<?php
//phpexcel导入操作类
class Inphpexcel
{
    //全部加载sheet时操作对象
    protected $Obj_Inphpexcel;
    //需要导入的文件路径和类名
    protected $FileName;
    //构造函数,导入插件,需要导入的文件,实例化操作类
    //$path_class_infile,需要导入的phpexcel处理类
    //$path_file 需要导入的excel文件
    public function __construct($path_class_infile,$path_file)
    { 
        //参数不为空
        if(empty($path_class_infile) || empty($path_file)){ 
            die("构造函数参数为空");
        }
        //文件需存在
        if(!file_exists($path_class_infile) || !file_exists($path_file)){ 
            die("构造函数参数有误");
        }
        //PHPExcel导入操作类
        require_once($path_class_infile);
        //全部导入sheet提供加载
        $this->FileName = $path_file; 
        $this->Obj_Inphpexcel = PHPExcel_IOFactory::load($path_file);
    } 
    //全部sheet导入非cell格式
    public function AllInsert()
    { 
        $sheetCount = $this->Obj_Inphpexcel->getSheetCount();
        $arr_input = array();
        for($i=0;$i<$sheetCount;$i++){ 
            $arr_input[$i] = $this->Obj_Inphpexcel->getSheet($i)->toArray();
        }
        return $arr_input;
    }
    //sheet导入cell格式
    public function AllCellInsert()
    { 
        $res = array();
        foreach($this->Obj_Inphpexcel->getWorksheetIterator() as $sheet){ 
            foreach($sheet->getRowIterator() as $row){ 
                /*
                //如果不要第一行,操作就是获取行数,略过
                if($row->getRowIndex() == 1){ //获取此row属于第几行
                    continue;
                }
                */
                //将遍历出的行,遍历每一个单元格,也就是列
                foreach($row->getCellIterator() as $cell){ 
                    $data_cell = $cell->getValue();
                    echo $data_cell;
                }
                
            }

        }
    }
    public function colrowCellInsert()
    { 
        //取得sheet操作对象
        $objWorksheet = $this->Obj_Inphpexcel->getSheet(0);
        //总行数
        $highestRow = $objWorksheet->getHighestRow();
        //总列数
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $res = array();
        for($row = 1; $row <= $highestRow; $row++) {    
            for($col = 0; $col < $highestColumnIndex; $col++) {    
                $res[$row-1][] = $objWorksheet->getCellByColumnAndRow( $col, $row )->getValue();    
            }    
        } 
        return $res;
    }


}    
    
?>
