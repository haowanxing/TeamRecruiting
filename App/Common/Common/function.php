<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 16/9/7
 * Time: 下午1:25
 */
function is_login(){
    $user = session('user_auth');
    if (empty($user)){
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
    }
}
function data_auth_sign($data) {
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data);
    $code = http_build_query($data);
    $sign = sha1($code);
    return $sign;
}
function check_verify($code, $id = 1){
    ob_clean();
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
function think_ucenter_md5($str, $key = 'CMsoftTeamRecruiting'){
    return '' === $str ? '' : md5(sha1($str) . $key);
}
function config_lists(){
    $data   = M('Config')->field('type,name,value')->select();
    $config = array();
    if($data && is_array($data)){
        foreach ($data as $value) {
            $config[$value['name']] = config_parse($value['type'], $value['value']);
        }
    }
    return $config;
}

function config_parse($type, $value){
    switch ($type) {
        case 3:
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
            if(strpos($value,':')){
                $value  = array();
                foreach ($array as $val) {
                    list($k, $v) = explode(':', $val);
                    $value[$k]   = $v;
                }
            }else{
                $value =    $array;
            }
            break;
    }
    return $value;
}

function SendMail($address, $title, $message, $fromname = '创明软件工作室')
{
    $mail = new Org\Util\PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = C('MAIL_CHARSET');
    $mail->AddAddress($address);
    $mail->Body = $message;
    $mail->From = C('MAIL_ADDRESS');
    $mail->FromName = $fromname;
    $mail->Subject = $title;
    $mail->Host = C('MAIL_SMTP');
    $mail->SMTPAuth = C('MAIL_AUTH');
    $mail->Username = C('MAIL_LOGINNAME');
    $mail->Password = C('MAIL_PASSWORD');
    $mail->IsHTML(C('MAIL_HTML'));
    return ($mail->Send());
}