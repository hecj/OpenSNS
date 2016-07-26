<?php
namespace Weibo\Controller;

use Think\Controller;
use Think\Hook;



class TieziController extends BaseController{

	private function  checkIsLogin()
    {
        if(!is_login()){
            $this->error('请登陆后再进行操作');
        }
    }


	public function doSendtiezi()
	{	
		header("Content-type:text/html;charset=utf-8");
		$uid = is_login();
		$title = I('post.title');
		$content = I('post.content');
		$time = time();
		$time = date('Y-m-d H:i:s',$time);

			

        $tieziModel = M('tiezi');
		$tieziModel->create();

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     157286400 ;// 设置附件上传大小不超过15M
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录    
		$upload->savePath  =     '/Img/'; // 设置附件上传（子）目录
		// 上传文件
		$data = array(
			'uid' => $uid,
			'title' => $title,
			'content' => $content,
			'create_time' => $time,
			'status' => 1,
			'is_top' => 0,
		);

        $info = $upload->upload();
			if($info){
				$data['img_url']="http://".$_SERVER['HTTP_HOST']."/opensns/Uploads".$info['file']['savepath'].$info['file']['savename'];
			}
		
		if($uid && $title && $content){
			$tiezi_id = $tieziModel = $tieziModel->add($data);
			if($tiezi_id){
				//积分+1  未改
				//	$tieziModel->where("id='{$tid}'")->setInc('replay');
						$this->success('回复成功');
				$this->success('发布成功');
			}else{
			    $this->error('发布失败');
			}
		}else{
			$this->error('发布失败');
		}
		
	}


	public function tiezilist()
	{
		$tieziModel = M('tiezi');
		$tieziinfo = $tieziModel->where('status=1')->select();
		$this->assign();
		//$this->display();
	}


	public function delteizi($id)
	{
		$uid = is_login();
		$tieziModel = M('tiezi');

		if($uid && $id ){
			$data = $tieziModel->where("id='{$id}' and uid='{$uid}'" )->find();
			if($data){
				$tieziModel->where("id='{$data['id']}'")->setField('status',0);
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('删除失败');
		}

	}	



	public function addreplay(){
		$uid = is_login();
		$content = I('content');
		$tid = I('tid');
		$time = date('Y-m-d H:i:s',time());

		$replayModel = M('replay');
		$replayModel->create();

		$data = array(
				'tid' => $tid,
				'uid' => $uid,
				'content' => $content,
				'create_time' => $time,
				'status' => 1,
			);

		if($uid && $tid && $content){
			$tieziModel = M('tiezi');
			$result = $tieziModel->where("id='{$tid}' and uid='{$uid}'")->find();
			if($result){
				$rid = $replayModel->add($data);
					if($rid){
						$tieziModel->where("id='{$tid}'")->setInc('replay');
						$this->success('回复成功');
					}
					else{
						$this->error('回复失败');
					}
			}else{
				$this->error('帖子不存在');
			}
		}else{
			$this->error('失败');
		}

	}



	public function delreplay(){
		$uid = is_login();
		$tid = I('tid');
		$rid = I('rid');

		$replayModel = M('replay');
		$tieziModel = M('tiezi');
		$result = $replayModel->where("id='{$rid}' and uid='{$uid}'")->setField('status',0);

		if($result){
			$tieziModel->where("id='{$tid}'")->setDec('replay');
			$this->success('删除回复成功');
		}else{
			$this->error('删除回复失败');
		}
	}




}