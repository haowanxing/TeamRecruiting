<?php
namespace Home\Controller;
use Think\Controller;
class TeamController extends WebController {
    protected function _initialize(){
        $config = S('DB_CONFIG_DATA');
        if(!$config){
            $config = config_lists();
            S('DB_CONFIG_DATA',$config);
        }
        C($config);
        if (!$this->tid = is_login()) {
            $this->redirect('Public/login');
        }else{
            $this->team = D('team')->getInfo($this->tid);
        }
        $this->web_path = __ROOT__.'/';     //根目录
        $this->web_title = C('WEB_SITE_TITLE');  //网站标题
        $this->web_keywords=C("WEB_SITE_KEYWORD");  //关键字
        $this->web_description=C("WEB_SITE_DESCRIPTION");   //描述
        $this->web_logo = C('WEB_LOGO');    //网站LOGO
        $this->web_icp=C("WEB_SITE_ICP");   //备案号
        $this->web_url=C("WEB_URL");    //站点域名地址
    }
    public function index(){
        $this->display();
    }
    public function password(){
        if(false !== D('Team')->password($this->tid)){
            $this->success('密码修改成功！');
        } else {
            $error = D('Team')->getError();
            $this->error(empty($error) ? '未知错误！' : $error);
        }
    }
    public function chpwd(){
        $this->display();
    }
    public function applyList($page = 1, $num = 10, $condition = null){
        if($condition){
            $condition = json_decode($condition,true);
        }
        $this->list = D('Apply')->getList($this->tid,$page,$num,$condition);
        if(IS_AJAX){
            if($this->list){
                $retMsg = array('code'=>200,'data'=>$this->list);
            }else{
                $retMsg = array('code'=>400,'msg'=>'empty');
            }
            $this->ajaxReturn($retMsg);
        }else{
            $this->title = '申请表-';
            $this->display();
        }
    }
    public function info(){
        if(IS_AJAX){
            if($res = D('Team')->updateInfo($this->tid)){
                $this->success('更新成功!');
            }else{
                $error = D('Team')->getError();
                $this->error(empty($error)?'未知错误! ':$error);
            }
        }else{
            $this->display();
        }
    }
    public function setting(){
        $applyOp = json_decode($this->team['applyop'],true);
        if(I('switch')){
            switch(I('switch')){
                case 'notice':
                    $to = $this->team['notice']==1?'0':'1';
                    if(M('Team')->where('id='.$this->tid)->setField('notice',$to)){
                        $tips = $to?"开":"关";
                        $this->success("通知状态:".$tips);
                    }else{
                        $this->error("发生了错误");
                    }
                    break;
                default:
                    $this->error('你按了什么东西');
                    break;
            }
        }else if(I('apply')){
            foreach(I('get.') as $key=>$value){
                $applyOp[$value] = (int) !$applyOp[$value];
            }
            $res = M('Team')->where('id='.$this->tid)->setField('applyop',json_encode($applyOp));
            if($res){
                $this->success('Success!');
            }else{
                $this->error('Fail');
            }
        }
        else{
            $this->assign('applyop',$applyOp);
            $this->display();
        }
    }
    public function myQR(){
        $this->display();
    }
}