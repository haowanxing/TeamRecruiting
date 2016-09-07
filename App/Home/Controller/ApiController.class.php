<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends WebController {
    public function index(){

    }
    public function getDepartments(){
        $departments = M('department')->select();
        if(IS_AJAX){
            $this->ajaxReturn($departments);
        }
    }
    public function getMajor(){
        $pdId = I('post.id');
        $Majors = M('major')->field("id,mjname")->where(array('dp_id'=>$pdId))->select();
        if(IS_AJAX){
            $this->ajaxReturn($Majors);
        }else{
            echo 0;
        }
    }
}