<?php
namespace Home\Controller;

use Think\Controller;

class ApplyController extends WebController
{
    public function join($t = 1)
    {
        $this->departments = M('department')->select();
        $team = D('team')->getInfo($t);
        $this->team_id = $t;
        $this->index_title = $team['name'] . ' ';
        $this->apply_description = $team['desc'];
        $this->assign('applyOp',json_decode($team['applyop'],true));
        $this->assign('nations',M('Nations')->select());
        $this->display();
    }

    public function intro($t)
    {
        if (!$t) {
            $this->error('页面不存在');
        } else {
            $team = D('Team')->getInfo($t);
            if (!$team) {
                $this->error('找不到该社团!');
            }else{
                $this->assign('team',$team);
                $this->display();
            }
        }
    }

    public function doUpdate()
    {
        $data = D('apply')->insertApply();
        if ($data) {
            $apply_team = D('team')->getInfo($data['tid']);
            if ($apply_team['notice']) {
                $nation = M('Nations')->where('id='.$data['nation'])->getField('name');
                $dept = M('Department')->where('id='.$data['dep'])->getField('dpname');
                $major = M('Major')->where('id='.$data['major'])->getField('mjname');
                $template = "联系方式: {$data['phone']} <br>民族: {$nation} <br>院系: {$dept} <br>专业: {$major} <br>个人兴趣: {$data['interest']}";
                $Title = "社团申请通知:" . $data['name'] . "申请加入" . $apply_team['name'];
                $Content = <<<CONTENT
亲爱的【{$apply_team['name']}】社团:<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;您有一封来自<span style="color:red;">{$data['name']}</span>同学的入社申请,请注意及时处理!
<br><br>{$template}<br><br>
温馨提示:本邮件由创明软件工作室自动发出,请不要直接进行回复此邮件!
CONTENT;
                SendMail_Sock($apply_team['email'], $Title, $Content, C('WEB_NAME'));
            }
            $this->success('感谢您的申请!',U('Index/lists'));
        } else {
            $this->error(D("apply")->getError());
        }
    }

    public function test()
    {
//        import('@.ORG.Mail');
//        SendMail('york_mail@qq.com','邮件标','邮件正2文','歪酷');
    }
}