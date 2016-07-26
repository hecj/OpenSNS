<?php


namespace Issue\Controller;

use Think\Controller;


class IndexController extends Controller
{
    /**
     * 业务逻辑都放在 WeiboApi 中
     * @var
     */
    public function _initialize()
    {
        $tree = D('Issue')->getTree();
        $this->assign('tree', $tree);


        $sub_menu =
            array(
                'left' =>
                    array(
                        array('tab' => 'home', 'title' => '首页', 'href' => U('Issue/index/index')),
                    ),
            );
        if (check_auth('addIssueContent')) {
            $sub_menu['right'] = array(
                array('tab' => 'post', 'title' => '发布', 'href' => '#frm-post-popup','a_class'=>'open-popup-link')
            );
        }
        foreach ($tree as $cat) {
            if ($cat['_']) {
                $children = array();
                $children[] = array('tab' => 'cat_' . $cat['id'], 'title' => '全部', 'href' => U('Issue/index/index', array('issue_id' => $cat['id'])));
                foreach ($cat['_'] as $child) {
                    $children[] = array('tab' => 'cat_' . $cat['id'], 'title' => $child['title'], 'href' => U('Issue/index/index', array('issue_id' => $child['id'])));
                }

            }
            $menu_item = array('children' => $children, 'tab' => 'cat_' . $cat['id'], 'title' => $cat['title'], 'href' => U('Issue/Index/index', array('issue_id' => $cat['id'])));
            $sub_menu['left'][] = $menu_item;
            unset($children);
        }
        $this->assign('sub_menu', $sub_menu);

    }

    public function index($page = 1, $issue_id = 0)
    {
        //设置展示方式 列表；瀑布流
        $aDisplay_type=I('display_type','','text');
        $cookie_type=cookie('issue_display_type');
        if($aDisplay_type==''){
            if($cookie_type){
                $aDisplay_type=$cookie_type;
            }else{
                $aDisplay_type=modC('DISPLAY_TYPE','list','Issue');
                cookie('issue_display_type',$aDisplay_type);
            }
        }else{
            if($cookie_type!=$aDisplay_type){
                cookie('issue_display_type',$aDisplay_type);
            }
        }
        $this->assign('display_type',$aDisplay_type);
        //设置展示方式 列表；瀑布流 end

        $issue_id = intval($issue_id);
        $issue = D('Issue')->find($issue_id);
        if (!$issue_id == 0) {
            $issue_id = intval($issue_id);
            $issues = D('Issue')->where("id=%d OR pid=%d", array($issue_id, $issue_id))->limit(999)->select();
            $ids = array();
            foreach ($issues as $v) {
                $ids[] = $v['id'];
            }
            $map['issue_id'] = array('in', implode(',', $ids));
        }
        $map['status'] = 1;
        $content = D('IssueContent')->where($map)->order('create_time desc')->page($page, 16)->select();
        $totalCount = D('IssueContent')->where($map)->count();
        foreach ($content as &$v) {
            $v['user'] = query_user(array('id', 'nickname', 'space_url', 'space_link', 'avatar128', 'rank_html'), $v['uid']);
            $v['issue'] = D('Issue')->field('id,title')->find($v['issue_id']);
            if($aDisplay_type=='masonry'){
                $cover = M('Picture')->where(array('status' => 1))->getById($v['cover_id']);
                $imageinfo = getimagesize('.'.$cover['path']);
                $v['cover_height']=$imageinfo[1]*255/$imageinfo[0];
                $v['cover_height']=$v['cover_height']?$v['cover_height']:253;
            }
        }
        unset($v);
        $this->assign('contents', $content);
        $this->assign('totalPageCount', $totalCount);
        $this->assign('top_issue', $issue['pid'] == 0 ? $issue['id'] : $issue['pid']);

        $this->assign('issue_id', $issue_id);
        $this->setTitle('专辑');
        $this->display();
    }

    public function doPost($id = 0, $cover_id = 0, $title = '', $content = '', $issue_id = 0, $url = '')
    {
        if (!check_auth('addIssueContent')) {
            $this->error('抱歉，您不具备投稿权限。');
        }
        $issue_id = intval($issue_id);
        if (!is_login()) {
            $this->error('请登陆后再投稿。');
        }
        if (!$cover_id) {
            $this->error('请上传封面。');
        }
        if (trim(op_t($title)) == '') {
            $this->error('请输入标题。');
        }
        if (trim(op_h($content)) == '') {
            $this->error('请输入内容。');
        }
        if ($issue_id == 0) {
            $this->error('请选择分类。');
        }
        if (trim(op_h($url)) == '') {
            $this->error('请输入网址。');
        }
        $content = D('IssueContent')->create();
        $content['content'] = filter_content($content['content']);
        $content['title'] = op_t($content['title']);
        $content['url'] = op_t($content['url']); //新增链接框
        $content['issue_id'] = $issue_id;

        if ($id) {
            $content_temp = D('IssueContent')->find($id);
            if (!check_auth('editIssueContent')) { //不是管理员则进行检测
                if ($content_temp['uid'] != is_login()) {
                    $this->error('不可操作他人的内容。');
                }
            }
            $content['uid'] = $content_temp['uid']; //权限矫正，防止被改为管理员
            $rs = D('IssueContent')->save($content);
            if ($rs) {
                $this->success('编辑成功。', U('issueContentDetail', array('id' => $content['id'])));
            } else {
                $this->success('编辑失败。', '');
            }
        } else {
            if (modC('NEED_VERIFY', 0) && !is_administrator()) //需要审核且不是管理员
            {
                $content['status'] = 0;
                $tip = '但需管理员审核通过后才会显示在列表中，请耐心等待。';
                $user = query_user(array('nickname'), is_login());
                $admin_uids = explode(',', C('USER_ADMINISTRATOR'));
                foreach ($admin_uids as $admin_uid) {
                    D('Common/Message')->sendMessage($admin_uid, $title = '专辑投稿提醒',"{$user['nickname']}向专辑投了一份稿件，请到后台审核。",  'Admin/Issue/verify', array(),is_login(), 2);
                }
            }
            $rs = D('IssueContent')->add($content);
            if ($rs) {
                $this->success('投稿成功。' . $tip, 'refresh');
            } else {
                $this->success('投稿失败。', '');
            }
        }


    }

    public function issueContentDetail($id = 0)
    {


        $issue_content = D('IssueContent')->find($id);
        if (!$issue_content) {
            $this->error('404 not found');
        }
        D('IssueContent')->where(array('id' => $id))->setInc('view_count');
        $issue = D('Issue')->find($issue_content['issue_id']);

        $this->assign('top_issue', $issue['pid'] == 0 ? $issue['id'] : $issue['pid']);
        $this->assign('issue_id', $issue['id']);
        $issue_content['user'] = query_user(array('id', 'nickname', 'space_url', 'space_link', 'avatar64', 'rank_html', 'signature'), $issue_content['uid']);
        $this->assign('content', $issue_content);
        $this->setTitle('{$content.title|op_t}' . '——专辑');
        $this->setKeywords($issue_content['title']);
        $this->display();
    }

    public function selectDropdown($pid)
    {
        $issues = D('Issue')->where(array('pid' => $pid, 'status' => 1))->limit(999)->select();
        exit(json_encode($issues));


    }

    public function edit($id)
    {
        if (!check_auth('addIssueContent') && !check_auth('editIssueContent')) {
            $this->error('抱歉，您不具备投稿权限。');
        }
        $issue_content = D('IssueContent')->find($id);
        if (!$issue_content) {
            $this->error('404 not found');
        }
        if (!check_auth('editIssueContent')) { //不是管理员则进行检测
            if ($issue_content['uid'] != is_login()) {
                $this->error('404 not found');
            }
        }

        $issue = D('Issue')->find($issue_content['issue_id']);

        $this->assign('top_issue', $issue['pid'] == 0 ? $issue['id'] : $issue['pid']);
        $this->assign('issue_id', $issue['id']);
        $issue_content['user'] = query_user(array('id', 'nickname', 'space_url', 'space_link', 'avatar64', 'rank_html', 'signature'), $issue_content['uid']);
        $this->assign('content', $issue_content);
        $this->display();
    }
}