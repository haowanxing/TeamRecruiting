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
        $this->team = D('team')->getInfo($this->tid);
        $this->display();
    }
    public function applyList(){
        $this->display();
    }
}