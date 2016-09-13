<?php
namespace Home\Model;

use Think\Model\RelationModel;

class ApplyModel extends RelationModel
{
    protected $_validate = array(
            array('name', 'require', '姓名必须填写！'),
//            array('stuId', 'require', '学号必须填写！'),
            array('stuId', 'number', '学号必须为数字！'),
            array('stuId', '8,12', '学号长度必须为8-12位！', 0, 'length'),
//            array('phone', 'require', '手机必须填写！'),
            array('phone', 'number', '手机必须为数字！'),
            array('phone', '11', '手机长度必须为11位！', 0, 'length'),
            array('tid,stuId', 'checkApply', '你已经申请过该社团', 1, 'callback',1),
//            array('phone', '', '手机号重复！', 0, 'unique'),
    );
    protected $_auto = array(
            array('time', NOW_TIME, 1),
    );
    protected $_link = array(
            'department' => array(
                    'mapping_type' => self::BELONGS_TO,
//                    'class_name' => 'department',
                    'foreign_key' => 'dep',
                    'mapping_name' => 'department',
                    'mapping_fields'=>'dpname',
                    'as_fields'=>'dpname:deptname',
            ),
            'major' => array(
                    'mapping_type' => self::BELONGS_TO,
                    'foreign_key' => 'major',
                    'mapping_fields'=>'mjname',
                    'as_fields'=>'mjname:majorname',
            ),
            'team' => array(
                    'mapping_type' => self::BELONGS_TO,
                    'foreign_key' => 'tid',
                    'mapping_name' => 'team',
                    'mapping_fields'=>'name',
                    'as_fields'=>'name:applyto',
            ),
    );

    public function insertApply()
    {
        if (!$data = $this->create()) {
            return false;
        }
        if ($res = $this->add($data)) {

        }
        return $data;
    }
    public function checkApply($map){
        $data['tid'] = $map['tid'];
        $data['stuId'] = $map['stuId'];
        if($this->where($data)->find()){
            return false;
        }else{
            return true;
        }
    }

    public function getList($tid, $page = 1, $num = 10,$condition = null)
    {
        if($condition){
            $data = $condition;
        }
        $data['tid'] = $tid;
        $data = $this->relation(true)->where($data)->page($page, $num)->select();
        return $data;
    }
}