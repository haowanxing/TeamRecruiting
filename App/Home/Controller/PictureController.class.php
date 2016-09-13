<?php
namespace Home\Controller;
use Think\Controller;
class PictureController extends WebController {
    public function index(){

    }
    public function uploadPic64($base64){
        if(IS_AJAX){
            $base64 = substr($base64,strpos($base64,',')+1);
            $pathName = 'Apply/'.date('Ymdhis', time()).substr(floor(microtime()*1000),0,1).rand(0,9);
            if($size = D('Picture')->saveBase64($base64, $pathName, 'jpg')){
                $retMsg = array('code'=>200, 'msg'=>'upload success!'.$size);
            }else{
                $retMsg = array('code'=>400, 'msg'=>D('Picture')->getError());
            }
            $this->ajaxReturn($retMsg);
        }
    }
}