<?php
namespace Home\Controller;
use Think\Controller;
class ApplyController extends WebController {
    public function index($t = 1){
        $this->departments = M('department')->select();
        $team = D('team')->getInfo($t);
        $this->team_id = $t;
        $this->index_title = $team['name'].' ';
        $this->apply_description = $team['desc'];
        $this->display();
    }

    public function doUpdate()
    {
        $data = D('apply')->insertApply();
        if($data){
            $retMsg = array('code'=>200,'msg'=>'申请记录已经保存!','info'=>$data);
            $apply_team = D('team')->getInfo($data['tid']);
            if($apply_team['notice']){
                $Title = "社团申请通知:".$data['name']."申请加入".$apply_team['name'];
                $Content = <<<CONTENT
亲爱的【{$apply_team['name']}】社团:<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;您有一封来自<span style="color:red;">{$data['name']}</span>同学的入社申请,请注意及时处理!
<br><br>
温馨提示:本邮件由创明软件工作室自动发出,请不要直接进行回复此邮件!
CONTENT;

                SendMail($apply_team['email'],$Title,$Content,C('WEB_NAME'));
            }
        }else{
            $retMsg = array('code'=>400,'msg'=>D("apply")->getError());
        }
        if(IS_AJAX){
            $this->ajaxReturn($retMsg);
        }else{
            $this->result = $retMsg;
        }
    }
    public function test(){
//        import('@.ORG.Mail');
//        SendMail('york_mail@qq.com','邮件标','邮件正2文','歪酷');
    }
}