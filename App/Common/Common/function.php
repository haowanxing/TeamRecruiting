<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 16/9/7
 * Time: 下午1:25
 */
function config_lists(){
    $data   = M('Config')->field('type,name,value')->select();
    $config = array();
    if($data && is_array($data)){
        foreach ($data as $value) {
            $config[$value['name']] = config_parse($value['type'], $value['value']);
        }
    }
    return $config;
}

function config_parse($type, $value){
    switch ($type) {
        case 3:
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
            if(strpos($value,':')){
                $value  = array();
                foreach ($array as $val) {
                    list($k, $v) = explode(':', $val);
                    $value[$k]   = $v;
                }
            }else{
                $value =    $array;
            }
            break;
    }
    return $value;
}