<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends WebController
{
    public function index()
    {
        $this->display();
    }

    public function lists($page = 1, $num = 10, $condition = null)
    {
        if($condition){
            $this->lists = D('Team')->getTeam($page,$num,$condition);
        }else{
            $this->lists = D('Team')->getTeam($page,$num);
        }
        $this->display();
    }

    public function ok($msg = '感谢您的使用!')
    {
        $this->msg_title = "成功-";
        $this->msg = $msg;
        $this->display();
    }

    public function err($msg = '抱歉,出现了问题!')
    {
        $this->msg_title = "出错了!-";
        $this->msg = $msg;
        $this->display();
    }
}