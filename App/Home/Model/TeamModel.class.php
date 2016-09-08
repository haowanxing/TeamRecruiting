<?php
namespace Home\Model;

use Think\Model;

class TeamModel extends Model
{
    protected $_validate = array(
            array('oldpassword', 'require', '请输入原密码！', self::EXISTS_VALIDATE, 'regex', self::MODEL_UPDATE),
            array('password', '6,30', '密码长度必须在6-30个字符之间！', self::EXISTS_VALIDATE, 'length')
    );
    protected $_auto = array(
            array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function'),
            array('create_time', NOW_TIME, self::MODEL_INSERT),
            array('login_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
            array('status', '1')
    );

    public function getInfo($tid)
    {
        return $this->field('password', true)->where('id=' . $tid)->find();
    }
}