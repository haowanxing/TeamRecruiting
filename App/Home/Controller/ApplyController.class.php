<?php
namespace Home\Controller;
use Think\Controller;
class ApplyController extends WebController {
    public function index($t = 1){
        $this->departments = M('department')->select();
        $team = M('team')->where(array('id'=>$t))->find();
        $this->team_id = $t;
        $this->index_title = $team['name'].'-';
        $this->apply_description = $team['desc'];
        $this->display();
    }

    public function doUpdate()
    {
        $res = D('apply')->insertApply();
        if($res){
            $retMsg = array('code'=>200,'msg'=>'申请记录已经保存!','number'=>$res);
        }else{
            $retMsg = array('code'=>400,'msg'=>D("apply")->getError());
        }
        if(IS_AJAX){
            $this->ajaxReturn($retMsg);
        }else{
            $this->result = $retMsg;
        }
    }
}