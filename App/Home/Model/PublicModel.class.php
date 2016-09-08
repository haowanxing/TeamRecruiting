<?php
namespace Home\Model;
use Think\Model;

class PublicModel extends Model {
    Protected $autoCheckFields = false;
    public function login($email, $password){
        $map = array();
        if(is_numeric($email)){
            $map['phone'] = $email;
        }else{
            $map['email'] = $email;
        }
        $map['status'] = 1;
        $user = M('Team')->where($map)->find();
        if(is_array($user)){
            if(think_ucenter_md5($password) === $user['password']){
                if($user['activation']>0){
                    $this->autoLogin($user);
                    return array($user['id'],$user['ucid']);
                }else{
                    return array(-3,$user['ucid']);
                }
            } else {
                return array(-2,$user['ucid']);
            }
        } else {
            return array(-1,$user['ucid']);
        }
    }

    public function autoLogin($user){
        $data = array(
                'id'             => $user['id'],
                'login_time' => NOW_TIME,
                'login_ip'   => get_client_ip(1)
        );
        M("Team")->save($data);
        $auth = array(
                'uid'             => $user['id'],
                'username'        => $user['name']
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
    }

    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    public function reg(){
        if($data=D('Team')->create()){
//            $data['name']=$data['email'];
            if(is_numeric($data['email'])){
                $data['phone']=$data['email'];
                unset($data['email']);
            }
            $city=$this->getCity(get_client_ip());
            $data['country']=$city['country'];
            $data['province']=$city['region'];
            $data['city']=$city['city'];
            $data['logo']='/Public/images/user-icon.png';
            return M('Team')->add($data);
        } else {
            $this->error=D('Team')->getError();
            return false;
        }
    }

    public function getCity($ip){
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ipinfo=json_decode(file_get_contents($url),true);
        if($ipinfo->code=='1'){
            return false;
        }
        return $ipinfo['data'];
    }

    public function info($uid){
        $map['id'] = $uid;
        return M('User')->where($map)->find();
    }
}