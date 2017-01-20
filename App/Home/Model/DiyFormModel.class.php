<?php
namespace Home\Model;

use Think\Model;

class DiyFormModel extends Model
{
    public function getTemplate($fid){
        $json = $this->find($fid);
        $data = json_decode($json);
        return $data;
    }
}