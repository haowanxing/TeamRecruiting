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
    public function updateInfo($tid = TID){
        if($data = $this->create()){
            $this->id = $tid;
            unset($this->password);
            return $this->save();
        }else{
            return false;
        }
    }
    public function password($tid = TID){
        if(!$data = $this->create()){
            return false;
        }
        if(I('post.password') !== I('post.repassword')){
            $this->error = '您输入的新密码与确认密码不一致！';
            return false;
        }
        if(!$this->verifyUser($tid, I('post.oldpassword'))){
            $this->error = '验证出错：密码不正确！';
            return false;
        }
        $this->id=$tid;
        $res = $this->save();
        return $res;
    }
    protected function verifyUser($uid, $password_in){
        $password = $this->getFieldById($uid, 'password');
        if(think_ucenter_md5($password_in) === $password){
            return true;
        }
        return false;
    }
}