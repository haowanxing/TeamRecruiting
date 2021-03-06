<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 16/9/8
 * Time: 上午9:22
 */

namespace Home\Controller;
use Com\Alidayu\AlidayuClient as Client;
use Com\Alidayu\Request\SmsNumSend;

class PublicController extends WebController
{

    public function servertime()
    {
        $this->ajaxReturn(array('time' => NOW_TIME));
    }

    public function islogin()
    {
        if (is_login()) {
            $this->success('已经登录！');
        } else {
            $this->error('请先登录！');
        }
    }

    /*登录*/
    public function login($email = null, $password = null)
    {
        if (IS_POST) {
            $user = D('Public')->login($email, $password);
            if ($user[0] > 0) {
                $this->success('登录成功！', U('Team/index'));
            } else { //登录失败
                switch ($user[0]) {
                    case -1:
                        $error = '用户不存在或被禁用！';
                        break; //系统级别禁用
                    case -2:
                        $error = '密码错误！';
                        break;
                    case -3:
                        $error = '用户还为激活！';
                        session('email', $email);
                        if (is_numeric($email)) {
                            $url = U('public/phone/');
                        } else {
                            $url = U('public/email/');
                        }
                        break;
                    default:
                        $error = '未知错误！';
                        break;
                }
                $this->error($error, $url);
            }
        } else {
            if (D('Public')->check_login()) {
                $this->redirect('Team/index');
            } else {
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout()
    {
        if (is_login()) {
            D('Public')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('Public/login'));
        }
    }

    public function reg()
    {
        if (!C('USER_ALLOW_REGISTER')) {
            $this->error('注册已经关闭，请稍后注册~');
        }
        if(D('Public')->check_login()){
            $this->error('请退出当前用户再进行操作',U('Team/index'));
        }
        if (IS_POST) {
            /* 检测验证码 TODO: */
            if (!check_verify(I("passcode"))) {
                $this->error("验证码错误！");
            }
            if (!I('protocol')) {
                $this->error('抱歉不同意服务协议无法注册！');
            }
            if (I("password") != I("repassword")) {
                $this->error('密码和重复密码不一致！');
            }
            if (is_numeric(I('email'))) {
                $map['phone'] = I('email');
            } else {
                $map['email'] = I('email');
            }
            if ($User = M('Team')->where($map)->field('id,activation')->find()) {
                if($User['activation'] == 0){
                    session('email',I('email'));
                    $this->error('用户之前已经注册过了,但是还没验证激活',U('Public/email'));
                }else{
                    $this->error('用户已经注册！');
                }
            }
            if (!$this->check_name(I('email'))) {
                $this->error('请正确输入注册邮箱或手机号');
            }
            $uid = D('Public')->reg();
            if (is_numeric($uid)) {
                session('email', I('email'));
                if (is_numeric(I('email'))) {
                    session('email', I('email'));
                    $this->success('用户注册成功！', U('Public/phone'));
                } else {
                    $this->jhMail($uid, I('email'), think_ucenter_md5(I('password')));
                    $this->success('用户注册成功！', U('Public/email'));
                }
            } else {
                $this->error(D('Public')->getError());
            }
        } else {
            $this->title = "注册-";
            $this->display();
        }
    }

    public function verify()
    {
        ob_clean();
        $config = array(
                'useCurve' => false,            // 是否画混淆曲线
                'useNoise' => true,            // 是否添加杂
                'fontSize' => 16,              // 验证码字体大小(px)
                'length' => 4,               // 验证码位数
        );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }

    public function againmail($uid = 0)
    {
        $map = array('id' => $uid, 'status' => 1, 'activation' => 0);
        $user = M('Team')->field('id,email,password')->where($map)->find();
        if ($user) {
            if ($this->jhMail($user['id'], $user['email'], $user['password'], false)) {
                $this->success('发送成功请查收！');
            } else {
                $this->error('发送失败请从新发送！');
            }
        }
    }

    protected function jhMail($uid, $username, $password, $async = true)
    {
        $url = $this->web_url . U('public/email',array('uid'=>$uid,'key'=>$password));
        $title = '感谢您注册' . $this->web_title . '-帐号激活邮件';
//        $content = '<div class="wrapper" style="margin: 20px auto 0; width: 500px; padding-top:16px; padding-bottom:10px;"><br style="clear:both; height:0"><div class="content" style="background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #E9E9E9; margin: 2px 0 0; padding: 30px;"><p>您好: </p><p>感谢您注册 <a href="' . $this->web_url . '">' . $this->web_title . '</a></p><p style="border-top: 1px solid #DDDDDD;margin: 15px 0 25px;padding: 15px;">请点击以下链接激活并设置您的账号: <a href="' . $url . '" target="_blank">' . $url . '</a></p><p style="border-top: 1px solid #DDDDDD; padding-top:6px; margin-top:25px; color:#838383;"><p>请勿回复本邮件, 此邮箱未受监控, 您不会得到任何回复。</p><p>如果点击上面的链接无效，请尝试将链接复制到浏览器地址栏访问。</p></p></div></div>';
        $content = <<<CETNT
您好: 感谢您注册 $this->web_title
<p>请点击以下链接激活并设置您的账号: <a href="$url" target="_blank">$url</a></p>
<p>请勿回复本邮件, 此邮箱未受监控, 您不会得到任何回复。</p>
<p>如果点击上面的链接无效，请尝试将链接复制到浏览器地址栏访问。</p>
CETNT;
        if($async){ //异步发送
            return SendMail_Sock($username, $title, $content);
        }
        return SendMail($username, $title, $content);
    }
    public function againpwd($uid){
        $map=array('id' => $uid,'status'=>1);
        $user=M('Team')->field('id,email,password')->where($map)->find();
        if($user){
            if($this->pwdMail($user['id'],$user['email'],$user['password'])){
                $this->success('发送成功请查收！');
            }else{
                $this->error('发送失败请从新发送！');
            }
        }
    }
    public function email($uid = null, $key = null)
    {
        $map = array('id' => $uid, 'password' => $key, 'status' => 1);
        if (M('Team')->where($map)->setField('activation', 1)) {
            session('email', null);
            $this->success('邮箱验证成功请登录！', U('Public/login'));
        } else {
            $this->assign('user', session('email'));
            $this->assign('uid', M('Team')->where(array('email' => session('email')))->getField('id'));
            $this->display();
        }
    }

    public function phone($uid = null, $code = null)
    {
        if (IS_POST) {
            if ($this->cell_code_check($code)) {
                $map = array('id' => $uid, 'status' => 1);
                if (M('Team')->where($map)->setField('activation', 1)) {
                    session('cell_code', null);
                    session('email', null);
                    $this->success('手机验证成功请登录！', U('Public/login'));
                }
            } else {
                $this->error('手机验证失败！');
            }
        } else {
            $this->assign('uid', M('Team')->where(array('phone' => session('email')))->getField('id'));
            $this->display($this->tplpath . "phone.html");
        }
    }
    public function sendcode($type='reg',$phone=''){
        $username=$phone?$phone:session('email');
        if(IS_GET){
            if($type=='reg'){
                $this->cellcode($username);
            }elseif($type=='bindcode'){
                $this->cellcode($username);
            }else{
                $this->pswcode($username);
            }
        }
    }

    public function forgetpwd($step=1){
        switch ($step) {
            case 1:
                if(IS_POST){
                    if(!check_verify(I("passcode"))){$this->error("验证码错误！");}
                    if(I('username')){
                        if(is_numeric(I('username'))){
                            $map['phone']=I('username');
                        }else{
                            $map['email']=I('username');
                        }
                        $map['status']=1;
                        if($user=M('Team')->field('id,email,password,phone')->where($map)->find()){
                            if(is_numeric(I('username'))){
                                session('username',$user['phone']);
                                $this->success('验证手机！',U('Public/forgetpwd',array('step'=>2,'uid'=>$user['id'])));
                            }else{
                                $this->pwdMail($user['id'],$user['email'],$user['password']);
                                session('username',$user['email']);
                                $this->success('邮箱发送成功！',U('Public/forgetpwd',array('step'=>2,'uid'=>$user['id'])));
                            }
                        }else{$this->error('没有该用户！');}
                    }else{$this->error('请输入用户名！');}
                }else{$this->display("findpwd_1");}
                break;
            case 2:
                if(IS_POST){
                    if($this->cell_code_check(I('post.code'))){
                        $map=array('id' => I('post.uid'),'status'=>1);
                        $user=M('Team')->field('id,password')->where($map)->find();
                        session('cell_code', null);
                        session('username',null);
                        $this->success('手机验证成功请重新设置密码！',U('Public/forgetpwd',array('step'=>3,'uid'=>$user['id'],'key'=>$user['password'])));
                    }else{
                        $this->error('手机验证失败！');
                    }
                }else{
                    $this->assign('uid',I('uid',0,'intval'));
                    $this->assign('email',session('username'));
                    if(is_numeric(session('username'))){
                        $this->display("findpwd_2_phone");
                    }else{
                        $this->display("findpwd_2");
                    }
                }
                break;
            case 3:
                if(IS_POST){
                    if(I("password") != I("repassword")){
                        $this->error('密码和重复密码不一致！');
                    }
                    if(strlen(I('password'))<6){
                        $this->error('密码长度必须大于5位数！');
                    }
                    $map=array('id'=>session('uid'),'password'=>session('password'));
                    session('[destroy]');
                    if(M('Team')->where($map)->setField('password',think_ucenter_md5(I('repassword')))){
                        $this->success('密码修改成功！',U('Public/login'));
                    }else{
                        $this->error('请问你想做什么！',U('index/index'));
                    }
                }else{
                    $map=array('id'=>I('uid',0,'intval'), 'password'=>I('key'),'status'=>1);
                    if(M('Team')->where($map)->getField('id')){
                        session('password',I('key'));
                        session('uid',I('uid',0,'intval'));
                        $this->display("findpwd_3");
                    }else{
                        $this->error('请不要到你不该来的地方！',U('index/index'));
                    }
                }
                break;
        }
    }

    public function login_cookie(){
        return 'PHPSESSID='.cookie('PHPSESSID').';path='.cookie('path');
    }
    protected function pwdMail($uid, $username, $password)
    {
        $url = $this->web_url . U('public/forgetpwd',array('step'=>3,'uid'=>$uid,'key'=>$password));
        return sendMail($username, $this->web_title . '-密码找回', '您好: 您最近提出了密码重设请求。要完成此过程，请点按以下链接: <a href="' . $url . '" target="_blank">' . $url . '</a>
        <br/>如果您未提出此请求，可能是其他用户无意中输入了您的电子邮件地址，您的帐户仍然安全。
        请勿回复本邮件, 此邮箱未受监控, 您不会得到任何回复。
        如果点击上面的链接无效，请尝试将链接复制到浏览器地址栏访问。');
    }

    /**
     * 获取随机位数数字
     * @param  integer $len 长度
     * @return string
     */
    protected function randString($len = 6)
    {
        $chars = str_repeat('0123456789', $len);
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
        return $str;
    }

    //手机验证码保存
    protected function cell_code($code)
    {
        $session = array();
        $session['cell_code'] = $code;
        $session['cell_time'] = NOW_TIME;
        session('cell_code', $session);
    }

    protected function cellcode($cell)
    {
        $client = new Client;
        $request = new SmsNumSend;
        $code = $this->randString();
        $this->cell_code($code);
        $smsParams = array(
                'code' => $code,
                'product' => C("WEB_SITE_TITLE")
        );
        // 设置请求参数
        $req = $request->setSmsTemplateCode('SMS_5235593')
                ->setRecNum($cell)
                ->setSmsParam(json_encode($smsParams))
                ->setSmsFreeSignName('注册验证')
                ->setSmsType('normal')
                ->setExtend('reg');
        $request = $client->execute($req);
        $this->ajaxReturn($request);
    }

    public function pswcode($cell)
    {
        $client = new Client;
        $request = new SmsNumSend;
        $code = $this->randString();
        $this->cell_code($code);
        $smsParams = array(
                'code' => $code,
                'product' => C("WEB_SITE_TITLE")
        );
        // 设置请求参数
        $req = $request->setSmsTemplateCode('SMS_5235591')
                ->setRecNum($cell)
                ->setSmsParam(json_encode($smsParams))
                ->setSmsFreeSignName('变更验证')
                ->setSmsType('normal')
                ->setExtend('getpasd');
        $request = $client->execute($req);
        $this->ajaxReturn($request["alibaba_aliqin_fc_sms_num_send_response"]["result"]);
    }

    public function bindcode($cell)
    {
        $client = new Client;
        $request = new SmsNumSend;
        $code = $this->randString();
        $this->cell_code($code);
        $smsParams = array(
                'code' => $code,
                'product' => C("WEB_SITE_TITLE")
        );
        // 设置请求参数
        $req = $request->setSmsTemplateCode('SMS_5235596')
                ->setRecNum($cell)
                ->setSmsParam(json_encode($smsParams))
                ->setSmsFreeSignName('身份验证验证码')
                ->setSmsType('normal')
                ->setExtend('getpasd');
        $request = $client->execute($req);
        $this->ajaxReturn($request["alibaba_aliqin_fc_sms_num_send_response"]["result"]);
    }

    protected function cell_code_check($code)
    {
        $session = session('cell_code');
        if (empty($code) || empty($session)) {
            return false;
        }
        // session 过期
        if (NOW_TIME - $session['cell_time'] > 1800) {
            session('cell_code', null);
            return false;
        }
        if ($code == $session['cell_code']) {
            return true;
        }
        return false;
    }

    protected function check_name($username)
    {
        if (is_numeric($username)) {
            return (preg_match("^(0|86|17951)?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$", $username));
        } else {
            return (preg_match('/\w+@(\w|\d)+\.\w{2,3}/i', $username));
        }
    }
    public function feedback(){
        if(IS_POST){
            if($data = D('Feedback')->create()){
                if(D('Feedback')->add($data)){
                    $this->success('感谢您的反馈!',U('Team/index'));
                }else{
                    $this->error('系统出错啦');
                }
            }else{
                $this->error(D('Feedback')->getError());
            }
        }else{
            $this->display();
        }
    }
}