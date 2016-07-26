<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */




/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function Qiniu_Encode1($str) // URLSafeBase64Encode
 {
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($str));
 }
 function Qiniu_Sign1($url) {//$info里面的url
    $setting = C ( 'UPLOAD_SITEIMG_QINIU' );
    $duetime = NOW_TIME + 10*365*24*3600;//下载凭证有效时间
    $DownloadUrl = $url . '?e=' . $duetime;
    $Sign = hash_hmac ( 'sha1', $DownloadUrl, $setting ["driverConfig"] ["secrectKey"], true );
    $EncodedSign = Qiniu_Encode1 ( $Sign );
    $Token = $setting ["driverConfig"] ["accessKey"] . ':' . $EncodedSign;
    $RealDownloadUrl = $DownloadUrl . '&token=' . $Token;
    return $RealDownloadUrl;
 }
 /**
*上传图片至七牛云
*$path 图片地址
*$dirname 在七牛云上的文类名称
*$filename 文件保存名称
*$bucket 你的七牛云域名称
*/
function upPicTo7niu($path,$dirname,$filename,$bucket){

$contents = @file_get_contents($path);

$storename = $dirname."/".$filename;
$bu = $bucket.":".$storename;
$accessKey = '';
$secretKey = '';

Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bu);
$upToken = $putPolicy->Token(null);
$putExtra = new Qiniu_PutExtra();
$putExtra->Crc32 = 1;
list($ret, $err) = Qiniu_Put($upToken, $storename, $contents, $putExtra);
}
