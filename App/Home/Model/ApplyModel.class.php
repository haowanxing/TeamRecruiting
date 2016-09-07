<?php
namespace Home\Model;

use Think\Model;

class ApplyModel extends Model
{
    protected $_validate = array(
            array('name', 'require', '姓名必须填写！'),
            array('stuId', 'require', '学号必须填写！'),
            array('stuId', 'number', '学号必须为数字！'),
            array('stuId', '8,12', '学号长度必须为8-12位！', 0,'length'),
            array('stuId', '', '您已经提交过申请了！', 0, 'unique', 1),
            array('phone', 'require', '手机必须填写！'),
            array('phone', 'number', '手机必须为数字！'),
            array('phone', '11', '手机长度必须为11位！',0 ,'length'),
            array('phone', '', '手机号已经存在！', 0, 'unique', 1),
    );
    protected $_auto = array(
            array('time', NOW_TIME, 1),
    );

    public function insertApply()
    {
        if (!$data = $this->create()) {
            return false;
        }
        $res = $this->add($data);
        return $res;
    }
}