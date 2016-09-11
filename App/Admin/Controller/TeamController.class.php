<?php
namespace Admin\Controller;

class TeamController extends WebController {

    public function index(){
    	$map = array();
        if(isset($_GET['keyword'])){
        	if(is_numeric($_GET['keyword'])){
        		$map['id'] = I('keyword');
        	}else{
        		$map['name'] = array('like', '%'.I('keyword').'%');
        	}
        }
        $list   = $this->lists('Team', $map);
        $this->assign('_list', $list);
        $this->meta_title = '用户列表';
        $this->display();
    }


    public function password($id){
		 if(IS_POST){
			$res   =  D('Team')->password();
			if($res  !== false){
				$this->success('修改密码成功！',U('index'));
			}else{
				$this->error(D('users')->getError());
			}
		 }else{
		 	$nickname = M('Team')->where("id=".$id)->getField('name');
			$this->assign('nickname', $nickname);
			$this->meta_title = '修改密码';
			$this->display();
		 }
    }
	
	public function edit($id){
		if(IS_POST){
			$uid = D('Team')->edit();
			if(is_numeric($uid)){
                $this->success('用户修改资料成功！',U('index'));
            } else {
                $this->error(D('Team')->getError());
            }
		}else{
			$info=D('Team')->info($id);
            $this->assign('info',$info);
			$this->meta_title = '修改用户';
			$this->display();
		}
	}
	
    public function del(){
        $id = array_unique((array)I('id',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id) );
        if(M('Team')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}