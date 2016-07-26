<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-2
 * Time: 下午3:36
 * @author 郑钟良<zzl@ourstu.com>
 */

namespace Addons\Majia\Controller;

use Home\Controller\AddonsController;

require_once(ONETHINK_ADDON_PATH . 'Majia/Common/function.php');

class MajiaController extends AddonsController
{
    public function change()
    {
        $uids=getMajiaUids();
        if(count($uids)){
            $uids=array_diff($uids,array(is_login()));
        }
        $users=array();
        foreach($uids as $val){
            $val=query_user(array('uid','nickname'),$val);
            if(isset($val['uid'])){
                $users[]=$val;
            }
        }
        $this->assign('users',$users);
        $now=query_user(array('uid','nickname'));
        $this->assign('now_user',$now);
        $this->display(T('Addons://Majia@Majia/change'));
    }
    public function doChange()
    {
        $aUid=I('post.uid',0,'intval');
        $uids=getMajiaUids();
        if(in_array(is_login(),$uids)&&in_array($aUid,$uids)&&$aUid!=is_login()){
            $memberModel = D('Common/Member');
            $memberModel->logout();
            $memberModel->login($aUid); //登陆
            $result['status']=1;
        }else{
            $result['status']=0;
        }
        $this->ajaxReturn($result);
    }
} 