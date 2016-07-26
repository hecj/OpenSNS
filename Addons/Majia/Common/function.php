<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-2
 * Time: 下午3:56
 * @author 郑钟良<zzl@ourstu.com>
 */

function getMajiaUids(){
    $uids=S('MAJIA_ADDON_UIDS');
    if(!$uids){
        $map['name']    =   'Majia';
        $map['status']  =   1;
        $config  =   M('Addons')->where($map)->getField('config');
        $config=json_decode($config,true);
        if($config['uids']!=''){
            $uids=explode(',',$config['uids']);
        }else{
            $uids=array();
        }
        S('MAJIA_ADDON_UIDS',$uids,600);
    }
    return $uids;
}