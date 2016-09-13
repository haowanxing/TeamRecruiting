<?php
namespace Home\Model;

use Think\Model;

class PictureModel extends Model
{
    public function saveBase64($base64, $pathName, $type = 'png'){
        $saveto = './Uploads/images/'.$pathName.'.'.$type;
        $size = file_put_contents($saveto, base64_decode($base64));
        return $size;
    }
}