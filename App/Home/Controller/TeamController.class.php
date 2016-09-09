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
    public function applyList($page = 1,$condition = null){
        if($condition){
            $condition = json_decode($condition,true);
        }
        $this->list = D('Apply')->getList($this->tid,$page,$condition);
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
                $retMsg = array('code'=>200,'data'=>$res,);
            }else{
                $retMsg = array('code'=>400,'data'=>$res,'msg'=>'更新失败');
            }
            $this->ajaxReturn($retMsg);
        }else{
            $this->display();
        }
    }
    public function myQR(){
        $this->display();
    }
}