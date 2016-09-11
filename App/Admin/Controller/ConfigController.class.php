<?php
namespace Admin\Controller;

/**
 * 后台配置控制器
 */
class ConfigController extends WebController {
    public function index(){
//        $shop=M('Shop')->count("id");
//        $user=M('User')->count("id");
//        $pcount=M('shop_period')->count("id");
//        $today_period=M('shop_period')->where('state=2 and FROM_UNIXTIME(kaijang_time,"%Y-%m-%d")=CURDATE()')->count('id');
//        $today_user=M('User')->where('FROM_UNIXTIME(create_time,"%Y-%m-%d")=CURDATE()')->count('id');
//        $subQuery=M('shop_period')->field('sid,count(*) AS count')->group('sid')->order('count desc')->limit(5)->select(false);
//        $shopCount=M('shop')->table($subQuery.' a,__SHOP__')->field('name,hits,a.count')->where("id=a.sid")->select();
//        $shopcolor=array("#BD3B47","#DD4444","#FD9C35","#19B698","#649BF4");
//        $i=1;
//        foreach ($shopCount as $k=>$v){
//            $data[$k]=$v;
//            $data[$k]['color']=$shopcolor[$k];
//            $data[$k]['proportion']=$v['count']/$pcount;
//            $surplus+=$v['count'];
//            $i++;
//        }
//        $data[$i]=array("name"=>"其余","count"=>$surplus,"proportion"=>$surplus/$pcount,"color"=>"#999");
//        $buytime=M('shop_record')->field('FROM_UNIXTIME(left(create_time,10),"%H") as hour, count(1) as count')->where('FROM_UNIXTIME(left(create_time,10),"%Y-%m-%d")=CURDATE()')->group('FROM_UNIXTIME(left(create_time,10),"%H")')->select();
//        $reguser=M('User')->field('FROM_UNIXTIME(create_time,"%d") as day, count(1) as count')->where('FROM_UNIXTIME(create_time,"%Y-%m")=date_format(now(),"%Y-%m")')->group('FROM_UNIXTIME(create_time,"%d")')->select();
//        $user_buy=M('User')->table('__SHOP_RECORD__ as record,__USER__ as user')->field('record.uid,Sum(record.number) AS number,user.nickname')->where('FROM_UNIXTIME(left(record.create_time,10),"%Y-%m")=date_format(now(),"%Y-%m") and user.id=record.uid and record.uid>101500')->group('record.uid')->order('number desc')->limit(5)->select();
//        $i=1;
//        foreach ($user_buy as $v){
//            $zh+=$v['number'];
//        }
//        foreach ($user_buy as $k=>$v){
//            $user_data[$k]['nickname']=$v['nickname'];
//            $user_data[$k]['color']=$shopcolor[$k];
//            $user_data[$k]['proportion']=$v['number']/$zh;
//            $user_data[$k]['count']=$v['number'];
//            $i++;
//        }
//        $this->assign('count',array('shop'=>$shop,'user'=>$user,'pcount'=>$pcount,'shopCount'=>$data,'buytime'=>$buytime,'reguser'=>$reguser,'today_period'=>$today_period,'today_user'=>$today_user,'user_buy'=>$user_data));
        $this->display();
    }
    /**
     * 批量保存配置
     */
    public function save($config){
        if($config && is_array($config)){
            $Config = M('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $Config->where($map)->setField('value', $value);
            }
        }
        S('DB_CONFIG_DATA',null);
        $this->success('保存成功！');
    }

    // 获取某个标签的配置参数
    public function weixin() {
        $id     =   I('get.id',1);
        $type   =   C('CONFIG_GROUP_LIST');
        $list   =   M("Config")->where(array('group'=>$id,'display'=>array('gt',0)))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if($list) {
            $this->assign('list',$list);
        }
        $this->assign('id',$id);
        $this->meta_title = $type[$id].'设置';
        $this->display();
    }
}
