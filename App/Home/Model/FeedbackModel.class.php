<?php
namespace Home\Model;

use Think\Model\RelationModel;

class FeedbackModel extends RelationModel
{
    protected $_validate = array(
            array('content', 1,200, '内容请不要超过200个字符!', 1, 'length', 1),
            array('content','require','内容不能为空!'),
    );
    protected $_auto = array(
            array('stats', 1, 1),
    );
    protected $_link = array(
            'Team' => array(
                    'mapping_type' => self::BELONGS_TO,
                    'foreign_key' => 'from',
                    'mapping_name' => 'id',
                    'mapping_fields' => 'name',
                    'as_fields' => 'name:tname',
            ),
    );

    public function getList($page = 1, $num = 10)
    {
        return $this->page($page, $num)->select();
    }
}